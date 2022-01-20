<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMTPSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'host',
        'port',
        'username',
        'password',
        'from_address',
        'encryption',
    ];
}
