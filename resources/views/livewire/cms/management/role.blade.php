<div>
    <x-slot:page-title>
        {{ $title ?? '' }}
    </x-slot:page-title>

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
                                <x-acc-update-delete :id="$d->id" :$originRoute>
                                    <a
                                        href="{{ route('cms.management.role-permission', ['role' => $d->name]) }}"
                                        class="dropdown-item"
                                        wire:navigate
                                    >
                                        <i class="fa fa-lock"></i>
                                        <span class="ms-2">
                                            Permission
                                        </span>
                                    </a>
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
    <x-acc-modal title="{{ $isUpdate ? 'Update' : 'Create' }} {{ $title }}" modal="acc-modal">
        <x-acc-form submit="save">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Name <x-acc-required /></label>
                    <x-acc-input model="form.name" placeholder="Name" icon="fa fa-lock" />
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</div>
