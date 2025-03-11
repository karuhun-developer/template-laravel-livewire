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
                                <label class="form-label">Email (show)</label>
                                <x-acc-input type="email" model="form.mail_email_show" placeholder="Email to show" icon="fa fa-envelope" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Driver</label>
                                <x-acc-input model="form.mail_driver" placeholder="Driver" icon="fa fa-drivers-license" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Host</label>
                                <x-acc-input model="form.mail_host" placeholder="Host" icon="fa fa-server" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Port</label>
                                <x-acc-input type="number" model="form.mail_port" placeholder="Port" icon="fa fa-plug" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Encryption</label>
                                <x-acc-input model="form.mail_encryption" placeholder="Encryption" icon="fa fa-lock" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <x-acc-input type="email" model="form.mail_username" placeholder="Username" icon="fa fa-user" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <x-acc-input type="password" model="form.mail_password" placeholder="Password" icon="fa fa-key" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">From Name</label>
                                <x-acc-input model="form.mail_from_name" placeholder="From Name" icon="fa fa-signature" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">From Address</label>
                                <x-acc-input model="form.mail_from_address" placeholder="From Address" icon="fa fa-envelope" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
