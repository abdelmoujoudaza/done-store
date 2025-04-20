<?php

namespace App\Processors;

use App\DTOs\ProductDTO;
use Illuminate\Http\Request;

class RequestInputProcessor extends BaseInputProcessor
{
    public function process(mixed $source): ProductDTO
    {
        if (! $source instanceof Request) {
            throw new \InvalidArgumentException('Invalid input source');
        }

        return new ProductDTO(
            name: $source->input('name'),
            description: $source->input('description'),
            price: (float) $source->input('price'),
            image: $this->processImage($source->file('image')->path()),
            categories: $source->input('categories', [])
        );
    }
}
