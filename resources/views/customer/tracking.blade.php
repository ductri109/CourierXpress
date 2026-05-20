@extends('customer.layout')

@section('title', 'Tra cứu vận đơn - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Header & Ô tìm kiếm --}}
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 mb-8">
                <div class="gradient-bg p-10 text-white text-center">
                    <i data-lucide="search" class="w-12 h-12 mx-auto mb-4 text-white/80"></i>
                    <h2 class="text-3xl font-extrabold tracking-tight">Tra Cứu Hành Trình Đơn Hàng</h2>
                    <p class="text-white/80 mt-2 font-medium">Nhập mã vận đơn của bạn để kiểm tra tình trạng giao nhận</p>
                </div>

                <div class="p-8 md:p-12">
                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 p-4 rounded-xl flex items-start space-x-3 mb-6">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mt-0.5 shrink-0"></i>
                            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

                    <form action="{{ route('tracking') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                        <div class="relative flex-1">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="box" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="text" name="tracking_id" value="{{ $tracking_id ?? '' }}" placeholder="VD: CX-1A2B3C..." required
                                   class="w-full pl-12 pr-4 py-4 border-2 border-gray-200 rounded-2xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 text-lg font-bold text-gray-800 uppercase">
                        </div>
                        <button type="submit" class="bg-primary-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-primary-700 transition-colors flex items-center justify-center space-x-2 shrink-0 shadow-lg">
                            <span>Tra Cứu</span>
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Kết quả tra cứu --}}
            @if(isset($order))
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 p-8 md:p-12">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center border-b border-gray-100 pb-6 mb-6">
                        <div>
                            <p class="text-sm text-gray-500 font-medium">Mã vận đơn</p>
                            <h3 class="text-2xl font-bold text-primary-600">{{ $order->tracking_id }}</h3>
                        </div>
                        <div class="mt-4 md:mt-0 text-right">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold
                            @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'delivering') bg-blue-100 text-blue-800
                            @elseif($order->status == 'completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            Trạng thái: {{ strtoupper($order->status) }}
                        </span>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 mb-8">
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <div class="flex items-center space-x-2 mb-4">
                                <i data-lucide="user-minus" class="w-5 h-5 text-gray-400"></i>
                                <h4 class="font-bold text-gray-900">Thông tin gửi</h4>
                            </div>
                            <p class="text-gray-600 font-medium">{{ $order->sender_name }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $order->sender_address }}</p>
                        </div>
                        <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            <div class="flex items-center space-x-2 mb-4">
                                <i data-lucide="user-check" class="w-5 h-5 text-primary-500"></i>
                                <h4 class="font-bold text-gray-900">Thông tin nhận</h4>
                            </div>
                            <p class="text-gray-600 font-medium">{{ $order->receiver_name }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $order->receiver_address }}</p>
                        </div>
                    </div>

                    {{-- Thông báo bổ sung --}}
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start space-x-3">
                        <i data-lucide="info" class="w-5 h-5 text-blue-500 mt-0.5 shrink-0"></i>
                        <p class="text-sm text-blue-800">
                            Để bảo vệ quyền riêng tư của khách hàng, số điện thoại chi tiết đã được ẩn. Vui lòng liên hệ tổng đài 1900 6868 nếu bạn cần hỗ trợ thêm về bưu gửi này.
                        </p>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
