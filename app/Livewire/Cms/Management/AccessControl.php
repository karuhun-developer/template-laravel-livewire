<?php

namespace App\Livewire\Cms\Management;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Livewire\Component;

class AccessControl extends Component
{
    public $title = 'Management Access Control';

    public function render()
    {
        $user = Auth::guard('web')->user()->toArray();

        unset($user['id']);
        unset($user['email_verified_at']);
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['permissions']);
        unset($user['roles']);

        $apikey = Crypt::encrypt($user);

        return view('livewire.cms.management.access-control', compact('apikey'))->title($this->title);
    }
}
