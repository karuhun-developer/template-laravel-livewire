<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'name' => 'Dulbin Core',
            'email' => 'email@email.com',
            'phone' => '081234567890',
            'address' => 'Jl. Jalan No. 1',
            'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        ]);
    }
}
