<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourierController extends Controller
{
    protected $fillable = [
        'tracking_id',
        'sender_name',
        'sender_phone',
        'sender_address',
        'receiver_name',
        'receiver_phone',
        'receiver_address',
        'total_weight',
        'status',
        'customer_id',
        'agent_id',
    ];
}
