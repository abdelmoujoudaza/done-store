<?php

use App\Models\Category;
use Inertia\Testing\AssertableInertia as Assert;

test('product listing has a pagination mecanisme', function () {
    $this->get(route('products.index', ['perPage' => 10]))
    ->assertOk()
    ->assertInertia(fn (Assert $page) => $page
        ->component('products/Index', shouldExist: false)
        ->has('products.data', 10)
        ->has('products.links')
        ->has('categories')
    );
});

test('product listing has a filters mecanisme', function (Category $category, string $sort) {
    $this->get(route('products.index', ['category' => $category->id, 'sort' => $sort]))
    ->assertOk()
    ->assertInertia(fn (Assert $page) => $page
        ->component('products/Index', shouldExist: false)
        ->has('categories')
        ->has('products')
        ->where('products.total', $category->products()->count())
        ->where('filters.category', (string) $category->id)
        ->where('filters.sort', $sort)
    );
})->with([
    [fn () => Category::all()->random()->first(), 'ASC'],
    [fn () => Category::all()->random()->first(), 'DESC'],
]);
