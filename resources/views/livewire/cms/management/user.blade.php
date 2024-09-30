<x-acc-with-alert>
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
                                <td>{{ $d->roles[0]?->name }}</td>
                                <x-acc-update-delete :id="$d->id" :$originRoute>
                                    <button class="dropdown-item"
                                        wire:click="editPassword('{{ $d->id }}')">
                                        <i class="fa fa-key"></i> Change Password
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
                    <label class="form-label">Role</label>
                    <x-acc-input type="select" :live="true" model="form.role">
                        <option value="">--Select Role--</option>
                        @foreach($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </x-acc-input>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <x-acc-input type="text" model="form.name" placeholder="Name" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <x-acc-input type="email" model="form.email" placeholder="Email" />
                </div>
            </div>
            @if(!$isUpdate)
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <x-acc-input type="password" model="form.password" placeholder="Password" />
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
                    <label class="form-label">Password</label>
                    <x-acc-input type="password" model="form.password" placeholder="Password" />
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</x-acc-with-alert>
