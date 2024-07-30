<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::insert([
            [
                'name' => 'Dashboard',
                'on' => 'cms',
                'type' => 'item',
                'icon' => 'fa fa-home',
                'route' => 'cms.dashboard',
                'ordering' => '1',
            ],
            // Master Data

            // Settings
            [
                'name' => 'Settings',
                'on' => 'cms',
                'type' => 'header',
                'icon' => '#',
                'route' => '#',
                'ordering' => '30',
            ],
            [
                'name' => 'Menu',
                'on' => 'cms',
                'type' => 'item',
                'icon' => 'fa fa-bars',
                'route' => 'cms.management.menu',
                'ordering' => '31',
            ],
            [
                'name' => 'Role',
                'on' => 'cms',
                'type' => 'item',
                'icon' => 'fa fa-lock',
                'route' => 'cms.management.role',
                'ordering' => '33',
            ],
            [
                'name' => 'User',
                'on' => 'cms',
                'type' => 'item',
                'icon' => 'fa fa-user',
                'route' => 'cms.management.user',
                'ordering' => '34',
            ],
            [
                'name' => 'Setting',
                'on' => 'cms',
                'type' => 'item',
                'icon' => 'fa fa-cog',
                'route' => 'cms.management.general-setting',
                'ordering' => '35',
            ],
            [
                'name' => 'Access Control',
                'on' => 'cms',
                'type' => 'item',
                'icon' => 'fa fa-key',
                'route' => 'cms.management.access-control',
                'ordering' => '36',
            ],
        ]);
    }
}
