<?php

namespace App\Models\Menu;

use App\Enums\CommonStatusEnum;
use App\Models\Spatie\Role;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

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
    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()->logOnly(['*']);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }
}
