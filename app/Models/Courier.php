<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = [
        'tracking_id',      // Thêm dòng này
        'sender_name',
        'sender_address',
        'receiver_name',
        'receiver_address',
        'total_weight',
        'status',
        'customer_id',      // Tương ứng với Userid trong DB
        'agent_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
