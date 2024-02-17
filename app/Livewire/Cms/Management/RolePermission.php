<?php

namespace App\Livewire\Cms\Management;


use BaseComponent;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends BaseComponent
{
    public $title = '';
    public $role = null;
    public $permissions = [];
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

    public function mount($role = null) {
        $this->role = Role::findByName($role);
        $this->title = 'Role Permissions - ' . ucfirst($this->role->name);

        $this->getPermission();
        // dd($this->permissions);
    }

    public function render()
    {
        return view('livewire.cms.management.role-permission')->title($this->title);
    }

    // Get role permission
    public function getPermission() {
        // Get all route names
        $routes = Route::getRoutes();

        foreach ($routes as $value) {
            $route = $value->getName();
            // Except route
            if(!in_array($route, $this->routeExcept) && !is_null($route)) {
                $this->permissions[$route] = [];
                foreach($this->permissionType as $type) {
                    $this->permissions[$route][$type . '.' . $route] = false;
                }
            }
        }

        // Get all permissions
        foreach ($this->role->permissions->pluck('name') as $permission) {
            $route = explode('.', $permission);
            /**
             *
             * Ignore type permission name, e.g `view.cms.management.*` to `cms.management.*`
             *
             **/
            unset($route[0]);
            $route = implode('.', $route);
            $this->permissions[$route][$permission] = true;
        }
    }

    // Check all
    public function checkAll() {
        foreach($this->permissions as $key => $value) {
            foreach($value as $k => $v) {
                $this->check($k, $key);
                $this->permissions[$key][$k] = true;
            }
        }
    }

    // Uncheck all
    public function uncheckAll() {
        foreach($this->permissions as $key => $value) {
            foreach($value as $k => $v) {
                $this->uncheck($k, $key);
                $this->permissions[$key][$k] = false;
            }
        }
    }

    // Check
    public function check($permission, $route) {
        $this->isPermissionExist($permission);
        $this->role->givePermissionTo($permission);
        $this->permissions[$route][$permission] = true;
    }

    // Uncheck
    public function uncheck($permission, $route) {
        $this->isPermissionExist($permission);
        $this->role->revokePermissionTo($permission);
        $this->permissions[$route][$permission] = false;
    }

    // Is Permission Exist
    public function isPermissionExist($permission) {
        $isPermissionExist = Permission::where('name', $permission)->first();
        if(is_null($isPermissionExist)) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
