<div>
    <x-slot:page-title>
        {{ $title ?? '' }}
    </x-slot:page-title>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <x-acc-header :$originRoute>
                <div class="col-md-6">
                    <div class="mt-3">
                        <label class="form-label fw-bold">Menu On</label>
                        <x-acc-input type="select" model="on" :live="true" icon="fa fa-list">
                            <option value="cms">CMS</option>
                            <option value="web">Web</option>
                        </x-acc-input>
                    </div>
                </div>
            </x-acc-header>
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
                                <td>{{ $d->on }}</td>
                                <td>{{ $d->type }}</td>
                                <td>{{ $d->icon ?? '' }}</td>
                                <td>{{ $d->route }}</td>
                                <td>{{ $d->ordering }}</td>
                                <x-acc-update-delete :id="$d->id" :$originRoute>
                                    @if($d->type != 'header')
                                        <a class="dropdown-item"
                                            href="{{ route('cms.management.menu.child', ['menu' => $d->id]) }}"
                                            wire:navigate>
                                            <i class="fa fa-list"></i>
                                            <span class="ms-2">
                                                Child Menu
                                            </span>
                                        </a>
                                    @endif
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
                    <label class="form-label">Name <x-acc-required /></label>
                    <x-acc-input model="form.name" placeholder="Name" icon="fa fa-cog" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">On <x-acc-required /></label>
                    <x-acc-input type="select" :live="true" model="form.on" icon="fa fa-toggle-on">
                        <option value="">--Select Type--</option>
                        <option value="cms">Cms</option>
                        <option value="web">Web</option>
                    </x-acc-input>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Type <x-acc-required /></label>
                    <x-acc-input type="select" model="form.type" icon="fa fa-list">
                        <option value="">--Select Type--</option>
                        <option value="header">Header</option>
                        <option value="item">Item</option>
                    </x-acc-input>
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
            @if($form->on == 'web')
                <div class="col-md-12">
                    <div class="mb-3 text-center">
                        <h4>Meta Tag</h4>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Website Description <x-acc-required /></label>
                        <x-acc-input type="textarea" model="form.meta.description" placeholder="Description" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Website Keywords <x-acc-required /></label>
                        <x-acc-input type="textarea" model="form.meta.keywords" placeholder="Keywords" />
                    </div>
                </div>
            @endif
        </x-acc-form>
    </x-acc-modal>
</div>
