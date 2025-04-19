<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    public function all(): Collection
    {
        return Product::all();
    }

    public function create(array $attributes): ?Product
    {
        return Product::create($attributes);
    }

    public function update(array $attributes, int $id): int
    {
        $product = Product::findOrFail($id);

        return $product->update($attributes);
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
