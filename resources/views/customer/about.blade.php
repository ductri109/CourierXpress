@extends('customer.layout')

@section('title', 'Về Chúng Tôi - CourierXpress') 
@section('content')
<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-5xl mx-auto space-y-20">
        <!-- Hero Section -->
        <div class="text-center space-y-4">
            <h2 class="text-5xl font-black text-gray-900 tracking-tight">Về <span class="gradient-text">CourierXpress</span></h2>
            <p class="text-gray-500 text-xl max-w-2xl mx-auto font-medium">Nâng tầm công nghệ, kết nối tương lai thông qua giải pháp Logistics thông minh.</p>
        </div>

        <!-- Câu chuyện thương hiệu -->
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                    <span class="w-8 h-1 bg-primary-600 rounded-full"></span>
                    Câu Chuyện Thương Hiệu
                </h3>
                <div class="text-gray-600 leading-relaxed space-y-4">
                    <p>Trong kỷ nguyên công nghiệp IT phát triển nhanh chóng, việc kết hợp giữa lý thuyết và thực tiễn là chìa khóa để tạo ra những giá trị đột phá. Dự án CourierXpress ra đời từ mô hình đào tạo <strong>eProject tại Aptech</strong> — một môi trường học tập tương tác mô phỏng thực tế.</p>
                    <p>Chúng tôi nhận thấy ngành logistics đang đối mặt với những thách thức lớn về quản lý thủ công và thiếu tính minh bạch. CourierXpress được xây dựng để giải quyết triệt để những vấn đề đó, mang lại sự tối ưu hóa cho quản trị viên, đại lý và khách hàng.</p>
                </div>
            </div>
            <div class="bg-primary-50 rounded-3xl p-8 border border-primary-100 flex items-center justify-center">
                <i data-lucide="sparkles" class="w-32 h-32 text-primary-600 opacity-20 absolute"></i>
                <div class="relative text-center">
                    <p class="text-4xl font-black text-primary-600 italic">"Từ lý thuyết đến thực tiễn đột phá"</p>
                </div>
            </div>
        </div>

        <!-- Tầm nhìn & Sứ mệnh -->
        <div class="grid md:grid-cols-2 gap-8">
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 transition-all group">
                <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="eye"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Tầm Nhìn</h3>
                <p class="text-gray-600 leading-relaxed">Trở thành nền tảng quản lý giao nhận hàng đầu, dẫn đầu trong việc ứng dụng công nghệ để đơn giản hóa mọi quy trình logistics phức tạp.</p>
            </div>
            <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 transition-all group">
                <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition-transform">
                    <i data-lucide="target"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">Sứ Mệnh</h3>
                <p class="text-gray-600 leading-relaxed">Tự động hóa các hoạt động chuyển phát nhanh thông qua ứng dụng web tập trung, giúp doanh nghiệp kiểm soát tốt từ khâu đặt hàng đến báo cáo phân tích.</p>
            </div>
        </div>

        <!-- Giá trị cốt lõi -->
        <div class="space-y-10">
            <h3 class="text-2xl font-bold text-gray-900 text-center">Giá Trị Cốt Lõi</h3>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center space-y-3">
                    <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="box"></i></div>
                    <h4 class="font-bold text-sm">Tính thực tiễn</h4>
                </div>
                <div class="text-center space-y-3">
                    <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="zap"></i></div>
                    <h4 class="font-bold text-sm">Đổi mới</h4>
                </div>
                <div class="text-center space-y-3">
                    <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="shield-check"></i></div>
                    <h4 class="font-bold text-sm">An toàn</h4>
                </div>
                <div class="text-center space-y-3">
                    <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="smile"></i></div>
                    <h4 class="font-bold text-sm">Trải nghiệm</h4>
                </div>
            </div>
        </div>

        <!-- Đội ngũ sáng lập -->
        <div class="bg-gray-900 rounded-[3rem] p-12 text-white overflow-hidden relative">
            <div class="relative z-10">
                <h3 class="text-3xl font-bold mb-10 text-center">Đội Ngũ Sáng Lập</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                        <div class="w-20 h-20 bg-primary-600 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">L</div>
                        <h4 class="font-bold text-lg">Lê Tuấn Anh</h4>
                        <p class="text-gray-400 text-xs mt-2">Student1692582</p>
                    </div>
                    <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                        <div class="w-20 h-20 bg-primary-600 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">T</div>
                        <h4 class="font-bold text-lg">Trịnh Tuấn Anh</h4>
                        <p class="text-gray-400 text-xs mt-2">Student1701600</p>
                    </div>
                    <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                        <div class="w-20 h-20 bg-primary-600 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">H</div>
                        <h4 class="font-bold text-lg">Hoàng Nguyễn Gia Khang</h4>
                        <p class="text-gray-400 text-xs mt-2">Student1698950</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chúng tôi làm được gì -->
        <div class="space-y-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold text-gray-900">Chúng Tôi Làm Được Gì?</h3>
                <p class="text-gray-500 mt-2">Hệ sinh thái Logistics thu nhỏ với đầy đủ tính năng</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-primary-600 mb-3">Dành cho Admin</h4>
                    <p class="text-sm text-gray-600">Quản lý đại lý, khách hàng, theo dõi lô hàng và phân tích báo cáo chuyên sâu.</p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-primary-600 mb-3">Dành cho Đại lý</h4>
                    <p class="text-sm text-gray-600">Đặt đơn tại chi nhánh, gán mã Tracking ID tự động và cập nhật trạng thái đơn hàng.</p>
                </div>
                <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <h4 class="font-bold text-primary-600 mb-3">Dành cho Khách hàng</h4>
                    <p class="text-sm text-gray-600">Đăng ký thành viên, đặt đơn trực tuyến và tra cứu hành trình thời gian thực.</p>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection