@extends('customer.layout')

@section('title', 'Chính sách - CourierXpress')

@section('content')

<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-4xl mx-auto space-y-10">
        <div class="text-center space-y-3">
            <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Quy định & <span class="text-primary-600">Chính sách</span></h2>
            <p class="text-gray-500 text-sm font-medium italic">Cập nhật lần cuối: Tháng 5, 2026</p>
            <div class="h-1 w-16 bg-primary-600 mx-auto rounded-full"></div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-l-8 border-primary-600 p-8 md:p-12">
                <h3 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
                    <i data-lucide="shield-check" class="text-primary-600 w-7 h-7"></i>
                    A. Chính sách bảo mật (Privacy Policy)
                </h3>
                <div class="space-y-8 text-gray-600 leading-relaxed">
                    <section>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">1. Thu thập dữ liệu</h4>
                        <p class="text-sm">Chúng tôi thu thập các thông tin cơ bản bao gồm tên, địa chỉ email, và số điện thoại khi bạn thực hiện đăng ký tài khoản hoặc sử dụng dịch vụ trên hệ thống CourierXpress.</p>
                    </section>

                    <section>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">2. Sử dụng dữ liệu</h4>
                        <p class="text-sm">Dữ liệu thu thập được dùng để xử lý đơn hàng, tối ưu hóa lộ trình giao nhận, cải thiện dịch vụ chăm sóc khách hàng và gửi các thông tin cập nhật hoặc tin nhắn quảng cáo quan trọng.</p>
                    </section>

                    <section>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">3. Bảo mật dữ liệu</h4>
                        <p class="text-sm">Chúng tôi áp dụng các biện pháp kỹ thuật tiên tiến nhất, bao gồm mã hóa SSL (Secure Sockets Layer) 256-bit để bảo vệ thông tin cá nhân và dữ liệu giao dịch của bạn khỏi sự truy cập trái phép.</p>
                    </section>

                    <section>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">4. Chia sẻ dữ liệu</h4>
                        <p class="text-sm">CourierXpress cam kết tuyệt đối không bán, cho thuê hoặc chia sẻ thông tin cá nhân của bạn cho bất kỳ bên thứ ba nào vì mục đích thương mại.</p>
                    </section>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-l-8 border-gray-900 p-8 md:p-12">
                <h3 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
                    <i data-lucide="truck" class="text-gray-900 w-7 h-7"></i>
                    B. Chính sách vận chuyển & Đổi trả
                </h3>
                <div class="space-y-8 text-gray-600 leading-relaxed">
                    <section>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">1. Thời gian bảo hành dịch vụ</h4>
                        <p class="text-sm">Dịch vụ vận chuyển của chúng tôi đi kèm cam kết an toàn hàng hóa. Mọi sản phẩm được vận chuyển thông qua hệ thống đều được bảo vệ trong suốt hành trình cho đến khi ký nhận thành công.</p>
                    </section>

                    <section>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">2. Điều kiện đổi trả / Khiếu nại</h4>
                        <ul class="list-disc ml-5 space-y-2 text-sm">
                            <li>Hàng hóa phải còn nguyên tem niêm phong của CourierXpress tại thời điểm khiếu nại.</li>
                            <li>Sản phẩm chưa qua sử dụng và phải có hóa đơn vận chuyển điện tử (E-receipt) kèm theo.</li>
                            <li>Yêu cầu khiếu nại về hư hỏng phải được thực hiện trong vòng 24h kể từ khi nhận hàng.</li>
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection