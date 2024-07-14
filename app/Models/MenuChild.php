<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuChild extends Model
{
    use HasFactory;

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
}
