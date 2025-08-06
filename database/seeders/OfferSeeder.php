<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\ServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providerIds = ServiceProvider::pluck('id')->toArray();

        if (empty($providerIds)) {
            $this->command->warn('No service providers found. Seeder skipped.');
            return;
        }

        foreach (range(1, 5) as $i) {
            Offer::create([
                'title' => "Special Offer #$i",
                'image' =>  'https://via.placeholder.com/600x300?text=Slider+' . $i,
                'service_provider_id' => $providerIds[array_rand($providerIds)],
                'start_date' => now()->subDays(rand(1, 10)),
                'expire_date' => now()->addDays(rand(5, 15)),
                'status' => 'active',
            ]);
        }

    }
}
