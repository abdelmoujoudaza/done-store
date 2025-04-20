<?php

namespace App\Processors;

use App\DTOs\ProductDTO;

interface InputProcessorInterface
{
    public function process(mixed $source): ProductDTO;
}
