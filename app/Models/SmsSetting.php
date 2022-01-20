<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'sms_enabled',
        'twilio_sid',
        'twilio_auth_token',
        'twilio_from_no'
    ];
}
