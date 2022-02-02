<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaveFood extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_of_peoples',
        'address',
        'lat',
        'lng',
        'image',
        'city',
        'zip_code',
        'message' 
    ];
}
