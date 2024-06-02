<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <x-acc-header :$originRoute createAction="customCreate">
                    <div class="col-md-6">
                        <div class="mt-3">
                            <label class="form-label fw-bold">Menu On</label>
                            <select wire:model.live="on" class="form-control">
                                <option value="cms">CMS</option>
                                <option value="web">Web</option>
                            </select>
                        </div>
                    </div>
                </x-acc-header>
                <table class="table table-hover table-striped" style="width:100%">
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
                                <x-acc-update-delete :id="$d->id" :$originRoute editFunction="customEdit" />
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100" class="text-center">
                                    No Data Found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="float-end">
                    {{ $get->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- Create / Update Modal --}}
    <x-acc-modal title="{{ $isUpdate ? 'Update' : 'Create' }} {{ $title }}">
        <x-acc-form submit="save">
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" wire:model="form.name" class="form-control" placeholder="Name">
                    <x-acc-input-error for="form.name" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">On</label>
                    <select wire:model.live="form.on" class="form-control">
                        <option value="">--Select Type--</option>
                        <option value="cms">Cms</option>
                        <option value="web">Web</option>
                    </select>
                    <x-acc-input-error for="form.on" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Type</label>
                    <select wire:model="form.type" class="form-control">
                        <option value="">--Select Type--</option>
                        <option value="header">Header</option>
                        <option value="item">Item</option>
                    </select>
                    <x-acc-input-error for="form.type" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" wire:model="form.icon" class="form-control" placeholder="Icon">
                    <x-acc-input-error for="form.icon" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Route</label>
                    <input type="text" wire:model="form.route" class="form-control" placeholder="Route">
                    <x-acc-input-error for="form.route" />
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Ordering</label>
                    <input type="number" wire:model="form.ordering" class="form-control" placeholder="Ordering">
                    <x-acc-input-error for="form.ordering" />
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
                        <label class="form-label">Website Description</label>
                        <textarea wire:model="form.meta.description" class="form-control" placeholder="Description"></textarea>
                        <x-acc-input-error for="form.meta.description" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Website Keywords</label>
                        <textarea wire:model="form.meta.keywords" class="form-control" placeholder="Keywords"></textarea>
                        <x-acc-input-error for="form.meta.keywords" />
                    </div>
                </div>
            @endif
        </x-acc-form>
    </x-acc-modal>
</div>
