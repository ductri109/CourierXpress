<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Courier extends Model
{
    use HasFactory;
    protected $fillable = [
        'tracking_id',
        'sender_name',
        'sender_phone',
        'sender_address',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'goods_type',
        'total_weight',
        'status',
        'customer_id',
        'agent_id',

        'shipping_fee',
        'cod_amount',
        'payment_method',
        'payment_status',
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
