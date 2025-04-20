<?php

namespace App\Repositories;

use App\Models\Product;
use App\DTOs\ProductDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function __construct(
        private CategoryProductRepositoryInterface $categoryProductRepository
    ) {}

    public function all(?Request $request): LengthAwarePaginator
    {
        $ids = $request?->get('category')
            ? $this->categoryProductRepository->filterByCategory($request?->get('category'))->pluck('product_id')
            : null;

        return Product::
            when($request?->get('sort'), fn ($query) => $query->orderBy('price', $request?->get('sort')))
            ->when($ids, fn ($query) => $query->whereIn('id', $ids))
            ->paginate($request?->get('perPage') ?? 5)
            ->withQueryString();
    }

    public function create(ProductDTO $productDTO): ?Product
    {
        try {
            DB::beginTransaction();

            $product = Product::create($productDTO->toArray());
            $this->attach($productDTO->categories, $product->id);

            DB::commit();

            return $product;
        } catch (\Throwable $th) {
            DB::rollBack();
            return null;
        }
    }

    public function update(ProductDTO $productDTO, int $id): int
    {
        $product = Product::findOrFail($id);

        return $product->update($productDTO->toArray());
    }

    public function delete(int $id): bool
    {
        $product = Product::findOrFail($id);

        return $product->delete();
    }

    public function find(int $id): ?Product
    {
        return Product::find($id);
    }

    public function attach(int|string|array $categories, int $id) : bool
    {
        $product = $this->find($id);
        $categories = is_array($categories) ? $categories : [$categories];

        return $this->categoryProductRepository->insert(array_map(
            fn ($id) => ['category_id' => $id, 'product_id' => $product->id],
            $categories
        ));
    }
}
