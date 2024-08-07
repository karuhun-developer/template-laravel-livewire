<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia;

    public static $FILE_PATH = 'settings';
    protected $fillable = [
        'name',
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

    // Get the activity log options.
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logOnly([
            'name',
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
        ]);
    }
}
