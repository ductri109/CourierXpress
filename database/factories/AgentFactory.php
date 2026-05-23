<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AgentFactory extends Factory
{
    protected $model = Agent::class;

    public function definition(): array
    {
        $fakerVi = \Faker\Factory::create('vi_VN');

        // Tạo tên đầy đủ tiếng Việt
        $fullName = $fakerVi->name();

        // Chuyển tên tiếng Việt thành username dạng: nguyenvanb, hoangthic...
        $username = Str::slug($fullName, '');

        return [
            'FullName'     => $fullName,
            'Phone'        => $fakerVi->unique()->phoneNumber(),
            'Email'        => $this->faker->unique()->safeEmail(),
            'Username'     => $username . $this->faker->numberBetween(10, 99), // Tránh trùng lặp username
            'PasswordHash' => Hash::make('123456@a'), // Mật khẩu test chung cho các Agent
            'Status'       => $this->faker->randomElement(['active', 'active', 'inactive']), // Tỷ lệ active cao hơn
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
