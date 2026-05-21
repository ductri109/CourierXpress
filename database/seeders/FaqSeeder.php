<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Làm thế nào để tôi tra cứu lộ trình đơn hàng của mình?',
                'answer' => 'Bạn có thể nhập trực tiếp Mã vận đơn (Ví dụ: CX-XXXXXX) vào ô tìm kiếm tại trang "Tra cứu vận đơn" trên thanh Menu chính để xem trạng thái đơn hàng theo thời gian thực.',
                'category' => 'Vận chuyển',
                'sort_order' => 1
            ],
            [
                'question' => 'CourierXpress mất bao lâu để giao một đơn hàng nội tỉnh?',
                'answer' => 'Đối với các đơn hàng nội tỉnh, CourierXpress cam kết giao hàng nhanh chóng trong vòng 4 - 12 giờ làm việc kể từ khi shipper lấy hàng thành công.',
                'category' => 'Vận chuyển',
                'sort_order' => 2
            ],
            [
                'question' => 'Tôi phải làm sao nếu nhập sai mật khẩu quá 5 lần và bị khóa?',
                'answer' => 'Hệ thống sẽ tạm thời khóa tài khoản của bạn trong vòng 5 phút để bảo mật thông tin. Sau 5 phút, bạn có thể tiến hành đăng nhập lại bình thường hoặc sử dụng tính năng "Quên mật khẩu".',
                'category' => 'Tài khoản',
                'sort_order' => 3
            ],
            [
                'question' => 'Làm thế nào để thay đổi thông tin lấy hàng sau khi đã đặt đơn?',
                'answer' => 'Nếu đơn hàng ở trạng thái "Chờ xử lý" (Pending), bạn có thể liên hệ trực tiếp đến số Hotline chăm sóc khách hàng của chúng tôi để nhân viên hỗ trợ cập nhật địa chỉ mới trên hệ thống.',
                'category' => 'Hỗ trợ',
                'sort_order' => 4
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
