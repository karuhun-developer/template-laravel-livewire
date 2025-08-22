<?php

namespace App\Livewire;

use App\Traits\Livewire\WithChangeOrder;
use App\Traits\WithGetFilterData;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Volt\Component;

class BaseComponent extends Component {
    use WithPagination,
        WithoutUrlPagination,
        WithGetFilterData,
        WithChangeOrder;

    public int $imageIttr = 0;

    protected function canDo($permission, $redirect = true) {
        if (auth()->user()->can($permission)) return true;
        session()->flash('error', 'You do not have permission to access this page.');
        if ($redirect) {
            $this->redirect(url()->previous());
        } else {
            // Prevent further execution
            die;
        }
    }
}
