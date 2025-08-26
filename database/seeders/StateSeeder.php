<?php

namespace Database\Seeders;

use App\Models\state;
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
$states = [
            [
                'name' => [
                    'en' => 'Syria',
                    'ar' => 'سوريا',
                ],
            ],
            [
                'name' => [
                    'en' => 'Lebanon',
                    'ar' => 'لبنان',
                ],
            ],
            [
                'name' => [
                    'en' => 'United Arab Emirates',
                    'ar' => 'الإمارات العربية المتحدة',
                ],
            ],
        ];

        foreach ($states as $state) {
            State::create($state);
        }
}
}
