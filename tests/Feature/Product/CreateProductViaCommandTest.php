<?php

use App\Models\Product;
use App\Models\Category;

beforeEach(function () {
    $this->product = Product::factory()->makeOne();
    $this->categories = Category::all()->random(2);
});

test('Products can be created via the CLI', function () {
    $image = base_path('/tests/mocks/blank-product.png');

    $this->artisan(sprintf(
            'product:create "%s" "%s" %f "%s" "%s"',
            $this->product->name,
            $this->product->description,
            $this->product->price,
            $image,
            $this->categories->pluck('id')->join(',')
        ))
        ->assertSuccessful()
        ->expectsOutputToContain("Product {$this->product->name} created successfully!");

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

test('Creating a product via an CLI throws validation errors when required arguments are missing', function () {
    $image = base_path('/tests/mocks/blank-product.png');

    $this->artisan(sprintf(
            'product:create "%s" "%s" %f "%s" "%s"',
            $this->product->name,
            $this->product->description,
            $this->product->price,
            $image,
            ''
        ))->assertFailed();

    $this->assertDatabaseMissing('products', [
        'name' => $this->product->name,
        'description' => $this->product->description,
        'price' => $this->product->price,
    ]);
});
