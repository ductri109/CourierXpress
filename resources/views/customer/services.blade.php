@extends('customer.layout')

@section('title', 'Dịch Vụ - CourierXpress')

@section('content')
    <main class="flex-grow pt-32 pb-20 px-6">
        <div class="max-w-6xl mx-auto space-y-24">

            {{-- Hero --}}
            <div class="text-center space-y-5">
            <span class="inline-block bg-primary-50 text-primary-600 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full border border-primary-100">
                Giải pháp vận chuyển
            </span>
                <h2 class="text-5xl font-black text-gray-900 tracking-tight leading-tight">
                    Dịch Vụ <span class="gradient-text">CourierXpress</span>
                </h2>
                <p class="text-gray-500 text-xl max-w-2xl mx-auto font-medium leading-relaxed">
                    Chúng tôi cung cấp đa dạng giải pháp logistics — từ giao hàng nhanh đến quản lý kho bãi toàn diện, đáp ứng mọi quy mô doanh nghiệp.
                </p>
            </div>

            {{-- Dịch vụ chính --}}
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                    <span class="w-8 h-1 bg-primary-600 rounded-full"></span>
                    Dịch Vụ Chính
                </h3>
                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Giao hàng tiêu chuẩn --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="package" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Giao Hàng Tiêu Chuẩn</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Dịch vụ vận chuyển nội địa với thời gian giao từ 2–5 ngày làm việc. Phù hợp cho hàng hóa thông thường với chi phí tối ưu và độ tin cậy cao.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Phạm vi toàn quốc 63 tỉnh thành</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Khối lượng tối đa 50kg/kiện</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Bảo hiểm hàng hóa theo giá trị</li>
                        </ul>
                    </div>

                    {{-- Giao hàng hỏa tốc --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="zap" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Giao Hàng Hỏa Tốc</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Dịch vụ ưu tiên tốc độ — giao trong ngày hoặc trong vòng 24 giờ. Lý tưởng cho tài liệu khẩn, hàng thời vụ, hoặc đơn thương mại điện tử.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Giao trong ngày tại nội thành</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Theo dõi thời gian thực</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Xác nhận giao hàng tức thì</li>
                        </ul>
                    </div>

                    {{-- Kho bãi & Fulfillment --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="warehouse" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Kho Bãi & Fulfillment</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Giải pháp lưu kho linh hoạt kết hợp xử lý đơn hàng tự động. Giúp doanh nghiệp tập trung vào bán hàng, chúng tôi lo toàn bộ hậu cần.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Hệ thống WMS quản lý tồn kho</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Đóng gói & dán nhãn chuyên nghiệp</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Tích hợp Shopee, Lazada, TikTok Shop</li>
                        </ul>
                    </div>

                    {{-- Tích hợp API --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="code-2" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Tích Hợp API</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Kết nối hệ thống của bạn với nền tảng CourierXpress qua RESTful API. Tự động hóa việc tạo vận đơn, tra cứu và cập nhật trạng thái theo thời gian thực.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> RESTful API chuẩn, có Sandbox</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Webhook cập nhật trạng thái đơn</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Tài liệu kỹ thuật đầy đủ</li>
                        </ul>
                    </div>

                </div>
            </div>

            {{-- Bảng giá cước --}}
            <div class="space-y-8">
                <div class="text-center space-y-2">
                    <h3 class="text-2xl font-bold text-gray-900">Bảng Giá Cước Tham Khảo</h3>
                    <p class="text-gray-500">Giá chưa bao gồm phụ phí xa trung tâm và hàng đặc biệt. Liên hệ để báo giá theo khối lượng.</p>
                </div>
                <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="bg-gray-50 text-gray-600 font-semibold">
                            <th class="text-left px-6 py-4">Dịch vụ</th>
                            <th class="text-left px-6 py-4">Phạm vi</th>
                            <th class="text-left px-6 py-4">Thời gian</th>
                            <th class="text-left px-6 py-4">Giá từ</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Giao tiêu chuẩn</td>
                            <td class="px-6 py-4 text-gray-500">Toàn quốc</td>
                            <td class="px-6 py-4 text-gray-500">2–5 ngày</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">15.000₫</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Giao hỏa tốc</td>
                            <td class="px-6 py-4 text-gray-500">Nội thành</td>
                            <td class="px-6 py-4 text-gray-500">Trong ngày</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">35.000₫</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Giao liên tỉnh nhanh</td>
                            <td class="px-6 py-4 text-gray-500">Toàn quốc</td>
                            <td class="px-6 py-4 text-gray-500">1–2 ngày</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">25.000₫</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Fulfillment</td>
                            <td class="px-6 py-4 text-gray-500">Toàn quốc</td>
                            <td class="px-6 py-4 text-gray-500">Theo SLA</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">Liên hệ</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Vì sao chọn chúng tôi --}}
            <div class="bg-gray-900 rounded-[3rem] p-12 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-80 h-80 bg-primary-600 rounded-full opacity-5 translate-x-24 -translate-y-24"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-10 text-center">Vì Sao Chọn CourierXpress?</h3>
                    <div class="grid md:grid-cols-4 gap-8 text-center">
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-primary-400">
                                <i data-lucide="shield-check" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">An Toàn Tuyệt Đối</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Bảo hiểm hàng hóa 100% giá trị, đền bù nhanh chóng khi xảy ra sự cố.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-orange-400">
                                <i data-lucide="clock" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">Đúng Giờ Cam Kết</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Tỷ lệ giao đúng hẹn trên 98% — SLA được ký kết rõ ràng với từng gói dịch vụ.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-blue-400">
                                <i data-lucide="map-pin" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">Theo Dõi Thời Gian Thực</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Cập nhật trạng thái từng bước, tích hợp thông báo SMS và email tự động.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-green-400">
                                <i data-lucide="headphones" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">Hỗ Trợ 24/7</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Đội ngũ CSKH luôn sẵn sàng qua hotline, chat và email mọi lúc mọi nơi.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="text-center space-y-6">
                <h3 class="text-3xl font-bold text-gray-900">Sẵn sàng bắt đầu?</h3>
                <p class="text-gray-500 max-w-xl mx-auto">Tạo tài khoản miễn phí và trải nghiệm ngay nền tảng quản lý vận chuyển thông minh của CourierXpress.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}"
                       class="bg-primary-600 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-primary-700 transition-all shadow-md hover:shadow-lg">
                        Đăng ký miễn phí
                    </a>
                    <a href="{{ route('contact') }}"
                       class="border border-gray-200 text-gray-700 px-8 py-3.5 rounded-xl font-semibold hover:border-primary-300 hover:text-primary-600 transition-all">
                        Liên hệ tư vấn
                    </a>
                </div>
            </div>

        </div>
    </main>
@endsection
