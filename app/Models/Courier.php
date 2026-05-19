<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = [
        'tracking_id',
        'sender_name',
        'sender_address',
        'receiver_name',
        'receiver_address',
        'total_weight',
        'status',
        'customer_id',
        'agent_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * Thêm quan hệ với Agent để agent có thể xem đơn hàng được gán
     */
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id', 'ID');
    }
}
