@extends('customer.layout')

@section('title', 'CourierXpress - Giải pháp Logistics toàn diện')

@section('content')

<section class="gradient-hero min-h-screen pt-32 pb-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white space-y-8 scroll-reveal">
                    <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium">Hệ thống đang hoạt động ổn định</span>
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight">
                        Giải pháp Logistics <br><span class="text-yellow-300">toàn diện</span>
                    </h1>

                    <p class="text-xl text-white/90 max-w-xl leading-relaxed">
                        Chào mừng bạn đến với hệ thống CourierXpress. Quản lý vận đơn, tra cứu lộ trình và cập nhật trạng thái realtime dễ dàng hơn bao giờ hết.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        @auth('customer')
                            <a href="{{ route('booking') }}" class="bg-yellow-400 text-primary-900 px-8 py-3.5 rounded-xl font-bold hover:bg-yellow-300 transition-all shadow-lg text-center flex items-center justify-center space-x-2">
                                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                                <span>Tạo Đơn Hàng Mới</span>
                            </a>

                            <a href="#tracking" class="bg-white/20 text-white backdrop-blur-md border border-white/30 px-8 py-3.5 rounded-xl font-bold hover:bg-white/30 transition-all shadow-lg text-center flex items-center justify-center space-x-2">
                                <i data-lucide="search" class="w-5 h-5"></i>
                                <span>Tra Cứu Vận Đơn</span>
                            </a>
                        @endauth
                    </div>

                    <div class="flex space-x-8 pt-6 border-t border-white/20 mt-8">
                        <div>
                            <p class="text-3xl font-bold">63</p>
                            <p class="text-white/70 text-sm">Tỉnh thành</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">24/7</p>
                            <p class="text-white/70 text-sm">Cập nhật Realtime</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">99.8%</p>
                            <p class="text-white/70 text-sm">Đúng tiến độ</p>
                        </div>
                    </div>
                </div>

                <div class="relative scroll-reveal">
                    <div class="relative floating">
                        <img src="data:image/jpeg;base64,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" alt="Logistics Banner"
                            class="rounded-3xl shadow-2xl w-full border-4 border-white/10">

                        <div class="absolute -left-8 top-1/4 bg-white p-4 rounded-2xl shadow-xl animate-bounce" style="animation-duration: 3s;">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Giao thành công</p>
                                    <p class="text-sm text-gray-500">Đơn #CX892341</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -right-4 bottom-1/4 bg-white p-4 rounded-2xl shadow-xl animate-bounce" style="animation-duration: 4s;">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                    <i data-lucide="map-pin" class="w-6 h-6 text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Đang vận chuyển</p>
                                    <p class="text-sm text-gray-500">Cập nhật 1p trước</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Tính năng nổi bật</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3">Mọi thứ bạn cần cho việc quản lý vận đơn</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Trải nghiệm công nghệ logistics hiện đại với đầy đủ tính năng thông minh của CourierXpress</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="map" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Theo dõi real-time</h3>
                    <p class="text-gray-600 leading-relaxed">Xem vị trí đơn hàng của bạn trực tiếp, cập nhật liên tục với độ chính xác cao.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="bell" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Thông báo thông minh</h3>
                    <p class="text-gray-600 leading-relaxed">Nhận thông báo qua SMS, Zalo, Email khi đơn hàng có cập nhật trạng thái mới.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="package-plus" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Tạo đơn siêu tốc</h3>
                    <p class="text-gray-600 leading-relaxed">Hệ thống tạo và quản lý đơn hàng hàng loạt, tiết kiệm tối đa thời gian xử lý.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="shield-check" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Bảo hiểm 100%</h3>
                    <p class="text-gray-600 leading-relaxed">Mọi đơn hàng đều được bảo hiểm giá trị. Hoàn tiền 100% nếu có sự cố trong vòng 24h.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="bar-chart-3" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Thống kê trực quan</h3>
                    <p class="text-gray-600 leading-relaxed">Theo dõi hiệu suất vận chuyển và cước phí với hệ thống báo cáo minh bạch, dễ nhìn.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="headphones" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Hỗ trợ 24/7</h3>
                    <p class="text-gray-600 leading-relaxed">Đội ngũ CSKH luôn sẵn sàng hỗ trợ giải quyết khiếu nại và tra cứu bất kỳ lúc nào.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="tracking" class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-900 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-600/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-primary-600/20 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-5xl mx-auto relative z-10">
            <div class="text-center mb-12 scroll-reveal">
                <span class="text-primary-400 font-semibold text-sm uppercase tracking-wider">Theo dõi đơn hàng</span>
                <h2 class="text-4xl font-bold text-white mt-3">Tra cứu đơn hàng dễ dàng</h2>
                <p class="text-gray-400 mt-4">Nhập mã vận đơn để xem hành trình đơn hàng của bạn trên CourierXpress</p>
            </div>

            <div class="bg-white rounded-3xl p-8 shadow-2xl scroll-reveal">
                <div class="flex flex-col md:flex-row gap-4 mb-8">
                    <div class="flex-1 relative">
                        <i data-lucide="package" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                        <input type="text" placeholder="Ví dụ: CX123456789"
                            class="w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none text-lg font-mono">
                    </div>
                    <button class="bg-primary-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-primary-700 transition-all flex items-center justify-center space-x-2">
                        <i data-lucide="search" class="w-5 h-5"></i>
                        <span>Tra cứu lộ trình</span>
                    </button>
                </div>

                <div class="relative">
                    <div class="absolute left-8 top-0 bottom-0 w-1 bg-gray-200"></div>
                    <div class="absolute left-8 top-0 h-2/3 w-1 tracking-line rounded-full"></div>

                    <div class="space-y-8">
                        <div class="flex items-start space-x-4 relative">
                            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center z-10 shadow-lg">
                                <i data-lucide="check" class="w-8 h-8 text-white"></i>
                            </div>
                            <div class="flex-1 pt-2">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">Giao hàng thành công</h4>
                                        <p class="text-gray-600 mt-1">Người nhận: Nguyễn Văn A - Đã ký nhận</p>
                                    </div>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full whitespace-nowrap">Hôm nay, 14:30</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 relative">
                            <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center z-10 shadow-lg">
                                <i data-lucide="truck" class="w-7 h-7 text-white"></i>
                            </div>
                            <div class="flex-1 pt-2">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">Đang giao hàng</h4>
                                        <p class="text-gray-600 mt-1">Nhân viên tuyến đang vận chuyển đến địa chỉ</p>
                                    </div>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full whitespace-nowrap">Hôm nay, 13:45</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 relative">
                            <div class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center z-10 shadow-lg">
                                <i data-lucide="warehouse" class="w-7 h-7 text-white"></i>
                            </div>
                            <div class="flex-1 pt-2">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">Đến bưu cục phát Quận 7</h4>
                                        <p class="text-gray-600 mt-1">Đơn hàng đã đến kho và đang chờ phân hướng</p>
                                    </div>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full whitespace-nowrap">Hôm nay, 08:20</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4 relative opacity-60">
                            <div class="w-16 h-16 bg-gray-400 rounded-full flex items-center justify-center z-10">
                                <i data-lucide="box" class="w-7 h-7 text-white"></i>
                            </div>
                            <div class="flex-1 pt-2">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg">Đã tiếp nhận hàng</h4>
                                        <p class="text-gray-600 mt-1">Lấy hàng thành công tại địa chỉ người gửi</p>
                                    </div>
                                    <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full whitespace-nowrap">Hôm qua, 16:00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="py-24 px-4 sm:px-6 lg:px-8 bg-primary-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Bảng giá tham khảo</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3">Tối ưu chi phí vận chuyển</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Giá cước minh bạch, chiết khấu hấp dẫn cho đối tác lâu dài trên CourierXpress.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all scroll-reveal">
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold text-gray-900">Giao Chuẩn</h3>
                        <p class="text-gray-500 text-sm mt-2">Dành cho cá nhân gửi lẻ</p>
                        <div class="mt-6">
                            <span class="text-5xl font-bold text-gray-900">25K</span>
                            <span class="text-gray-500">/đơn</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Giao nội thành 24H</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Lấy hàng tận nơi</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Đền bù cơ bản</span>
                        </li>
                        <li class="flex items-center space-x-3 opacity-50">
                            <i data-lucide="x" class="w-5 h-5 text-gray-400"></i>
                            <span class="text-gray-400">Giao hẹn giờ</span>
                        </li>
                    </ul>
                    <button class="w-full py-4 border-2 border-primary-600 text-primary-600 rounded-xl font-bold hover:bg-primary-600 hover:text-white transition-all">
                        Tạo Đơn Ngay
                    </button>
                </div>

                <div class="bg-primary-600 rounded-3xl p-8 shadow-2xl transform md:scale-105 relative scroll-reveal">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-yellow-400 text-primary-900 px-4 py-1 rounded-full text-sm font-bold whitespace-nowrap">
                        Khuyên dùng
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold text-white">Giao Hỏa Tốc</h3>
                        <p class="text-primary-200 text-sm mt-2">Dành cho shop online</p>
                        <div class="mt-6">
                            <span class="text-5xl font-bold text-white">35K</span>
                            <span class="text-primary-200">/đơn</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Giao nội thành 2H-4H</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Theo dõi real-time</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Miễn phí thu hộ COD</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Bảo hiểm toàn phần</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Ưu tiên xử lý sự cố</span>
                        </li>
                    </ul>
                    <button class="w-full py-4 bg-white text-primary-600 rounded-xl font-bold hover:bg-yellow-400 hover:text-primary-900 transition-all">
                        Tạo Đơn Ngay
                    </button>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all scroll-reveal">
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold text-gray-900">Doanh nghiệp</h3>
                        <p class="text-gray-500 text-sm mt-2">Sản lượng >500 đơn/tháng</p>
                        <div class="mt-6">
                            <span class="text-5xl font-bold text-gray-900">Liên hệ</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Bảng giá chiết khấu riêng</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Hỗ trợ API tích hợp ERP</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Lưu kho & Fulfillment</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Đối soát linh hoạt</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Nhân viên chăm sóc riêng</span>
                        </li>
                    </ul>
                    <button class="w-full py-4 border-2 border-primary-600 text-primary-600 rounded-xl font-bold hover:bg-primary-600 hover:text-white transition-all">
                        Liên hệ tư vấn
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Đánh giá</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3">Đối tác nói gì về CourierXpress</h2>
                <p class="text-gray-600 mt-4">Hàng ngàn chủ shop đã tin dùng giải pháp logistics của chúng tôi</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-3xl p-8 scroll-reveal">
                    <div class="flex items-center space-x-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Giao hàng cực nhanh, shipper thân thiện. App theo dõi đơn hàng rất tiện, biết chính xác khi nào hàng đến. Sẽ tiếp tục ủng hộ CourierXpress!"</p>
                    <div class="flex items-center space-x-4">
                        <img src="https://res.cloudinary.com/dpumipugc/image/upload/v1778928106/OIP_nfyhnc.jpg" alt="User" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-gray-900">Nguyễn Thị Hương</p>
                            <p class="text-sm text-gray-500">Chủ shop thời trang</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 scroll-reveal">
                    <div class="flex items-center space-x-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Từ khi dùng CourierXpress, tỷ lệ đơn hàng giao thành công tăng 30%. Khách hàng feedback rất tích cực về tốc độ và thái độ của shipper."</p>
                    <div class="flex items-center space-x-4">
                        <img src="https://res.cloudinary.com/dpumipugc/image/upload/v1778928106/download_k2vqgj.jpg" alt="User" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-gray-900">Trần Minh Tuấn</p>
                            <p class="text-sm text-gray-500">Đại lý phân phối</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 scroll-reveal">
                    <div class="flex items-center space-x-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Giao diện trực quan, tạo đơn nhanh gọn. Mình thích nhất là hệ thống đối soát tiền COD minh bạch, chuyển khoản đúng hẹn mỗi tuần."</p>
                    <div class="flex items-center space-x-4">
                        <img src="https://res.cloudinary.com/dpumipugc/image/upload/v1778928106/OIP_1_kiaq64.jpg" alt="User" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-gray-900">Lê Thị Mai</p>
                            <p class="text-sm text-gray-500">Kinh doanh online</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

