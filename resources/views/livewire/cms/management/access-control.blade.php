<div>
    <x-slot:page-title>
        {{ $title ?? '' }}
    </x-slot:page-title>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ $title ?? '' }} Data</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12" x-data>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tokens you have generated that can be used to access the {{ $settings->name }} API.</label>
                        <button class="btn btn-primary btn-sm" x-on:click="
                            Swal.fire({
                                title: 'Create New Token',
                                text: 'Are you sure you want to create a new token?',
                                icon: 'question',
                                showCancelButton: true,
                                confirmButtonText: 'Create',
                                cancelButtonText: 'Cancel',
                                input: 'text',
                                inputAttributes: {
                                    autocapitalize: 'off'
                                },
                                preConfirm: (name) => {
                                    if (!name) {
                                        Swal.showValidationMessage('Name is required.');
                                    }
                                    return name;
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $wire.apiKeyName = result.value;
                                    $wire.generateApiKey();
                                }
                            });
                        ">
                            <i class="fa fa-plus"></i>
                            <span class="ms-2">
                                Generate New Token
                            </span>
                        </button>
                        @if($latestApiKey)
                            <div class="alert alert-danger fade show" role="alert">
                                <p x-ref="apikey">
                                    {{ $latestApiKey }}
                                </p>
                                <button class="btn btn-primary" x-on:click="navigator.clipboard.writeText($refs.apikey.innerText);window.Toast.fire({
                                    icon: 'success',
                                    title: 'API Key copied to clipboard.'
                                })">
                                    <i class="fa fa-copy"></i>
                                    <span class="ms-2">
                                        Copy Api Key
                                    </span>
                                </button>
                            </div>
                        @endif
                        <ul class="list-group list-group-flush mt-5">
                            @forelse ($apikeys as $apiKey)
                                <li class="list-group-item">
                                    <p class="h2">
                                        {{ $apiKey->name }}
                                        <span class="{{ $apiKey->status->color() }}">
                                            {{ $apiKey->status->label() }}
                                        </span>
                                    </p>
                                    <div class="mt-2">
                                        <small class="text-muted
                                            d-block">
                                            Created on {{ $apiKey->created_at->format('d F Y H:i:s') }}.
                                        </small>
                                        @if($apiKey->last_used_at)
                                            <small class="text-muted
                                                d-block">
                                                Last used within {{ $apiKey->last_used_at->diffForHumans() }}.
                                            </small>
                                        @endif
                                        <div class="mt-2">
                                            <button class="btn btn-primary btn-sm"
                                            wire:click="confirmRegenerate({{ $apiKey->id }})">
                                                <i class="fa fa-sync
                                                    fa-spin"></i>
                                                <span class="ms-2">
                                                    Regenerate
                                                </span>
                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                            wire:click="confirmDelete({{ $apiKey->id }})">
                                                <i class="fa fa-trash"></i>
                                                <span class="ms-2">
                                                    Delete
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="list-group list-group-flush text-center">
                                    <p class="text-muted">
                                        No API keys found.
                                    </p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
