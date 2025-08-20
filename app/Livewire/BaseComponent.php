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
}
