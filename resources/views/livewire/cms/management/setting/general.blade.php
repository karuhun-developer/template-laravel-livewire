<div>
    <x-slot:page-title>
        {{ $title ?? '' }}
    </x-slot:page-title>
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
                                <x-acc-input model="form.name" placeholder="App Name" icon="fa fa-mobile" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Logo</label>
                                <x-acc-image-preview :image="$form->logo" :form_image="$form->old_data->getFirstMediaUrl('logo')"  />
                                <x-acc-input-file model="form.logo" accept="image/*" :$imageIttr />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">App Icon</label>
                                <x-acc-image-preview :image="$form->favicon" :form_image="$form->old_data->getFirstMediaUrl('favicon')" />
                                <x-acc-input-file model="form.favicon" accept="image/*" :$imageIttr />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <x-acc-input type="email" model="form.email" placeholder="Email" icon="fa fa-envelope" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Phone</label>
                                <x-acc-input type="number" model="form.phone" placeholder="Phone" icon="fa fa-phone" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <x-acc-input type="textarea" model="form.address" placeholder="Address" icon="fa fa-map-marker" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Introduction</label>
                                <x-acc-input type="textarea" model="form.about" placeholder="About Us" icon="fa fa-info" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
