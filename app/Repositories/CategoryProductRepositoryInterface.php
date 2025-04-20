<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

/**
 *  App\Repositories\CategoryProductRepositoryInterface
 *
 * @method Collection filterByCategory(mixed $value)
 * @method Collection filterByProduct(mixed $value)
 */
interface CategoryProductRepositoryInterface
{
    public function filterBy($column, mixed $value) : Collection;

    public function insert(array $rows) : bool;
}
