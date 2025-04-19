<?php

namespace App\DTOs;

class ProductDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $price,
        public string $image,
        public array $categories = []
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image,
            'categories' => $this->categories,
        ];
    }
}
