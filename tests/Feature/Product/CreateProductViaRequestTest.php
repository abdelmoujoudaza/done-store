<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Inertia\Testing\AssertableInertia as Assert;

beforeEach(function () {
    $this->product = Product::factory()->makeOne();
    $this->categories = Category::all()->random(2);
});

test('Products can be created via an Http request', function () {
    $this->post(route('products.store'), [
        'name' => $this->product->name,
        'description' => $this->product->description,
        'price' => $this->product->price,
        'image' => UploadedFile::fake()->image('product.jpg'),
        'categories' => $this->categories->pluck('id')->toArray()
    ])
    ->assertRedirectToRoute('products.index');

    $this->assertDatabaseHas('products', [
        'name' => $this->product->name,
        'description' => $this->product->description,
        'price' => $this->product->price,
    ]);

    $this->product = Product::where([
        'name' => $this->product->name,
        'description' => $this->product->description,
        'price' => $this->product->price,
    ])->with('categories')->first();

    expect($this->product->categories->pluck('id')->toArray())->toBe($this->categories->pluck('id')->toArray());
});

test('Creating a product via an HTTP request throws validation errors when required arguments are missing', function () {
    $this->post(route('products.store'), [
        'name' => $this->product->name,
        'description' => $this->product->description,
        'price' => $this->product->price,
        'image' => null,
        'categories' => []
    ])
    ->assertRedirect()
    ->assertInvalid(['image', 'categories']);

    $this->assertDatabaseMissing('products', [
        'name' => $this->product->name,
        'description' => $this->product->description,
        'price' => $this->product->price,
    ]);
});

test('Product creation page accessibility', function () {
    $this->get(route('products.create'))
    ->assertOk()
    ->assertInertia(fn (Assert $page) => $page
        ->component('products/Create', shouldExist: false)
        ->has('categories')
    );
});

