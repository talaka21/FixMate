<?php

namespace Database\Seeders;

use App\Models\ServiceProviderRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceProviderRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceProviderRequest::factory()->count(10)->create();

    }
}
