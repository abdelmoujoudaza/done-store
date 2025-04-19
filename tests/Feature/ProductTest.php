<?php
use App\Models\Product;
use App\Models\Category;

test('product can be created from cli', function () {
    $product = Product::factory()->makeOne();
    $categories = Category::all()->random(2);
    $image = base_path('/tests/mocks/blank-product.png');

    $this->artisan(sprintf(
            'product:create "%s" "%s" %f "%s" "%s"',
            $product->name,
            $product->description,
            $product->price,
            $image,
            $categories->pluck('id')->join(',')
        ))
        ->assertSuccessful()
        ->expectsOutputToContain("Product {$product->name} created successfully!");

    $this->assertDatabaseHas('products', [
        'name' => $product->name,
        'description' => $product->description,
        'price' => $product->price,
    ]);

    $product = Product::where([
        'name' => $product->name,
        'description' => $product->description,
        'price' => $product->price,
    ])->with('categories')->first();

    expect($product->categories->pluck('id')->toArray())->toBe($categories->pluck('id')->toArray());
});

test('create product command required arguments', function () {
    $product = Product::factory()->makeOne();
    $image = base_path('/tests/mocks/blank-product.png');

    $this->artisan(sprintf(
            'product:create "%s" "%s" %f "%s" "%s"',
            $product->name,
            $product->description,
            $product->price,
            $image,
            ''
        ))->assertFailed();
});
