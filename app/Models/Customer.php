<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'full_name',
        'email',
        'password_hash',
        'phone',
        'address',
        'fcm_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function couriers()
    {
        // Định nghĩa 1 Customer có nhiều Courier
        return $this->hasMany(Courier::class, 'customer_id', 'id');
    }

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // Không dùng remember_token cho customer
    }

    public function getRememberTokenName()
    {
        return null;
    }
}
