<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public static $FILE_PATH = 'settings';
    protected $fillable = [
        'name',
        'logo',
        'favicon',
        'email',
        'phone',
        'address',
        'about',
        'vision',
        'mission',
        'author',
        'description',
        'keywords',
        'opengraph',
        'dulbincore',
        'google_analytics',
        'privacy_policy',
        'term_of_service',
    ];
}
