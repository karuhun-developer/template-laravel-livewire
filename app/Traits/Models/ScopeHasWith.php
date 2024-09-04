<?php

namespace App\Traits\Models;

use Illuminate\Database\Eloquent\Builder;

trait ScopeHasWith {
    public function scopeHasWith(Builder $query, array $relations) {
        foreach($relations as $relation) {
            $query->has($relation)->with($relation);
        }
    }
}
