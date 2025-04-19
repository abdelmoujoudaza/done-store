<?php

namespace App\Repositories;

use App\Models\Product;
use App\DTOs\ProductDTO;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;

    public function create(ProductDTO $productDTO): ?Product;

    public function update(ProductDTO $productDTO, int $id): int;

    public function delete(int $id): bool;

    public function find(int $id): ?Product;
}
