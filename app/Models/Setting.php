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
        'google_analytics',
        'privacy_policy',
        'term_of_service',
        'mail_email_show',
        'mail_driver',
        'mail_host',
        'mail_port',
        'mail_encryption',
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_from_name',
    ];
}
