<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Seeder;

class TruncateTable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::truncate();
        User::truncate();
        Menu::truncate();
    }
}
