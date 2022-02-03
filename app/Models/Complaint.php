<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

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
        'image',
        'zip_code',
        'message'
    ];


    public function user()
    {
        return $this->belongsTo(Customer::class);
    }
}
