<?php

namespace App\Processors;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

abstract class BaseInputProcessor implements InputProcessorInterface
{
    protected function processImage(string $path) : string
    {
        return Storage::disk('public')->putFile('products', new File($path));
    }
}
