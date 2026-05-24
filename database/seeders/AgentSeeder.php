<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo 1 bưu cục (Agent) cố định để test đăng nhập
        Agent::updateOrCreate(
            ['Email' => 'agent@gmail.com'],
            [
                'FullName'     => 'Bưu Cục Cầu Giấy - Hà Nội',
                'Phone'        => '02433334444',
                'Username'     => 'agent001',
                'PasswordHash' => Hash::make('123456@a'),
                'Status'       => 'active',
            ]
        );

        // 2. Tạo thêm 15 bưu cục ngẫu nhiên bằng tiếng Việt
        Agent::factory()->count(15)->create();
    }
}
