<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'issue_type',
        'address',
        'lat',
        'lng',
        'city',
        'zip_code',
        'message' 
    ];
}
