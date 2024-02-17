<?php

namespace App\Livewire\Cms\Management;

use App\Livewire\Forms\Cms\Management\FormUser;
use Spatie\Permission\Models\Role;
use App\Models\User as UserModel;
use BaseComponent;

class User extends BaseComponent
{
    public FormUser $form;
    public $title = 'Management User';

    public $searchBy = [
            [
                'name' => 'Name',
                'field' => 'users.name',
            ],
            [
                'name' => 'Email',
                'field' => 'users.email',
            ],
            [
                'name' => 'Role',
                'field' => 'roles.name',
            ],
        ],
        $isUpdate = false,
        $search = '',
        $paginate = 10,
        $orderBy = 'users.name',
        $order = 'asc';

    public $roles = [];

    public function mount() {
        $this->roles = Role::all();
    }

    public function render()
    {
        $model = UserModel::join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.*', 'roles.name as role');

        $get = $this->getDataWithFilter($model, [
            'orderBy' => $this->orderBy,
            'order' => $this->order,
            'paginate' => $this->paginate,
            's' => $this->search,
        ], $this->searchBy);

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.management.user', compact('get'))->title($this->title);
    }
}
