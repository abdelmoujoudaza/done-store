<?php

namespace App\Repositories;

use App\Models\Product;
use App\DTOs\ProductDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::all();
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
