<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        $this->call([
        //     StateSeeder::class,
        //     CitySeeder::class,
        //       AdminSeeder::class,
        //     CategorySeeder::class,
        //     SubCategorySeeder::class,
        //     TagSeeder::class,
        //   ServiceProviderSeeder::class,
        //   ServiceProviderRequestSeeder::class
        // SliderSeeder::class
        OfferSeeder::class
        ]);
    }
}
