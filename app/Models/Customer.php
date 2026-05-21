<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

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
}
