<?php

namespace Database\Seeders;

use App\Enum\ServiceProviderEnum;
use App\Models\ServiceProvider;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

foreach (range(1, 10) as $i) {
    // إنشاء المزود
    $providerId = DB::table('service_providers')->insertGetId([
        'provider_name' => 'Provider ' . $i,
        'shop_name' => 'Shop ' . $i,
        'description' => 'Description for provider ' . $i,
        'phone' => '012345678' . $i,
        'whatsapp' => '012345678' . $i,
        'facebook' => 'https://facebook.com/provider' . $i,
        'instagram' => 'https://instagram.com/provider' . $i,
        'image' => null,
        'gallery' => json_encode([]),
        'contract_start' => now()->subMonths($i),
        'contract_end' => now()->addMonths($i),
        'status' => ServiceProviderEnum::ACTIVE->value,
        'views' => rand(0, 100),
        'category_id' => rand(1, 6),
        'subcategory_id' => rand(1, 2),
        'state_id' => rand(1, 3),
        'city_id' => rand(1, 5),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    // جلب المزود من الموديل
    $provider = ServiceProvider::find($providerId);

    // اختيار تاغات عشوائية وربطها
    $randomTags = Tag::inRandomOrder()->take(rand(2, 18))->pluck('id')->toArray();
    $provider->tags()->attach($randomTags);
}

    }
    }

