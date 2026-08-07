<?php

declare(strict_types=1);

namespace App\Models\Menu;

use App\Enums\CommonStatusEnum;
use App\Models\Spatie\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\Models\Concerns\LogsActivity;
use Spatie\Activitylog\Support\LogOptions;

class MenuSub extends Model
{
    use LogsActivity;

    protected $fillable = [
        'role_id',
        'menu_id',
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
     * @return BelongsTo<Menu, $this>
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
}
