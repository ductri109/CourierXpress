@extends('agent.layout')

@section('title', 'Đơn hàng bưu cục')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-950">Đơn hàng của tôi</h2>
            <p class="text-gray-500 text-sm mt-0.5">Xử lý các vận đơn được bàn giao điều phối từ tổng kho bưu cục.</p>
        </div>

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-900 text-lg">Danh sách vận đơn phân tuyến</h3>
                <span class="text-xs font-bold bg-primary-50 text-primary-600 px-3 py-1 rounded-full">Tổng: {{ $orders->count() }} đơn</span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-6 py-4">Mã Vận Đơn</th>
                        <th class="px-6 py-4">Người gửi</th>
                        <th class="px-6 py-4">Người nhận</th>
                        <th class="px-6 py-4">Khối lượng</th>
                        <th class="px-6 py-4">Trạng thái</th>
                        <th class="px-6 py-4 text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $order->tracking_id }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $order->sender_name }}</div>
                                <span class="text-xs text-gray-400 block max-w-[180px] truncate">{{ $order->sender_address }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $order->receiver_name }}</div>
                                <span class="text-xs text-gray-400 block max-w-[180px] truncate">{{ $order->receiver_address }}</span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $order->total_weight }} kg</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider inline-block
                                    @if($order->status == 'assigned') bg-amber-50 text-amber-700 border border-amber-200
                                    @elseif($order->status == 'in_transit') bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($order->status == 'delivered') bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @else bg-gray-50 text-gray-600 border border-gray-200 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($order->status == 'assigned')
                                    <form action="{{ route('agent.orders.accept', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-amber-500 text-white font-bold text-xs px-3.5 py-2 rounded-xl hover:bg-amber-600 transition-all flex items-center space-x-1 mx-auto shadow-md"><i data-lucide="check" class="w-3.5 h-3.5"></i> <span>Nhận đơn</span></button>
                                    </form>
                                @elseif($order->status == 'in_transit')
                                    <form action="{{ route('agent.orders.complete', $order->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-emerald-600 text-white font-bold text-xs px-3.5 py-2 rounded-xl hover:bg-emerald-700 transition-all flex items-center space-x-1 mx-auto shadow-md"><i data-lucide="navigation" class="w-3.5 h-3.5"></i> <span>Hoàn thành</span></button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 font-semibold flex items-center justify-center space-x-1"><i data-lucide="lock" class="w-3.5 h-3.5"></i> <span>Hoàn tất</span></span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-6 py-12 text-center text-gray-400 font-medium">Bưu cục chưa có đơn hàng nào được phân phối.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
