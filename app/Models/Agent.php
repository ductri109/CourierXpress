<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Authenticatable
{
    use HasFactory;

    protected $table = 'agents';
    protected $primaryKey = 'ID';

    protected $fillable = [
        'FullName', 'Username', 'Email', 'Phone', 'PasswordHash', 'Status'
    ];

    public function getAuthPassword()
    {
        return $this->PasswordHash;
    }

    /**
     * Tất cả đơn hàng được gán cho agent này
     */
    public function couriers()
    {
        return $this->hasMany(Courier::class, 'agent_id', 'ID');
    }
}
