<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryProductRepository implements CategoryProductRepositoryInterface
{
    private $table = 'category_product';

    public function filterBy($column, mixed $value) : Collection
    {
        $column = match ($column) {
            'product', 'category' => "{$column}_id",
            default => throw new \InvalidArgumentException('Invalid column'),
        };

        $value = is_array($value) ? $value : [$value];

        return DB::table($this->table)
            ->whereIn($column, $value)
            ->get();
    }

    public function insert(array $rows) : bool
    {
        return DB::table($this->table)->insert($rows);
    }

    public function __call($name, $arguments) : Collection
    {
        if (! str_starts_with($name, 'filterBy')) {
            throw new \BadMethodCallException("Undefined method '{$name}'", 1);
        }

        $column = strtolower(str_replace('filterBy', '', $name));

        return $this->filterBy($column, $arguments);
    }
}
