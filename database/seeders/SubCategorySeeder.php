<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            Subcategory::create([
                'name' => 'Cleaning ' . $category->name,
                'description' => 'Specialized cleaning service under the category: ' . $category->name,
                'thumbnail' => null,
                'status' => 'active',
                'category_id' => $category->id,
            ]);

            Subcategory::create([
                'name' => 'Repair ' . $category->name,
                'description' => 'Comprehensive repair service for category: ' . $category->name,
                'thumbnail' => null,
                'status' => 'active',
                'category_id' => $category->id,
            ]);
        }
    }
}
