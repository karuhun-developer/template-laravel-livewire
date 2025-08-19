<?php

namespace App\Models\Spatie;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Role extends SpatieRole
{
    use LogsActivity;

    // Get the activity log options.
    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()->logOnly(['*']);
    }
}
