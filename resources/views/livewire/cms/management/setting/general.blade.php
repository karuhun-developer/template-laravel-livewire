<div>
    <h1 class="h3 mb-3">
        {{ $title ?? '' }}
    </h1>
    <div class="row">
        <div class="col-md-3 col-xl-2">
            @include('livewire.cms.management.setting.a-sidebar')
        </div>
        <div class="col-md-9 col-xl-10">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <h5 class="card-title">{{ $title ?? '' }} Data</h5>
                    </div>
                    <x-acc-form submit="saveWithUpload">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">App Name</label>
                                <input type="text" wire:model="form.name" class="form-control" placeholder="App Name">
                                <x-acc-input-error for="form.name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Logo</label>
                                <x-acc-image-preview :image="$logo" :form_image="asset('storage/settings/' . $form->old_data->logo)"  />
                                <input type="file" wire:model="logo" class="form-control">
                                <x-acc-input-error for="logo" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Icon</label>
                                <x-acc-image-preview :image="$favicon" :form_image="asset('storage/settings/' . $form->old_data->favicon)"  />
                                <input type="file" wire:model="favicon" class="form-control">
                                <x-acc-input-error for="favicon" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" wire:model="form.email" class="form-control" placeholder="Email">
                                <x-acc-input-error for="form.email" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <input type="number" wire:model="form.phone" class="form-control" placeholder="Phone">
                                <x-acc-input-error for="form.phone" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea wire:model="form.address" class="form-control" placeholder="Address"></textarea>
                                <x-acc-input-error for="form.address" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">About Us</label>
                                <textarea wire:model="form.about" class="form-control" placeholder="About Us"></textarea>
                                <x-acc-input-error for="form.about" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Vision</label>
                                <textarea wire:model.live="form.vision" class="form-control" placeholder="Vision" rows="5"></textarea>
                                <x-acc-input-error for="form.vision" />

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Preview Vision</label>
                                <x-markdown>{{ $form->vision }}</x-markdown>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mission</label>
                                <textarea id="mission" wire:model="form.mission" class="form-control" placeholder="Mission" rows="5"></textarea>
                                <x-acc-input-error for="form.mission" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Preview Mission</label>
                                <x-markdown>{{ $form->mission }}</x-markdown>
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
