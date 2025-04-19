<?php

namespace App\Repositories;

use App\Models\Product;
use App\DTOs\ProductDTO;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(?Request $request): LengthAwarePaginator
    {
        return Product::
            when($request?->get('sort'), function (Builder $query) use ($request) {
                $query->orderBy('price', $request?->get('sort'));
            })
            ->when($request?->get('category'), function (Builder $query) use ($request) {
                $query->whereHas('categories', function ($q) use ($request) {
                    $q->where('categories.id', $request?->get('category'));
                });
            })
            ->with('categories')
            ->paginate($request?->get('perPage') ?? 5)
            ->withQueryString();
    }

    public function create(ProductDTO $productDTO): ?Product
    {
        try {
            DB::beginTransaction();

            $product = Product::create($productDTO->toArray());
            $product->categories()->attach($productDTO->categories);

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
}
