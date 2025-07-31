<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('admins')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'phone' => '1234567890',
            'password' => Hash::make('12345678')
        ]);
    }
}
