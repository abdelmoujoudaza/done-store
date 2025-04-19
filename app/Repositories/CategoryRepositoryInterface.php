<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    public function all(): Collection;

    public function create(array $attributes): ?Category;

    public function update(array $attributes, int $id): int;

    public function delete(int $id): bool;

    public function find(int $id): ?Category;
}
