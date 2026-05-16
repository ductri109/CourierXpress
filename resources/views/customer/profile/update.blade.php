@extends('customer.layout')

@section('title', 'Hồ Sơ Cá Nhân - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Breadcrumb đồng bộ với trang tạo đơn --}}
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
                <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Trang chủ</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-primary-600 font-medium">Hồ sơ của tôi</span>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                {{-- Header Profile với Gradient đặc trưng --}}
                <div class="gradient-bg p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="text-left">
                            <h2 class="text-3xl font-extrabold tracking-tight">Thông Tin Tài Khoản</h2>
                            <p class="text-white/80 mt-2 font-medium">Quản lý thông tin cá nhân và thông tin liên lạc của bạn</p>
                        </div>
                        <div class="hidden md:block">
                            <i data-lucide="user-cog" class="w-16 h-16 text-white/20 animate-pulse"></i>
                        </div>
                    </div>
                    {{-- Decor hoa văn chìm giống trang đặt đơn --}}
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                <div class="p-8 md:p-12">
                    {{-- Hiển thị thông báo thành công --}}
                    @if(session('success'))
                        <div class="mb-8 p-4 bg-green-50 border border-green-100 rounded-2xl flex items-center space-x-3 shadow-sm animate-fade-in-down">
                            <div class="bg-green-500 p-1.5 rounded-full">
                                <i data-lucide="check" class="w-4 h-4 text-white"></i>
                            </div>
                            <p class="text-green-800 font-medium text-sm">{{ session('success') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('customer.profile.update') }}" method="POST" class="space-y-10">
                        @csrf
                        @method('PUT')

                        <!-- Nhóm: Thông tin cơ bản -->
                        <div class="relative">
                            <div class="flex items-center space-x-3 mb-6">
                                <h3 class="text-xl font-bold text-gray-900">Thông tin định danh</h3>
                                <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Họ và tên -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Họ tên khách hàng</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                            <i data-lucide="user" class="w-5 h-5"></i>
                                        </div>
                                        <input type="text" name="name"
                                               value="{{ old('name', Auth::guard('customer')->user()->full_name) }}"
                                               class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium @error('name') border-red-500 @enderror"
                                               placeholder="Nhập họ và tên">
                                    </div>
                                    @error('name')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Địa chỉ Email</label>
                                    <div class="relative">
                                        <input type="email" name="email"
                                               value="{{ old('email', Auth::guard('customer')->user()->email) }}"
                                               required
                                               class="w-full pl-11 pr-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 ... @error('email') border-red-500 @enderror"
                                               placeholder="example@gmail.com">
                                    </div>
                                    @error('email')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Nhóm: Thông tin liên lạc -->
                        <div class="relative">
                            <div class="flex items-center space-x-3 mb-6">
                                <h3 class="text-xl font-bold text-gray-900">Liên lạc & Địa chỉ</h3>
                                <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                            </div>

                            <div class="grid md:grid-cols-3 gap-6 bg-primary-50/30 p-6 rounded-2xl border border-primary-100">
                                <!-- Số điện thoại -->
                                <div class="space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Số điện thoại</label>
                                    <div class="relative">
                                        <input type="text" name="phone"
                                               value="{{ old('phone', Auth::guard('customer')->user()->phone) }}"
                                               class="w-full px-4 py-3.5 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm font-medium @error('phone') border-red-500 @enderror"
                                               placeholder="0912xxxxxx">
                                        <span class="absolute right-4 top-3.5 font-bold text-primary-600">VN</span>
                                    </div>
                                    @error('phone')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Địa chỉ (Ví dụ thêm vào để form đầy đặn như trang tạo đơn) -->
                                <div class="md:col-span-2 space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Địa chỉ mặc định</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-primary-500 transition-colors">
                                            <i data-lucide="map-pin" class="w-5 h-5"></i>
                                        </div>
                                        <input type="text" name="address"
                                               value="{{ old('address', Auth::guard('customer')->user()->address ?? '') }}"
                                               class="w-full pl-11 pr-4 py-3.5 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm font-medium"
                                               placeholder="Số nhà, tên đường, phường/xã...">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Nút hành động -->
                        <div class="pt-6 border-t border-gray-100">
                            <div class="flex flex-col md:flex-row gap-4">
                                <button type="submit"
                                        class="flex-1 gradient-bg text-white py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1.5 flex items-center justify-center space-x-3 group">
                                    <i data-lucide="save" class="w-5 h-5"></i>
                                    <span>CẬP NHẬT HỒ SƠ</span>
                                </button>

                                <button type="reset"
                                        class="px-8 py-4 bg-gray-100 text-gray-600 rounded-2xl font-bold hover:bg-gray-200 transition-all flex items-center justify-center space-x-2">
                                    <i data-lucide="rotate-ccw" class="w-5 h-5"></i>
                                    <span>HỦY</span>
                                </button>
                            </div>

                            {{-- Box lưu ý giống trang tạo đơn --}}
                            <div class="mt-8 p-4 bg-blue-50 rounded-xl flex items-start space-x-3 border border-blue-100">
                                <i data-lucide="shield-check" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5"></i>
                                <p class="text-blue-800 text-sm leading-relaxed">
                                    <strong>Bảo mật thông tin:</strong> CourierXpress cam kết bảo mật tuyệt đối thông tin cá nhân của khách hàng theo tiêu chuẩn ISO/IEC 27001.
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
