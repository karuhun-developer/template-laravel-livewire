<?php

namespace App\Actions\Cms\Management\MenuSub;

use App\DTOs\Cms\Management\MenuSub\UpdateMenuSubData;
use App\Models\Menu\MenuSub;

class UpdateMenuSubAction
{
    /**
     * Handle the action.
     */
    public function handle(MenuSub $menuSub, UpdateMenuSubData $data): bool
    {
        return $menuSub->update($data->toArray());
    }
}
