<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Tạo 1 tài khoản khách hàng cố định để tiện dùng đăng nhập test
        Customer::updateOrCreate(
            ['email' => 'khachhang@gmail.com'],
            [
                'full_name'     => 'Nguyễn Văn Khách Hàng',
                'phone'         => '0987654321',
                'password_hash' => Hash::make('123456@a'),
                'address'       => 'Số 1 Đại Cồ Việt, Bách Khoa, Hai Bà Trưng, Hà Nội',
            ]
        );

        // 2. Tạo thêm 50 tài khoản ngẫu nhiên bằng tiếng Việt từ Factory
        Customer::factory()->count(50)->create();
    }
}
