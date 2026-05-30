<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        // Khởi tạo Faker localized Việt Nam
        $fakerVi = \Faker\Factory::create('vi_VN');

        return [
            'full_name'     => $fakerVi->name(),
            'email'         => $this->faker->unique()->safeEmail(), // Giữ safeEmail để không trùng lặp cấu trúc email hệ thống
            'phone'         => $fakerVi->unique()->phoneNumber(),
            'password_hash' => Hash::make('123456@a'), // Mật khẩu mẫu mặc định cho tất cả customer
            'address'       => $fakerVi->address(),
            'created_at'    => $fakerVi->dateTimeBetween('-5 years', 'now'),
            'updated_at'    => now(),
        ];
    }
}
