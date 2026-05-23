<?php

namespace Database\Seeders;

use App\Models\Courier;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourierSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy danh sách tất cả ID của khách hàng và agent đang có sẵn
        $customerIds = DB::table('customers')->pluck('id')->toArray();
        $agentIds = DB::table('agents')->pluck('ID')->toArray(); // Lưu ý cột ID của agents viết hoa theo migration của bạn

        // Nếu chưa có khách hàng hoặc agent nào, sinh tạm 1 vài đơn có id = null để không bị lỗi
        if (empty($customerIds) || empty($agentIds)) {
            Courier::factory()->count(10)->create();
            return;
        }

        // Tạo 100 đơn hàng bưu kiện mẫu
        Courier::factory()->count(100)->make()->each(function ($courier) use ($customerIds, $agentIds) {
            // Gán ngẫu nhiên ID khóa ngoại từ danh sách
            $courier->customer_id = collect($customerIds)->random();
            $courier->agent_id = collect($agentIds)->random();
            $courier->save();
        });
    }
}
