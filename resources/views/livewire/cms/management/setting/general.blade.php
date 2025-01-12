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
                    <x-acc-form submit="save">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">App Name</label>
                                <x-acc-input type="text" model="form.name" placeholder="App Name" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Logo</label>
                                <x-acc-image-preview :image="$form->logo" :form_image="$form->old_data->getFirstMediaUrl('logo')"  />
                                <x-acc-input type="file" model="form.logo" accept="image/*" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Icon</label>
                                <x-acc-image-preview :image="$form->favicon" :form_image="$form->old_data->getFirstMediaUrl('favicon')" />
                                <x-acc-input type="file" model="form.favicon" accept="image/*" />
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
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</x-acc-with-alert>
