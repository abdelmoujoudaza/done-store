<?php

namespace App\Processors;

use App\DTOs\ProductDTO;
use Symfony\Component\Console\Input\InputInterface;

class ConsoleInputProcessor extends BaseInputProcessor
{
    public function process(mixed $source): ProductDTO
    {
        if (! $source instanceof InputInterface) {
            throw new \InvalidArgumentException('Invalid input source');
        }

        return new ProductDTO(
            name: $source->getArgument('name'),
            description: $source->getArgument('description'),
            price: (float) $source->getArgument('price'),
            image: $this->processImage($source->getArgument('image')),
            categories: $source->hasArgument('categories')  ? explode(',', $source->getArgument('categories')) : []
        );
    }
}
