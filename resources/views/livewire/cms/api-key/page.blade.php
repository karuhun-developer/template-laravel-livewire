<?php

use App\Enums\CommonStatusEnum;
use App\Livewire\BaseComponent;
use App\Models\User\ApiKey;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;

new class extends BaseComponent {
    public string $title = 'API Keys Management';
    public string $description = 'Tokens you have generated that can be used to access the application programming interface (API).';
    public string $modelInstance = ApiKey::class;

    // Check permissions
    public function mount() {
        $this->canDo('view.' . $this->modelInstance);
    }

    // Properties
    public string $apiKeyName;
    public ?string $latestApiKey;

    public function with() {
        return [
            'apikeys' => auth()->user()->apiKeys,
        ];
    }

    public function generateApiKey() {
        // Create a new API key
        $salt = Str::password(15);

        // Save the API key to the user
        $apiKey = auth()->user()->apiKeys()->create([
            'name' => $this->apiKeyName,
            'salt' => bcrypt($salt),
            'expired_at' => null,
            'last_used_at' => null,
            'status' => CommonStatusEnum::ACTIVE,
        ]);

        $apiKey = [
            'id' => $apiKey->id,
            'salt' => $salt,
        ];

        $this->latestApiKey = Crypt::encrypt($apiKey);

        $this->dispatch('alert', type: 'success', message: 'API Key generated successfully. Please copy your new API key now as it won\'t be shown again.');
    }

    #[On('regenerateApiKey')]
    public function regenerateApiKey($id) {
        // Find the API key
        $apiKey = auth()->user()->apiKeys()->find($id);

        // Create a new API key
        $salt = Str::password(15);

        $apiKey->update([
            'salt' => bcrypt($salt),
        ]);

        $this->latestApiKey = Crypt::encrypt([
            'id' => $id,
            'salt' => $salt,
        ]);

        $this->dispatch('alert', type: 'success', message: 'API Key regenerated successfully. Please copy your new API key now as it won\'t be shown again.');
    }

    #[On('delete')]
    public function delete($id) {
        // Find the API key
        $apiKey = auth()->user()->apiKeys()->find($id);

        $apiKey->delete();

        $this->latestApiKey = null;

        $this->dispatch('alert', type: 'success', message: 'API Key deleted successfully.');
    }

}; ?>

<div>
    <div class="row">
        <div class="col-12">
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">
                                {{ $title }}
                            </h5>
                            <p class="text-sm mb-0">
                                {{ $description }}
                            </p>
                        </div>
                        <div class="ms-auto my-auto mt-lg-0">
                            <div class="ms-auto my-auto">
                                <x-cms.action.create-btn :$modelInstance link="#" x-on:click.prevent="window.Swal.fire({
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
                                });">
                                    <i class="fas fa-plus me-2"></i>
                                    Generate New API Key
                                </x-cms.action.create-btn>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header position-relative">
                    <div class="row mt-1">
                        <div class="col-md-12">
                            @if($latestApiKey)
                                <div class="alert bg-gradient-dark align-items-center text-white" role="alert">
                                    <p x-ref="apikey">
                                        {{ $latestApiKey }}
                                    </p>
                                    <button class="btn btn-primary" x-on:click="
                                        navigator.clipboard.writeText($refs.apikey.innerText);
                                        window.Toast.fire({
                                            icon: 'success',
                                            title: 'API Key copied to clipboard.'
                                        })
                                    ">
                                        <i class="fa fa-copy me-2"></i>
                                        Copy API Key
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body pb-4">
                    @forelse ($apikeys as $apiKey)
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h5 class="card-title mb-2 d-flex align-items-center">
                                            <i class="fas fa-key text-primary me-2"></i>
                                            {{ $apiKey->name }}
                                        </h5>
                                        <div class="text-muted small">
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="fas fa-calendar-plus me-2"></i>
                                                Created on {{ $apiKey->created_at->format('M d, Y \a\t H:i') }}
                                            </div>
                                            @if($apiKey->last_used_at)
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-clock me-2"></i>
                                                    Last used {{ $apiKey->last_used_at->diffForHumans() }}
                                                </div>
                                            @else
                                                <div class="d-flex align-items-center text-warning">
                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                    Never used
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <button class="btn bg-gradient-dark btn-sm" x-on:click.prevent="$wire.dispatch('confirm', {
                                            function: 'regenerateApiKey',
                                            id: '{{ $apiKey->id }}',
                                            message: 'Are you sure you want to regenerate this API key?'
                                        })">
                                            <i class="fas fa-sync me-2"></i>
                                            Regenerate
                                        </button>
                                        <button class="btn btn-primary btn-sm" x-on:click.prevent="$wire.dispatch('confirm', {
                                            function: 'delete',
                                            id: '{{ $apiKey->id }}',
                                            message: 'Are you sure you want to delete this API key? This action cannot be undone.'
                                        })">
                                            <i class="fas fa-trash me-2"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-key fa-3x text-muted"></i>
                            </div>
                            <h5 class="text-muted">No API Keys Found</h5>
                            <p class="text-muted mb-3">
                                You haven't created any API keys yet. Generate your first one to get started.
                            </p>
                            <button class="btn btn-primary" x-on:click.prevent="window.Swal.fire({
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
                            });">
                                <i class="fas fa-plus me-2"></i>
                                Generate First API Key
                            </button>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
