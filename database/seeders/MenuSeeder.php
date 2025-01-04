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
        $dashboard = Menu::create([
            'name' => 'Dashboard',
            'on' => 'cms',
            'type' => 'item',
            'icon' => 'fa fa-home',
            'route' => 'cms.dashboard',
            'ordering' => '1',
        ]);

        $this->adminMenu();
    }

    public function adminMenu() {
        // Website Setting
        $admin = Menu::create([
            'name' => 'Management',
            'on' => 'cms',
            'type' => 'item',
            'icon' => 'fa fa-cog',
            'route' => '#',
            'ordering' => '90',
        ]);
        $admin->menuChildren()->create([
            'name' => 'Menu',
            'icon' => '#',
            'route' => 'cms.management.menu',
            'ordering' => '1',
        ]);

        $admin->menuChildren()->create([
            'name' => 'Role',
            'icon' => '#',
            'route' => 'cms.management.role',
            'ordering' => '2',
        ]);
        $admin->menuChildren()->create([
            'name' => 'User',
            'icon' => '#',
            'route' => 'cms.management.user',
            'ordering' => '3',
        ]);
        $admin->menuChildren()->create([
            'name' => 'Setting',
            'icon' => '#',
            'route' => 'cms.management.general-setting',
            'ordering' => '4',
        ]);
        $admin->menuChildren()->create([
            'name' => 'Access Control',
            'icon' => '#',
            'route' => 'cms.management.access-control',
            'ordering' => '5',
        ]);
    }
 }
