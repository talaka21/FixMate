<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['state_id' => 1, 'name' => 'Mazzeh', 'status' => 'active'],
            ['state_id' => 1, 'name' => 'Barzeh', 'status' => 'active'],
            ['state_id' => 2, 'name' => 'Suleimaniyah', 'status' => 'active'],
            ['state_id' => 2, 'name' => 'Furqan', 'status' => 'inactive'],
            ['state_id' => 3, 'name' => 'Waer', 'status' => 'active'],
        ]);
    }
}
