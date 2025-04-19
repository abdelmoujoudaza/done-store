<?php

namespace App\Processors;

use App\DTOs\ProductDTO;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\InputInterface;

class ConsoleInputProcessor implements InputProcessorInterface
{
    public function handle(mixed $source): ProductDTO
    {
        if (! $source instanceof InputInterface) {
            throw new \InvalidArgumentException('Invalid input source');
        }

        return new ProductDTO(
            name: $source->getArgument('name'),
            description: $source->getArgument('description'),
            price: (float) $source->getArgument('price'),
            image: Storage::disk('public')->putFile('products', new File($source->getArgument('image'))),
            categories: $source->hasArgument('categories')  ? explode(',', $source->getArgument('categories')) : []
        );
    }
}
