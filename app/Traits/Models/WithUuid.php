<?php

namespace App\Traits\Models;
use Illuminate\Support\Str;

trait WithUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::orderedUuid();
        });
    }
}
