<?php

namespace App\Livewire\Cms\Management;

use App\Enums\Alert;
use App\Enums\CommonStatusEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Livewire\Attributes\On;
use Livewire\Component;

class AccessControl extends Component
{
    public $title = 'Management Access Control';
    public $apiKeyName;
    public $latestApiKey;

    public function render() {
        $apikeys = Auth::user()->apiKeys;

        return view('livewire.cms.management.access-control', compact('apikeys'))->title($this->title);
    }

    public function generateApiKey() {
        // Create a new API key
        $salt = Str::password(15);

        // Save the API key to the user
        $apiKey = Auth::user()->apiKeys()->create([
            'name' => $this->apiKeyName,
            'salt' => bcrypt($salt),
            'expired_at' => null,
            'last_used_at' => null,
            'status' => CommonStatusEnum::ACTIVE->value,
        ]);

        $apiKey = [
            'id' => $apiKey->id,
            'salt' => $salt,
        ];

        $this->latestApiKey = Crypt::encrypt($apiKey);

        $this->dispatch('alert', type: Alert::success->value, message: 'API Key generated successfully.');
    }

    public function confirmRegenerate($id) {
        $this->dispatch('confirm',
            function: 'regenerateApiKey',
            id: $id,
            title: 'Regenerate Token',
            message: 'Are you sure you want to regenerate this API key?',
            icon: 'question',
            confirmText: 'Regenerate',
        );
    }

    #[On('regenerateApiKey')]
    public function regenerateApiKey($id) {
        // Find the API key
        $apiKey = Auth::user()->apiKeys()->find($id);

        // Create a new API key
        $salt = Str::password(15);

        $apiKey->update([
            'salt' => bcrypt($salt),
        ]);

        $this->latestApiKey = Crypt::encrypt([
            'id' => $id,
            'salt' => $salt,
        ]);

        $this->dispatch('alert', type: Alert::success->value, message: 'API Key regenerated successfully.');
    }

    public function confirmDelete($id) {
        $this->dispatch('confirm',
            function: 'deleteApiKey',
            id: $id,
            title: 'Delete Token',
            message: 'Are you sure you want to delete this API key?',
        );
    }

    #[On('deleteApiKey')]
    public function deleteApiKey($id) {
        // Find the API key
        $apiKey = Auth::user()->apiKeys()->find($id);

        $apiKey->delete();

        $this->latestApiKey = null;

        $this->dispatch('alert', type: Alert::success->value, message: 'API Key deleted successfully.');
    }
}
