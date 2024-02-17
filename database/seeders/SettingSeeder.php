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
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'email' => 'email@email.com',
            'phone' => '081234567890',
            'address' => 'Jl. Jalan No. 1',
            'about' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'vision' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'mission' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'author' => 'Dulbin Core',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'keywords' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'opengraph' => json_encode([
                'site_name' => 'Dulbin Core',
                'title' => 'Dulbin Core',
                'type' => 'website',
                'url' => 'https://dulbincore.com',
                'image' => 'https://dulbincore.com/logo.png',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            ]),
            'dulbincore' => json_encode([
                'title' => 'Dulbin Core',
                'publisher' => 'Dulbin Core',
                'publisher_url' => 'https://dulbincore.com',
                'creator_name' => 'Dulbin Core',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
                'language' => 'id',
                'subject' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            ]),
            'google_analytics' => 'UA-123456789-1',
        ]);
    }
}
