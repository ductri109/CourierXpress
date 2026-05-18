<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'password_hash',
        'address',
    ];

    public function couriers()
    {
        return $this->hasMany(Courier::class, 'customer_id');
    }
}
