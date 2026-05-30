<?php

namespace Database\Factories;

use App\Models\Courier;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class CourierFactory extends Factory
{
    protected $model = Courier::class;

    public function definition(): array
    {
        $fakerVi = \Faker\Factory::create('vi_VN');

        // Mảng trạng thái đơn hàng thực tế
        $statuses = ['pending', 'picked_up', 'in_transit', 'delivered', 'cancelled'];

        return [
            // Sinh mã tracking dạng ngẫu nhiên không trùng: CRX-84729103
            'tracking_id'      => 'CRX-' . $this->faker->unique()->numberBetween(10000000, 99999999),
            'sender_name'      => $fakerVi->name(),
            'sender_address'   => $fakerVi->address(),
            'sender_phone'     => $fakerVi->phoneNumber(),
            'receiver_name'    => $fakerVi->name(),
            'receiver_address' => $fakerVi->address(),
            'receiver_phone'   => $fakerVi->phoneNumber(),
            'total_weight'     => $this->faker->randomFloat(2, 0.2, 50.0), // Trọng lượng từ 200g đến 50kg
            'status'           => $this->faker->randomElement($statuses),

            // Tạm thời để null, Seeder sẽ nạp ID thật vào sau để không bị lỗi trống dữ liệu
            'customer_id'      => null,
            'agent_id'         => null,

            'created_at'       => $this->faker->dateTimeBetween('-1 months', 'now'),
            'updated_at'       => now(),
        ];
    }
}
