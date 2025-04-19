<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;

    public function create(array $attributes): ?Product;

    public function update(array $attributes, int $id): int;

    public function delete(int $id): bool;

    public function find(int $id): ?Product;
}
