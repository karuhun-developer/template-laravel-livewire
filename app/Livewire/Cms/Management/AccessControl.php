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

        $apikey = Crypt::encrypt($user);

        return view('livewire.cms.management.access-control', compact('apikey'))->title($this->title);
    }
}
