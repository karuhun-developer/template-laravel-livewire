<?php

namespace App\Actions\Cms\Management\Menu;

use App\DTOs\Cms\Management\Menu\UpdateMenuData;
use App\Models\Menu\Menu;

class UpdateMenuAction
{
    /**
     * Handle the action.
     */
    public function handle(Menu $menu, UpdateMenuData $data): bool
    {
        return $menu->update($data->toArray());
    }
}
