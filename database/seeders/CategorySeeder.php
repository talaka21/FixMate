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
              // حذف البيانات القديمة أولًا
        DB::table('categories')->delete();


        $categories = [
            ['name_en' => 'Healthcare',     'name_ar' => 'الرعاية الصحية', 'description' => 'Services related to hospitals, clinics, pharmacies, and emergency care.'],
            ['name_en' => 'Education',      'name_ar' => 'التعليم',       'description' => 'Services related to schools, universities, and vocational training.'],
            ['name_en' => 'Transportation', 'name_ar' => 'النقل',         'description' => 'Services for public transport, vehicle registration, and driving licenses.'],
            ['name_en' => 'Finance',        'name_ar' => 'المالية',       'description' => 'Banking, taxes, and investment related services.'],
            ['name_en' => 'Legal',          'name_ar' => 'القانونية',     'description' => 'Court services, notary, and legal aid services.'],
            ['name_en' => 'Housing',        'name_ar' => 'السكن',         'description' => 'Services for real estate, utilities, and building permits.'],
            ['name_en' => 'Business',       'name_ar' => 'الأعمال',       'description' => 'Services for company registration, licenses, and trade activities.'],
        ];

        DB::table('categories')->insert($categories);
    }

    }

