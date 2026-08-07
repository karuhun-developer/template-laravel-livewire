<?php

declare(strict_types=1);

namespace App\Actions\Cms\Management\Menu;

use App\Models\Menu\Menu;

class DeleteMenuAction
{
    /**
     * Handle the action.
     */
    public function handle(Menu $menu): ?bool
    {
        return $menu->delete();
    }
}
