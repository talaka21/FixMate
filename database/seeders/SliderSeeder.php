<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $serviceProviderIds = DB::table('service_providers')->pluck('id')->toArray();

        // إنشاء 10 سلايدرز
        foreach (range(1, 10) as $i) {
            DB::table('sliders')->insert([
                'title' => 'Slider ' . $i,
                'image' => 'https://via.placeholder.com/600x300?text=Slider+' . $i,// يفترض أن الصور موجودة في storage أو public
                'service_provider_id' => fake()->randomElement($serviceProviderIds),
                'status' => fake()->randomElement(['active', 'inactive']),
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
