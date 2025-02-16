<div>
    <x-slot:page-title>
        {{ $title ?? '' }}
    </x-slot:page-title>
    <x-acc-back route="cms.management.menu" />
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
                                <td>{{ $d->icon ?? '' }}</td>
                                <td>{{ $d->route }}</td>
                                <td>{{ $d->ordering }}</td>
                                <x-acc-update-delete :id="$d->id" :$originRoute />
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
                    <label class="form-label">Name <x-acc-required /></label>
                    <x-acc-input type="text" model="form.name" placeholder="Name" icon="fa fa-cog" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Icon <x-acc-required /></label>
                    <x-acc-input type="text" model="form.icon" placeholder="Icon" icon="fa fa-cog" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Route <x-acc-required /></label>
                    <x-acc-input type="text" model="form.route" placeholder="Route" icon="fa fa-route" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Ordering <x-acc-required /></label>
                    <x-acc-input type="number" model="form.ordering" placeholder="Ordering" icon="fa fa-sort-numeric-up" />
                </div>
            </div>
        </x-acc-form>
    </x-acc-modal>
</div>
