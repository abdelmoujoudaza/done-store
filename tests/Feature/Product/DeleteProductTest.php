<?php

use App\Models\Product;

test('Products can be deleted via an Http request', function () {
    $product = Product::first();

    $this->delete(route('products.destroy', ['product' => $product->id]))
        ->assertRedirectToRoute('products.index');

    $this->assertDatabaseMissing('products', [
        'id' => $product->id
    ]);
});
