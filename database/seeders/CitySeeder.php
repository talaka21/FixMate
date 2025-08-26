<?php

namespace Database\Seeders;

use App\Models\city;
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
 $cities = [
            ['state_id' => 1, 'en' => 'Damascus',     'ar' => 'دمشق'],
            ['state_id' => 1, 'en' => 'Aleppo',      'ar' => 'حلب'],
            ['state_id' => 1, 'en' => 'Homs',        'ar' => 'حمص'],
            ['state_id' => 1, 'en' => 'Latakia',     'ar' => 'اللاذقية'],
            ['state_id' => 1, 'en' => 'Hama',        'ar' => 'حماة'],
            ['state_id' => 1, 'en' => 'Raqqa',       'ar' => 'الرقة'],
            ['state_id' => 1, 'en' => 'Deir ez-Zor', 'ar' => 'دير الزور'],
            ['state_id' => 1, 'en' => 'Al-Hasakah',  'ar' => 'الحسكة'],
            ['state_id' => 1, 'en' => 'Qamishli',    'ar' => 'القامشلي'],
            ['state_id' => 1, 'en' => 'Tartus',      'ar' => 'طرطوس'],

            ['state_id' => 2, 'en' => 'Beirut',      'ar' => 'بيروت'],
            ['state_id' => 2, 'en' => 'Tripoli',     'ar' => 'طرابلس'],
            ['state_id' => 2, 'en' => 'Sidon',       'ar' => 'صيدا'],
            ['state_id' => 2, 'en' => 'Baalbek',     'ar' => 'بعلبك'],
            ['state_id' => 2, 'en' => 'Tyre',        'ar' => 'صور'],
            ['state_id' => 2, 'en' => 'Nabatieh',    'ar' => 'النبطية'],
            ['state_id' => 2, 'en' => 'Jounieh',     'ar' => 'جونيه'],
            ['state_id' => 2, 'en' => 'Aley',        'ar' => 'عاليه'],
            ['state_id' => 2, 'en' => 'Zahle',       'ar' => 'زحلة'],
            ['state_id' => 2, 'en' => 'Mazraa',      'ar' => 'المزرعة'],

            ['state_id' => 3, 'en' => 'Dubai',       'ar' => 'دبي'],
            ['state_id' => 3, 'en' => 'Abu Dhabi',   'ar' => 'أبو ظبي'],
            ['state_id' => 3, 'en' => 'Sharjah',     'ar' => 'الشارقة'],
            ['state_id' => 3, 'en' => 'Al Ain',      'ar' => 'العين'],
            ['state_id' => 3, 'en' => 'Ajman',       'ar' => 'عجمان'],
            ['state_id' => 3, 'en' => 'Ras Al Khaimah', 'ar' => 'رأس الخيمة'],
            ['state_id' => 3, 'en' => 'Fujairah',    'ar' => 'الفجيرة'],
            ['state_id' => 3, 'en' => 'Umm Al Quwain','ar' => 'أم القيوين'],
            ['state_id' => 3, 'en' => 'Kalba',       'ar' => 'كلباء'],
            ['state_id' => 3, 'en' => 'Dibba Al-Fujairah','ar' => 'دبا الفجيرة'],
        ];

        foreach ($cities as $cityData) {
            $city = new city();
            $city->state_id = $cityData['state_id'];

            $city->setTranslations('name', [
                'en' => $cityData['en'],
                'ar' => $cityData['ar'],
            ]);

            $city->save();
        }
}
}

