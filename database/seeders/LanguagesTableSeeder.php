<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            ['name' => 'English', 'code' => 'en', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arabic', 'code' => 'ar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
