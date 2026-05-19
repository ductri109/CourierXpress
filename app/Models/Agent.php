<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Authenticatable
{
    use HasFactory;

    protected $table = 'agents';

    // ĐIỀN ĐÚNG TÊN CỘT ID TRONG DATABASE CỦA BẠN VÀO ĐÂY (Phân biệt chữ hoa/thường)
    // Ví dụ nó là chữ ID viết hoa thì phải ghi thế này:
    protected $primaryKey = 'ID';

    protected $fillable = [
        'FullName', 'Username', 'Email', 'Phone', 'PasswordHash', 'Status'
    ];

    public function getAuthPassword()
    {
        return $this->PasswordHash;
    }
}
