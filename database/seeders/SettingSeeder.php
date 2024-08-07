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
            'vision' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'mission' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'google_analytics' => 'UA-123456789-1',
            'mail_email_show' => 'info@example.com',
            'mail_driver' => 'smtp',
            'mail_host' => 'smtp.gmail.com',
            'mail_port' => '587',
            'mail_encryption' => 'tls',
            'mail_username' => 'info@example.com',
            'mail_password' => 'password',
            'mail_from_address' => 'info@example.com',
            'mail_from_name' => 'Dulbin Core',
        ]);
    }
}
