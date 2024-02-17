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
    public $routeNotulen = [
        'cms.dashboard',
    ];
    public $routePegawai = [
        'cms.dashboard',
    ];

    public function run(): void
    {
        // Hotel app
        $admin = Role::findOrCreate('admin', 'web');
        $notulen = Role::findOrCreate('notulen', 'web');
        $pegawai = Role::findOrCreate('pegawai', 'web');

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

                    // Give admin permission
                    // if(!in_array($route, [
                    //     'cms.',
                    // ])) {
                        $admin->givePermissionTo($permission);
                    // }

                    // Give notulen permission
                    if(in_array($route, $this->routeNotulen)) {
                        // if($route == 'cms.master.hotel' ) {
                            // Where menu hotel, give permission only to view and edit
                            // if($type == 'view' || $type == 'update') {
                                $notulen->givePermissionTo($permission);
                            // }
                        // } else {
                        //     $notulen->givePermissionTo($permission);
                        // }
                    }

                    // Give pegawai permission
                    if(in_array($route, $this->routePegawai)) {
                        $pegawai->givePermissionTo($permission);
                    }
                }
            }
        }
    }
}
