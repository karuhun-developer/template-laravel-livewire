<?php

namespace App\Livewire;

use App\Traits\WithChangeOrder;
use App\Traits\WithGetFilterData;
use App\Traits\WithResetAction;
use Livewire\WithPagination;
use Livewire\Component;
use App\Traits\WithCreateAction;
use App\Traits\WithDeleteAction;
use App\Traits\WithEditAction;
use App\Traits\WithSaveAction;

class BaseComponent extends Component {
    use WithPagination,
        WithChangeOrder,
        WithGetFilterData,
        WithResetAction,
        WithCreateAction,
        WithEditAction,
        WithDeleteAction,
        WithSaveAction;

    public $originRoute = '';

    // Image iterator for image set null after save
    public $imageIttr = 1;

    public function __construct()
    {
        $this->originRoute = request()->route()->getName();
    }
}
