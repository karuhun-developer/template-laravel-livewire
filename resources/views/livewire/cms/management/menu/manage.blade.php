<div>
    <x-acc-back :route="substr($originRoute, 0, -7)" />
    <h1 class="h3 mb-3 mt-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">{{ $title ?? '' }}</h5>
                    </div>
                    <x-acc-form submit="save">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <x-acc-input type="text" model="form.name" placeholder="Name" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">On</label>
                                <x-acc-input type="select" :live="true" model="form.on">
                                    <option value="">--Select Type--</option>
                                    <option value="cms">Cms</option>
                                    <option value="web">Web</option>
                                </x-acc-input>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Type</label>
                                <x-acc-input type="select" model="form.type">
                                    <option value="">--Select Type--</option>
                                    <option value="header">Header</option>
                                    <option value="item">Item</option>
                                </x-acc-input>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <x-acc-input type="text" model="form.icon" placeholder="Icon" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Route</label>
                                <x-acc-input type="text" model="form.route" placeholder="Route" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Ordering</label>
                                <x-acc-input type="number" model="form.ordering" placeholder="Ordering" />
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
                                    <x-acc-input type="textarea" model="form.meta.description" placeholder="Description" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Website Keywords</label>
                                    <x-acc-input type="textarea" model="form.meta.keywords" placeholder="Keywords" />
                                </div>
                            </div>
                        @endif
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
