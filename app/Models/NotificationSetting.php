<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'notifications_enabled',
        'onesignal_app_id',
        'onesignal_restApi_key'
    ];
}
