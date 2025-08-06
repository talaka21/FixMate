<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('categories')->delete();

        $categories = [
            [
                'name' => 'Plumbing',
                'description' => 'Services related to water pipes, leaks, and bathroom installations.',
                'thumbnail' => 'uploads/categories/plumbing.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electrical',
                'description' => 'Electrical wiring, lighting installation, and troubleshooting.',
                'thumbnail' => 'uploads/categories/electrical.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Air Conditioning',
                'description' => 'AC installation, repair, and maintenance services.',
                'thumbnail' => 'uploads/categories/ac.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Painting',
                'description' => 'Wall painting, decorative finishes, and surface preparations.',
                'thumbnail' => 'uploads/categories/painting.jpg',
                'status' => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Appliance Repair',
                'description' => 'Fixing household appliances like washing machines, ovens, and fridges.',
                'thumbnail' => 'uploads/categories/appliance_repair.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carpentry',
                'description' => 'Furniture assembly, wood repairs, and door installations.',
                'thumbnail' => 'uploads/categories/carpentry.jpg',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('categories')->insert($categories);

    }
}
