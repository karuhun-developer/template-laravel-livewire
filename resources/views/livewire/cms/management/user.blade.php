<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-header :$originRoute />
            <div class="table-responsive">
                <x-acc-table>
                    <thead>
                        <tr>
                            <x-acc-loop-th :$searchBy :$orderBy :$order />
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($get as $d)
                            <tr>
                                <td>{{ $d->name }}</td>
                                <td>{{ $d->email }}</td>
                                <td>{{ $d->role }}</td>
                                <x-acc-update-delete :id="$d->id" :$originRoute>
                                    <button class="dropdown-item"
                                        wire:click="editPassword('{{ $d->id }}')">
                                        <i class="fa fa-key"></i>
                                        <span class="ms-2">
                                            Change Password
                                        </span>
                                    </button>
                                </x-acc-update-delete>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100" class="text-center">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </x-acc-table>
            </div>
            <div class="float-end">
                {{ $get->links() }}
            </div>
        </div>
    </div>

    {{-- Create / Update Modal --}}
    <x-acc-modal title="{{ $isUpdate ? 'Update' : 'Create' }} {{ $title }}" :isModaOpen="$modals['defaultModal']">
        <x-acc-form submit="save">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Role <x-acc-required /></label>
                    <x-acc-input type="select" :live="true" model="form.role" icon="fa fa-lock">
                        <option value="">--Select Role--</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Name <x-acc-required /></label>
                    <x-acc-input model="form.name" placeholder="Name" icon="fa fa-user" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Email <x-acc-required /></label>
                    <x-acc-input type="email" model="form.email" placeholder="Email" icon="fa fa-envelope" />
                </div>
            </div>
            @if(!$isUpdate)
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Password <x-acc-required /></label>
                        <x-acc-input type="password" model="form.password" placeholder="********" icon="fa fa-key" />
                    </div>
                </div>
            @endif
        </x-acc-form>
    </x-acc-modal>

    {{-- Change password --}}
    <x-acc-modal title="Change Password {{ $form->name }}" :isModaOpen="$modals['updatePasswordModal']" closeModalFunction="closeModalUpdatePassword">
        <x-acc-form submit="changePassword">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Password <x-acc-required /></label>
                    <x-acc-input type="password" model="form.password" placeholder="********" icon="fa fa-key" />
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</div>
