<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers';

    // Mảng cho phép chèn dữ liệu hàng loạt (đã tích hợp fcm_token)
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
}

