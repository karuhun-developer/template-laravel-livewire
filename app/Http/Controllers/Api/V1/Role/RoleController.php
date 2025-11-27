<?php

namespace App\Http\Controllers\Api\V1\Role;

use App\Http\Controllers\Controller;
use App\Models\Spatie\Role;
use App\Traits\WithGetFilterDataApi;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use WithGetFilterDataApi;

    protected string $model = Role::class;

    public function index(Request $request)
    {
        $this->authorize('view'.$this->model);

        $model = $this->getDataWithFilter(
            model: new Role,
            searchBy: [
                'name',
                'guard_name',
                'created_at',
                'updated_at',
            ],
            orderBy: $request?->orderBy ?? 'updated_at',
            order: $request?->order ?? 'desc',
            paginate: $request?->paginate ?? 10,
            searchBySpecific: $request?->searchBySpecific ?? '',
            s: $request?->search ?? '',
        );

        return $this->responseWithSuccess($model);
    }

    public function show(Role $model)
    {
        $this->authorize('show'.$this->model);

        return $this->responseWithSuccess($model);
    }

    public function store(Request $request)
    {
        $this->authorize('create'.$this->model);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);
        $data['guard_name'] = 'api';
        $model = Role::create($data);

        return $this->responseWithCreated($model);
    }

    public function update(Request $request, Role $model)
    {
        $this->authorize('update'.$this->model);

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$model->id,
        ]);
        $model->update($data);

        return $this->responseWithSuccess($model);
    }

    public function destroy(Role $model)
    {
        $this->authorize('delete'.$this->model);

        return $this->responseWithSuccess($model->delete());
    }
}
