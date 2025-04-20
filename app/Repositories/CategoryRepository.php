<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function all(): Collection
    {
        return Category::all();
    }

    public function create(array $attributes): ?Category
    {
        return Category::create($attributes);
    }

    public function update(array $attributes, int $id): int
    {
        $category = Category::findOrFail($id);

        return $category->update($attributes);
    }

    public function delete(int $id): bool
    {
        $category = Category::findOrFail($id);

        return $category->delete();
    }

    public function find(int $id): ?Category
    {
        return Category::find($id);
    }

    public function exists(mixed $ids): bool
    {
        $ids = is_array($ids) ? $ids : [$ids];

        return Category::whereIn('id', $ids)->count() === count($ids);
    }
}
