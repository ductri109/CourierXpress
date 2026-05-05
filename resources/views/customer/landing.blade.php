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
                        <img src="https://i0.wp.com/blog.locus.sh/wp-content/uploads/2023/05/mem-9.jpg?resize=650%2C431&ssl=1" alt="Logistics Banner" 
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
                        <img src="https://dummyimage.com/100x100/dee2e6/6c757d.jpg&text=U1" alt="User" class="w-12 h-12 rounded-full object-cover">
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
                        <img src="https://dummyimage.com/100x100/dee2e6/6c757d.jpg&text=U2" alt="User" class="w-12 h-12 rounded-full object-cover">
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
                        <img src="https://dummyimage.com/100x100/dee2e6/6c757d.jpg&text=U3" alt="User" class="w-12 h-12 rounded-full object-cover">
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