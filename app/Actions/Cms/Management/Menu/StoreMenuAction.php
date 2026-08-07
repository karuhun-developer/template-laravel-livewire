<?php

declare(strict_types=1);

namespace App\Actions\Cms\Management\Menu;

use App\DTOs\Cms\Management\Menu\StoreMenuData;
use App\Models\Menu\Menu;

class StoreMenuAction
{
    /**
     * Handle the action.
     */
    public function handle(StoreMenuData $data): Menu
    {
        return Menu::create($data->toArray());
    }
}
