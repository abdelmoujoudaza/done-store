<?php

namespace App\Validators;

use App\Rules\CategoryExists;

class ProductValidator
{
    public static function creationRules() : array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpg,bmp,png',
            'categories' => ['required', 'array', app(CategoryExists::class)],
            'categories.*' => 'integer',
        ];
    }
}
