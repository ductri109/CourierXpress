@extends('customer.layout')

@section('title', 'Tạo Đơn Hàng Mới - CourierXpress')

@section('content')
<div class="pt-24 pb-20 bg-gray-50 min-h-screen"> {{-- Giảm pt-32 xuống pt-24 để bớt trống phía trên --}}
    <div class="max-w-4xl mx-auto px-4">
        
        {{-- Phần Breadcrumb hoặc Chỉ dẫn nhỏ phía trên Form giúp bớt trống trải --}}
        <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
            <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Trang chủ</a>
            <i data-lucide="chevron-right" class="w-4 h-4"></i>
            <span class="text-primary-600 font-medium">Tạo đơn hàng mới</span>
        </div>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            {{-- Header Form được thiết kế lại để đầy đặn hơn --}}
            <div class="gradient-bg p-10 text-white relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="text-left">
                        <h2 class="text-3xl font-extrabold tracking-tight">Tạo Vận Đơn Mới</h2>
                        <p class="text-white/80 mt-2 font-medium">Hệ thống CourierXpress xử lý đơn hàng tự động 24/7</p>
                    </div>
                    <div class="hidden md:block">
                        <i data-lucide="box" class="w-16 h-16 text-white/20 animate-pulse"></i>
                    </div>
                </div>
                {{-- Decor hoa văn chìm --}}
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
            </div>

            <form action="{{ route('booking.post') }}" method="POST" class="p-8 md:p-12 space-y-10">
                @csrf
                
                <!-- Thông tin người gửi -->
                <div class="relative">
                    <div class="flex items-center space-x-3 mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Thông tin người gửi</h3>
                        <div class="flex-1 h-px bg-gray-100 ml-2"></div> {{-- Đường kẻ ngang decor --}}
                    </div>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Họ tên người gửi</label>
                            <div class="relative">
                                <input type="text" name="sender_name" value="{{ auth('customer')->user()->full_name }}" 
                                    class="w-full pl-4 pr-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none bg-gray-50 font-medium text-gray-600">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Địa chỉ người gửi</label>
                            <div class="relative">
                                <input type="text" name="sender_address" value="{{ auth('customer')->user()->address }}"
                                    class="w-full pl-4 pr-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none transition-all focus:bg-white">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin người nhận -->
                <div class="relative">
                    <div class="flex items-center space-x-3 mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Thông tin người nhận</h3>
                        <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Họ tên người nhận <span class="text-primary-500">*</span></label>
                            <input type="text" name="receiver_name" placeholder="Nhập tên người nhận" required
                                class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Địa chỉ giao hàng <span class="text-primary-500">*</span></label>
                            <input type="text" name="receiver_address" placeholder="Số nhà, tên đường, tỉnh thành..." required
                                class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                        </div>
                    </div>
                </div>

                <!-- Thông tin hàng hóa -->
                <div class="relative">
                    <div class="flex items-center space-x-3 mb-6">
                        <h3 class="text-xl font-bold text-gray-900">Chi tiết hàng hóa</h3>
                        <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6 bg-primary-50/30 p-6 rounded-2xl border border-primary-100">
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Khối lượng <span class="text-primary-500">*</span></label>
                            <div class="relative">
                                <input type="number" step="0.1" name="total_weight" placeholder="0.5" required
                                    class="w-full px-4 py-3.5 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm">
                                <span class="absolute right-4 top-3.5 font-bold text-primary-600">kg</span>
                            </div>
                        </div>
                        <!-- <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Ghi chú (Tùy chọn)</label>
                            <input type="text" name="note" placeholder="Ví dụ: Hàng dễ vỡ, giao giờ hành chính..."
                                class="w-full px-4 py-3.5 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm">
                        </div> -->
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" 
                        class="w-full gradient-bg text-white py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1.5 flex items-center justify-center space-x-3 group">
                        <span>XÁC NHẬN ĐẶT ĐƠN</span>
                        <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                    </button>
                    <div class="mt-6 p-4 bg-yellow-50 rounded-xl flex items-start space-x-3 border border-yellow-100">
                        <i data-lucide="info" class="w-5 h-5 text-yellow-600 shrink-0 mt-0.5"></i>
                        <p class="text-yellow-800 text-sm leading-relaxed">
                            <strong>Lưu ý:</strong> Phí vận chuyển tạm tính dựa trên khối lượng. Nhân viên bưu tá sẽ cân lại thực tế khi lấy hàng để cập nhật giá cước chính xác nhất.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection