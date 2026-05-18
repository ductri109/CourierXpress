@extends('agent.layout')

@section('title', 'Chi tiết vận đơn ' . $order->tracking_id)

@section('content')
    <div class="space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('agent.orders.index') }}" class="w-9 h-9 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-600 hover:text-gray-900 transition-all"><i data-lucide="arrow-left" class="w-5 h-5"></i></a>
            <div>
                <h2 class="text-2xl font-bold text-gray-950">Chi tiết Vận đơn: {{ $order->tracking_id }}</h2>
                <p class="text-gray-500 text-sm mt-0.5">Xem đầy đủ thông tin bốc xếp và tuyến đường giao nhận.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Thông tin người gửi</span>
                        <p class="font-bold text-gray-900 text-base">{{ $order->sender_name }}</p>
                        <p class="text-gray-600 mt-1 leading-relaxed">{{ $order->sender_address }}</p>
                    </div>
                    <div>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-2">Thông tin người nhận</span>
                        <p class="font-bold text-gray-900 text-base">{{ $order->receiver_name }}</p>
                        <p class="text-gray-600 mt-1 leading-relaxed">{{ $order->receiver_address }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
                <div class="space-y-4 text-sm font-medium">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block border-b pb-2">Thông số kiện hàng</span>
                    <div class="flex justify-between"><span class="text-gray-400">Trọng lượng:</span><span class="text-gray-900 font-bold">{{ $order->total_weight }} kg</span></div>
                    <div class="flex justify-between"><span class="text-gray-400">Trạng thái:</span><span class="text-primary-600 font-bold uppercase">{{ $order->status }}</span></div>
                    <div class="flex justify-between"><span class="text-gray-400">Chủ tài khoản:</span><span class="text-gray-900 font-bold">{{ $order->customer->full_name ?? 'N/A' }}</span></div>
                </div>
            </div>
        </div>
    </div>
@endsection
