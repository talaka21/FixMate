<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('states')->insert([
           
    [
        'name_en' => 'Syria',
        'name_ar' => 'سوريا',
    ],
    [
        'name_en' => 'Lebanon',
        'name_ar' => 'لبنان',
    ],
    [
        'name_en' => 'United Arab Emirates',
        'name_ar' => 'الإمارات العربية المتحدة',
    ],

        ]);
    }
}
