<x-acc-with-alert>
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
                                <x-acc-input type="text" model="form.name" placeholder="App Name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Logo</label>
                                <x-acc-image-preview :image="$logo" :form_image="$form->old_data->getFirstMediaUrl('logo')"  />
                                <x-acc-input type="file" model="logo" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Icon</label>
                                <x-acc-image-preview :image="$favicon" :form_image="$form->old_data->getFirstMediaUrl('favicon')" />
                                <x-acc-input type="file" model="favicon" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <x-acc-input type="email" model="form.email" placeholder="Email" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <x-acc-input type="number" model="form.phone" placeholder="Phone" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <x-acc-input type="textarea" model="form.address" placeholder="Address" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">About Us</label>
                                <x-acc-input type="textarea" model="form.about" placeholder="About Us" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Vision</label>
                                <x-acc-input type="textarea" :live="true" model="form.vision" placeholder="Vision" />
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
                                <x-acc-input type="textarea" :live="true" model="form.mission" placeholder="Mission" />
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
</x-acc-with-alert>
