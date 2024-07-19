<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Menu extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'name',
        'on',
        'type',
        'icon',
        'route',
        'ordering',
        'meta',
    ];

    public function getMetaAttribute($value)
    {
        return json_decode($value, true);
    }

    public function menuChildren()
    {
        return $this->hasMany(MenuChild::class, 'menu_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
}
