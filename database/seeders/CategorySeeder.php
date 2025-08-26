<?php

namespace Database\Seeders;

use App\Models\Category;
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
   $categories = [
            [
                'name' => [
                    'en' => 'Healthcare',
                    'ar' => 'الرعاية الصحية',
                ],
                'description' => [
                    'en' => 'Services related to hospitals, clinics, pharmacies, and emergency care.',
                    'ar' => 'خدمات متعلقة بالمستشفيات والعيادات والصيدليات والرعاية الطارئة.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Education',
                    'ar' => 'التعليم',
                ],
                'description' => [
                    'en' => 'Services related to schools, universities, and vocational training.',
                    'ar' => 'خدمات متعلقة بالمدارس والجامعات والتدريب المهني.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Transportation',
                    'ar' => 'النقل',
                ],
                'description' => [
                    'en' => 'Services for public transport, vehicle registration, and driving licenses.',
                    'ar' => 'خدمات النقل العام وتسجيل المركبات ورخص القيادة.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Finance',
                    'ar' => 'المالية',
                ],
                'description' => [
                    'en' => 'Banking, taxes, and investment related services.',
                    'ar' => 'الخدمات المصرفية والضرائب والخدمات المتعلقة بالاستثمار.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Legal',
                    'ar' => 'القانونية',
                ],
                'description' => [
                    'en' => 'Court services, notary, and legal aid services.',
                    'ar' => 'خدمات المحاكم والتوثيق والمساعدة القانونية.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Housing',
                    'ar' => 'السكن',
                ],
                'description' => [
                    'en' => 'Services for real estate, utilities, and building permits.',
                    'ar' => 'خدمات العقارات والمرافق وتصاريح البناء.',
                ],
            ],
            [
                'name' => [
                    'en' => 'Business',
                    'ar' => 'الأعمال',
                ],
                'description' => [
                    'en' => 'Services for company registration, licenses, and trade activities.',
                    'ar' => 'خدمات تسجيل الشركات والتراخيص والأنشطة التجارية.',
                ],
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
    }



