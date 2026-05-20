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
                            <a href="{{ route('booking') }}" class="bg-yellow-400 text-primary-900 px-8 py-3.5 rounded-xl font-bold hover:bg-yellow-300 transition-all shadow-lg text-center flex items-center justify-center space-x-2">
                                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                                <span>Tạo Đơn Hàng Mới</span>
                            </a>

                            <a href="{{ route('tracking') }}" class="bg-white/20 text-white backdrop-blur-md border border-white/30 px-8 py-3.5 rounded-xl font-bold hover:bg-white/30 transition-all shadow-lg text-center flex items-center justify-center space-x-2">
                                <i data-lucide="search" class="w-5 h-5"></i>
                                <span>Tra Cứu Vận Đơn</span>
                            </a>
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
                        {{-- THAY ĐỔI: Ảnh nền banner giao diện không gian số Logistics thông minh, chuyên nghiệp --}}
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80" alt="Logistics Banner Smart Supply Chain"
                             class="rounded-3xl shadow-2xl w-full border-4 border-white/10 object-cover h-[431px]">

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
                        {{-- ĐÃ SỬA: Thay thế link lỗi bằng ảnh thật từ Unsplash cho Nguyễn Thị Hương --}}
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&h=150&q=80"
                             alt="Nguyễn Thị Hương" class="w-12 h-12 rounded-full object-cover">
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
                        {{-- THAY ĐỔI: Ảnh người dùng U2 thật từ Unsplash --}}
                        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=150&h=150&q=80" alt="Trần Minh Tuấn" class="w-12 h-12 rounded-full object-cover">
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
                        {{-- THAY ĐỔI: Ảnh người dùng U3 thật từ Unsplash --}}
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&h=150&q=80" alt="Lê Thị Mai" class="w-12 h-12 rounded-full object-cover">
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
