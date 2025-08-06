<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $tags = [
            // Tags based on main categories
            ['name' => 'Plumbing', 'status' => 'active'],
            ['name' => 'Electrical', 'status' => 'active'],
            ['name' => 'Air Conditioning', 'status' => 'active'],
            ['name' => 'Painting', 'status' => 'inactive'],
            ['name' => 'Appliance Repair', 'status' => 'active'],
            ['name' => 'Carpentry', 'status' => 'active'],

            // Tags based on subcategories
            ['name' => 'Cleaning Plumbing', 'status' => 'active'],
            ['name' => 'Repair Plumbing', 'status' => 'active'],
            ['name' => 'Cleaning Electrical', 'status' => 'active'],
            ['name' => 'Repair Electrical', 'status' => 'active'],
            ['name' => 'Cleaning Air Conditioning', 'status' => 'active'],
            ['name' => 'Repair Air Conditioning', 'status' => 'active'],
            ['name' => 'Cleaning Painting', 'status' => 'inactive'],
            ['name' => 'Repair Painting', 'status' => 'inactive'],
            ['name' => 'Cleaning Appliance Repair', 'status' => 'active'],
            ['name' => 'Repair Appliance Repair', 'status' => 'active'],
            ['name' => 'Cleaning Carpentry', 'status' => 'active'],
            ['name' => 'Repair Carpentry', 'status' => 'active'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }

    }
}
