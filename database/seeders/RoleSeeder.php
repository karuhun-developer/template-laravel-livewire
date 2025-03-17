<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public $permissionType = [
        'view',
        'create',
        'update',
        'delete',
    ];
    public $routeExcept = [
        'sanctum.csrf-cookie',
        'livewire.update',
        'livewire.upload-file',
        'livewire.preview-file',
        'ignition.healthCheck',
        'ignition.executeSolution',
        'ignition.updateConfig',
        'profile.edit',
        'profile.update',
        'profile.destroy',
        'login',
        'password.confirm',
        'password.update',
        'logout',
    ];
    public $superadminExcept = [
        // 'cms.dashboard',
    ];
    public $routeUser = [
        'cms.dashboard',
    ];

    public function run(): void
    {
        $superadmin = Role::findOrCreate('superadmin', 'web');
        $user = Role::findOrCreate('user', 'web');

        // Generate Permission
        // Get all route names
        $routes = Route::getRoutes();

        foreach ($routes as $value) {
            $route = $value->getName();
            // Except route
            if(!in_array($route, $this->routeExcept) && !is_null($route)) {
                foreach($this->permissionType as $type) {
                    $permission = $type . '.' . $route;
                    $permission = Permission::findOrCreate($permission, 'web');

                    // Give superadmin permission
                    if(!in_array($route, $this->superadminExcept)) {
                        $superadmin->givePermissionTo($permission);
                    }

                    // Give user permission
                    if(in_array($route, $this->routeUser)) {
                        $user->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
