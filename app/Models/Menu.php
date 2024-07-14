<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

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
}
