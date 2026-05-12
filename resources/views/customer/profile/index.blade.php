@extends('customer.layout')

@section('title', 'Hồ Sơ Cá Nhân - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Breadcrumb --}}
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
                <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Trang chủ</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-primary-600 font-medium">Hồ sơ của tôi</span>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                {{-- Header Profile với Gradient --}}
                <div class="gradient-bg p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        <div class="flex items-center space-x-6">
                            {{-- Avatar Chữ cái đầu cực đẹp --}}
                            <div class="h-20 w-20 bg-white/20 backdrop-blur-md border-2 border-white/30 text-white rounded-2xl flex items-center justify-center text-3xl font-black shadow-inner">
                                {{ Str::upper(Str::substr(Auth::guard('customer')->user()->full_name, 0, 1)) }}
                            </div>
                            <div class="text-left">
                                <h2 class="text-3xl font-extrabold tracking-tight">Hồ Sơ Cá Nhân</h2>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <i data-lucide="user-check" class="w-16 h-16 text-white/20"></i>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                <div class="p-8 md:p-12">
                    {{-- Thông báo thành công nếu vừa redirect từ trang sửa về --}}
                    @if(session('success'))
                        <div id="toast-success" class="fixed bottom-5 right-5 z-50 transform transition-all duration-500 translate-y-20 opacity-0">
                            <div class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-2xl shadow-2xl border border-gray-100">
                                <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-green-500 bg-green-100 rounded-xl">
                                    <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                                </div>
                                <div class="ml-3 text-sm font-bold text-gray-800">{{ session('success') }}</div>
                            </div>
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const toast = document.getElementById('toast-success');

                                // Hiện lên sau 100ms
                                setTimeout(() => {
                                    toast.classList.remove('translate-y-20', 'opacity-0');
                                    toast.classList.add('translate-y-0', 'opacity-100');
                                }, 100);

                                // Tự động biến mất sau 3.5 giây
                                setTimeout(() => {
                                    toast.classList.add('opacity-0', 'translate-y-2');
                                    setTimeout(() => toast.remove(), 500);
                                }, 3500);
                            });
                        </script>
                    @endif

                    <div class="space-y-12">
                        <div class="relative">
                            <div class="flex items-center space-x-3 mb-8">
                                <div class="bg-primary-100 p-2 rounded-lg">
                                    <i data-lucide="fingerprint" class="w-5 h-5 text-primary-600"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Thông tin định danh</h3>
                                <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-10 ml-2">
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Họ tên khách hàng</label>
                                    <p class="text-lg font-bold text-gray-800 flex items-center">
                                        {{ Auth::guard('customer')->user()->full_name }}
                                        <i data-lucide="badge-check" class="w-4 h-4 ml-2 text-blue-500"></i>
                                    </p>
                                </div>

                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Địa chỉ Email</label>
                                    <p class="text-lg font-semibold text-gray-700">{{ Auth::guard('customer')->user()->email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex items-center space-x-3 mb-8">
                                <div class="bg-primary-100 p-2 rounded-lg">
                                    <i data-lucide="map-pinned" class="w-5 h-5 text-primary-600"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Liên lạc & Địa chỉ</h3>
                                <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                            </div>

                            <div class="grid md:grid-cols-3 gap-10 ml-2 bg-gray-50/50 p-6 rounded-3xl border border-dashed border-gray-200">
                                <div class="space-y-1">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Số điện thoại</label>
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-1 bg-white border border-gray-200 rounded text-xs font-bold text-primary-600 shadow-sm">+84</span>
                                        <p class="text-lg font-bold text-gray-800">{{ Auth::guard('customer')->user()->phone ?? 'Chưa cập nhật' }}</p>
                                    </div>
                                </div>

                                <div class="md:col-span-2 space-y-1">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest">Địa chỉ mặc định</label>
                                    <p class="text-lg font-medium text-gray-700 leading-relaxed">
                                        {{ Auth::guard('customer')->user()->address ?? 'Vui lòng bổ sung địa chỉ nhận hàng...' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-gray-100 flex flex-col items-center">
                            <a href="{{ route('customer.profile.edit') }}"
                               class="w-full md:w-auto px-12 py-4 gradient-bg text-white rounded-2xl font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1.5 flex items-center justify-center space-x-3">
                                <i data-lucide="edit-3" class="w-5 h-5"></i>
                                <span>CHỈNH SỬA THÔNG TIN</span>
                            </a>

                            <p class="mt-4 text-gray-400 text-sm flex items-center">
                                <i data-lucide="info" class="w-4 h-4 mr-1"></i>
                                Bạn cần thay đổi thông tin? Nhấn vào nút phía trên.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Box bảo mật chân trang --}}
            <div class="mt-8 p-6 bg-white rounded-2xl flex items-center justify-between border border-gray-100 shadow-sm">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <i data-lucide="shield-check" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Dữ liệu được bảo vệ</p>
                        <p class="text-xs text-gray-500">CourierXpress sử dụng mã hóa đầu cuối cho thông tin của bạn.</p>
                    </div>
                </div>
                <i data-lucide="lock" class="w-5 h-5 text-gray-300"></i>
            </div>
        </div>
    </div>
@endsection
