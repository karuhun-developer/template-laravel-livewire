<?php

declare(strict_types=1);

use App\Enums\CommonStatusEnum;
use App\Models\Menu\Menu;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

function numberToCurrency(int|float $value): string
{
    return number_format($value, 0, ',', '.');
}

function currencyToNumber(string $value): int
{
    return (int) str_replace('.', '', $value);
}

/**
 * @return Collection<int, Menu>
 */
function getMenus(): Collection
{
    $roles = auth()->user()->roles->pluck('id')->toArray();

    return Cache::remember('menu:'.implode(',', $roles), now()->addDay(), fn () => Menu::query()
        ->with('subMenu')
        ->whereIn('role_id', $roles)
        ->where('status', CommonStatusEnum::ACTIVE)
        ->orderBy('order', 'asc')
        ->get()
    );
}
