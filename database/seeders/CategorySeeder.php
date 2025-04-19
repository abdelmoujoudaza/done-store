<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parentCategories = Category::factory(3)->create();

        Category::factory(5)->recycle($parentCategories)->subCategory()->create();
    }
}
