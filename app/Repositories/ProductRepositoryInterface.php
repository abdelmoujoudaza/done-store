<?php

namespace App\Repositories;

use App\Models\Product;
use App\DTOs\ProductDTO;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function all(?Request $request): LengthAwarePaginator;

    public function create(ProductDTO $productDTO): ?Product;

    public function update(ProductDTO $productDTO, int $id): int;

    public function delete(int $id): bool;

    public function find(int $id): ?Product;
}
