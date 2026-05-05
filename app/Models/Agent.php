<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = [
        'FullName', 
        'Phone', 
        'Email', 
        'Username', 
        'PasswordHash', 
        'Status',
    ];
}
