<?php

namespace App\Processors;

use App\DTOs\ProductDTO;
use Illuminate\Http\Request;

class RequestInputProcessor implements InputProcessorInterface
{
    public function handle(mixed $source): ProductDTO
    {
        if (! $source instanceof Request) {
            throw new \InvalidArgumentException('Invalid input source');
        }

        return new ProductDTO(
            name: $source->input('name'),
            description: $source->input('description'),
            price: (float) $source->input('price'),
            image: $source->file('image')?->store('products'),
            categories: $source->input('categories', [])
        );
    }
}
