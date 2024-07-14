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
                                <label class="form-label">Email (show)</label>
                                <x-acc-input type="email" model="form.mail_email_show" placeholder="Email to show" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Driver</label>
                                <x-acc-input type="text" model="form.mail_driver" placeholder="Driver" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Host</label>
                                <x-acc-input type="text" model="form.mail_host" placeholder="Host" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Port</label>
                                <x-acc-input type="number" model="form.mail_port" placeholder="Port" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Encryption</label>
                                <x-acc-input type="text" model="form.mail_encryption" placeholder="Encryption" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <x-acc-input type="email" model="form.mail_username" placeholder="Username" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <x-acc-input type="password" model="form.mail_password" placeholder="Password" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">From Name</label>
                                <x-acc-input type="text" model="form.mail_from_name" placeholder="From Name" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">From Address</label>
                                <x-acc-input type="text" model="form.mail_from_address" placeholder="From Address" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</x-acc-with-alert>
