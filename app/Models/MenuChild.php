<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class MenuChild extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'menu_id',
        'name',
        'icon',
        'route',
        'ordering',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['*']);
    }
}
