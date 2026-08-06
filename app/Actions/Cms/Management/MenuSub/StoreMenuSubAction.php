<?php

namespace App\Actions\Cms\Management\MenuSub;

use App\DTOs\Cms\Management\MenuSub\StoreMenuSubData;
use App\Models\Menu\MenuSub;

class StoreMenuSubAction
{
    /**
     * Handle the action.
     */
    public function handle(StoreMenuSubData $data): MenuSub
    {
        return MenuSub::create($data->toArray());
    }
}
