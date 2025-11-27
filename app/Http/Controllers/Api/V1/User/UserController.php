<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Spatie\Role;
use App\Models\User;
use App\Traits\WithGetFilterDataApi;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use WithGetFilterDataApi;

    protected string $model = User::class;

    public function index(Request $request)
    {
        $this->authorize('view'.$this->model);

        $model = User::query()->with('roles');

        // Filter by role id
        if ($request?->role_id) {
            $model->whereHas('roles', function ($query) use ($request) {
                $query->where('id', $request->role_id);
            });
        }

        $model = $this->getDataWithFilter(
            model: $model,
            searchBy: [
                'name',
                'email',
                'phone',
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

    public function show(User $model)
    {
        $this->authorize('show'.$this->model);

        if (! auth()->user()->isSuperAdmin() && auth()->id() != $model->id) {
            return $this->responseWithError('You only can view your own profile.', 403);
        }

        return $this->responseWithSuccess($model->load('roles'));
    }

    public function store(Request $request)
    {
        $this->authorize('create'.$this->model);

        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'nullable|string|unique:users,phone',
            'password' => 'required|string|min:8|confirmed',
            'status' => 'required|boolean',
        ]);
        $data['password'] = bcrypt($data['password']);
        // Assign role to user
        $role = Role::find($data['role_id']);

        // If role is teacher, student or guardian reject the request
        if (in_array($role->name, ['teacher', 'student', 'guardian'])) {
            return $this->responseWithError('Cannot assign this role to user. Please use specific endpoints for creating teachers, students, or guardians.', 422);
        }

        $model = User::create($data);

        $model->syncRoles([$role]);

        return $this->responseWithCreated($model);
    }

    public function update(Request $request, User $model)
    {
        $this->authorize('update'.$this->model);

        if (! auth()->user()->isSuperAdmin() && auth()->id() != $model->id) {
            return $this->responseWithError('You only can update your own profile.', 403);
        }

        $data = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$model->id,
            'phone' => 'nullable|string|max:255|unique:users,phone,'.$model->id,
            'status' => 'required|boolean',
        ]);
        // Assign role to user
        $role = Role::find($data['role_id']);

        // If role is teacher, student or guardian reject the request
        if (in_array($role->name, ['teacher', 'student', 'guardian'])) {
            return $this->responseWithError('Cannot assign this role to user. Please use specific endpoints for creating teachers, students, or guardians.', 422);
        }

        $model->syncRoles([$role]);
        $model->update($data);

        return $this->responseWithSuccess($model);
    }

    public function updatePassword(Request $request, User $model)
    {
        $this->authorize('update'.$this->model);

        if (! auth()->user()->isSuperAdmin() && auth()->id() != $model->id) {
            return $this->responseWithError('You only can update your own profile.', 403);
        }

        $data = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $model->update($data);

        return $this->responseWithSuccess($model);
    }

    public function validateEmail(User $model)
    {
        $this->authorize('validate'.$this->model);

        $model->markEmailAsVerified();

        return $this->responseWithSuccess($model);
    }

    public function destroy(User $model)
    {
        $this->authorize('delete'.$this->model);

        return $this->responseWithSuccess($model->delete());
    }
}
