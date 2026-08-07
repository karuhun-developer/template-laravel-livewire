<?php

declare(strict_types=1);

namespace App\Models\Menu;

use App\Enums\CommonStatusEnum;
use App\Models\Spatie\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class Menu extends Model
{
    use LogsActivity;

    protected $fillable = [
        'role_id',
        'name',
        'url',
        'icon',
        'order',
        'active_pattern',
        'status',
    ];

    protected $casts = [
        'status' => CommonStatusEnum::class,
    ];

    // Get the activity log options.
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly(['*']);
    }

    /**
     * @return BelongsTo<Role, $this>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return HasMany<MenuSub, $this>
     */
    public function subMenu(): HasMany
    {
        return $this->hasMany(MenuSub::class, 'menu_id')->orderBy('order', 'asc');
    }
}
