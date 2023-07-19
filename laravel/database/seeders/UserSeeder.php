<?php

namespace Database\Seeders;

use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 100; $i++) {
            User::factory([
                'email' => "user$i@email.com",
                'phone' => "+011$i".'111111'
            ])->create();
        }
    }
}
