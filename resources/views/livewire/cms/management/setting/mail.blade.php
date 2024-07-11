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
                    <x-acc-form submit="save">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Email (show)</label>
                                <input type="text" wire:model="form.mail_email_show" class="form-control" placeholder="Email to show">
                                <x-acc-input-error for="form.mail_email_show" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Driver</label>
                                <input wire:model="form.mail_driver" class="form-control" placeholder="Driver" />
                                <x-acc-input-error for="form.mail_driver" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Host</label>
                                <input wire:model="form.mail_host" class="form-control" placeholder="Host" />
                                <x-acc-input-error for="form.mail_host" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Port</label>
                                <input wire:model="form.mail_port" class="form-control" placeholder="Port" />
                                <x-acc-input-error for="form.mail_port" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Encryption</label>
                                <input wire:model="form.mail_encryption" class="form-control" placeholder="Encryption" />
                                <x-acc-input-error for="form.mail_encryption" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input wire:model="form.mail_username" class="form-control" placeholder="Username" />
                                <x-acc-input-error for="form.mail_username" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input wire:model="form.mail_password" class="form-control" placeholder="Password" />
                                <x-acc-input-error for="form.mail_password" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">From Name</label>
                                <input wire:model="form.mail_from_name" class="form-control" placeholder="From Name" />
                                <x-acc-input-error for="form.mail_from_name" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">From Address</label>
                                <input wire:model="form.mail_from_address" class="form-control" placeholder="From Address" />
                                <x-acc-input-error for="form.mail_from_address" />
                            </div>
                        </div>
                    </x-acc-form>
                </div>
            </div>
        </div>
    </div>
</div>
