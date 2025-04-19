<?php

namespace App\Processors;

use App\DTOs\ProductDTO;

interface InputProcessorInterface
{
    public function handle(mixed $source): ProductDTO;
}
