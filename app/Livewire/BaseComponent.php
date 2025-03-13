<?php

namespace App\Livewire;

use App\Traits\WithChangeOrder;
use App\Traits\WithGetFilterData;
use App\Traits\WithResetAction;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;
use App\Traits\WithCreateAction;
use App\Traits\WithDeleteAction;
use App\Traits\WithEditAction;
use App\Traits\WithSaveAction;
use App\Traits\InteractWithModal;

class BaseComponent extends Component {
    use WithPagination,
        WithoutUrlPagination,
        WithChangeOrder,
        WithGetFilterData,
        WithResetAction,
        WithCreateAction,
        WithEditAction,
        WithDeleteAction,
        WithSaveAction,
        InteractWithModal;

    public $originRoute = '';
    public $previousUrl = '';

    // Image iterator for image set null after save
    public $imageIttr = 1;
    public $isUpdate = false;
    public $isView = false;

    public function __construct()
    {
        $this->originRoute = request()->route()->getName();
        $this->previousUrl = url()->previous();
    }
}
