<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                AboutUs::truncate();

        // إنشاء سجل تجريبي
        AboutUs::create([
            'content' => "Welcome to FixMate! We provide professional solutions to boost your business.\nOur goal is to help you succeed.",
            'phone' => '0923456721',
            'facebook' => 'https://www.facebook.com/yourpage',
            'instagram' => 'https://www.instagram.com/yourpage',
        ]);
    }


}
