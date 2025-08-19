<?php

namespace App\Models\Spatie;

use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Permission extends SpatiePermission
{
    use LogsActivity;

    // Get the activity log options.
    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()->logOnly(['*']);
    }
}
