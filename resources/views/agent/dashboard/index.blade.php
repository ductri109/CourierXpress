@extends('agent.layout')

@section('title', 'Dashboard - Agent Portal')

@section('content')
<div class="space-y-6">

    {{-- ===== HEADER ===== --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-950">Xin chào, {{ Auth::guard('agent')->user()->FullName }} 👋</h2>
        <p class="text-gray-500 text-sm mt-0.5">
            Trạng thái:
            @if(Auth::guard('agent')->user()->Status === 'active')
                <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold">
                    <span class="w-2 h-2 bg-emerald-500 rounded-full inline-block animate-pulse"></span>
                    Đang rảnh
                </span>
            @else
                <span class="inline-flex items-center gap-1 text-amber-600 font-semibold">
                    <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                    Đang bận
                </span>
            @endif
            &nbsp;—&nbsp; Cập nhật lúc {{ now()->format('H:i, d/m/Y') }}
        </p>
    </div>

    {{-- ===== KPI CARDS ===== --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                    <i data-lucide="package" class="w-5 h-5 text-blue-600"></i>
                </div>
                <span class="text-2xl font-bold text-gray-900">{{ $totalOrders }}</span>
            </div>
            <p class="text-sm font-medium text-gray-500">Tổng đơn hàng</p>
        </div>

        <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                    <i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
                </div>
                <span class="text-2xl font-bold text-gray-900">{{ $assignedOrders }}</span>
            </div>
            <p class="text-sm font-medium text-gray-500">Chờ nhận</p>
        </div>

        <div class="bg-white rounded-2xl border border-blue-200 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                    <i data-lucide="truck" class="w-5 h-5 text-blue-600"></i>
                </div>
                <span class="text-2xl font-bold text-gray-900">{{ $inTransitOrders }}</span>
            </div>
            <p class="text-sm font-medium text-gray-500">Đang giao</p>
        </div>

        <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                </div>
                <span class="text-2xl font-bold text-gray-900">{{ $deliveredOrders }}</span>
            </div>
            <p class="text-sm font-medium text-gray-500">Đã giao</p>
        </div>

    </div>

    {{-- ===== ĐƠN CẦN XỬ LÝ NGAY ===== --}}
    @if($urgentOrders->count() > 0)
    <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
        <div class="flex items-center gap-2 mb-4">
            <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600"></i>
            <h3 class="font-bold text-amber-800 text-base">Cần xử lý ngay ({{ $urgentOrders->count() }} đơn)</h3>
        </div>
        <div class="space-y-3">
            @foreach($urgentOrders as $order)
            <div class="bg-white rounded-xl border border-amber-200 p-4 flex items-center justify-between shadow-sm">
                <div>
                    <p class="font-bold text-gray-900 text-sm">{{ $order->tracking_id }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">Người nhận: {{ $order->receiver_name }}</p>
                    <p class="text-xs text-gray-400">{{ $order->receiver_address }}</p>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase bg-amber-100 text-amber-700 border border-amber-200">
                        Chờ nhận
                    </span>
                    <form action="{{ route('agent.orders.accept', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-amber-500 text-white font-bold text-xs px-3 py-1.5 rounded-lg hover:bg-amber-600 transition-all flex items-center gap-1">
                            <i data-lucide="check" class="w-3 h-3"></i> Nhận đơn
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- ===== BẢNG ĐƠN HÀNG GẦN ĐÂY ===== --}}
    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
            <h3 class="font-bold text-gray-900 text-base">Đơn hàng gần đây</h3>
            <a href="{{ route('agent.orders.index') }}" class="text-xs font-semibold text-red-600 hover:underline flex items-center gap-1">
                Xem tất cả <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-5 py-3">Mã vận đơn</th>
                        <th class="px-5 py-3">Người nhận</th>
                        <th class="px-5 py-3">Khối lượng</th>
                        <th class="px-5 py-3">Trạng thái</th>
                        <th class="px-5 py-3">Thời gian</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-5 py-3 font-bold text-gray-900">
                            <a href="{{ route('agent.orders.show', $order->id) }}" class="text-red-600 hover:underline">
                                {{ $order->tracking_id }}
                            </a>
                        </td>
                        <td class="px-5 py-3">
                            <div class="font-semibold text-gray-800">{{ $order->receiver_name }}</div>
                            <span class="text-xs text-gray-400">{{ \Str::limit($order->receiver_address, 30) }}</span>
                        </td>
                        <td class="px-5 py-3 font-medium">{{ $order->total_weight }} kg</td>
                        <td class="px-5 py-3">
                            <span class="px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider inline-block
                                @if($order->status == 'assigned') bg-amber-50 text-amber-700 border border-amber-200
                                @elseif($order->status == 'in_transit') bg-blue-50 text-blue-700 border border-blue-200
                                @elseif($order->status == 'delivered') bg-emerald-50 text-emerald-700 border border-emerald-200
                                @else bg-gray-50 text-gray-600 border border-gray-200 @endif">
                                @if($order->status == 'assigned') Chờ nhận
                                @elseif($order->status == 'in_transit') Đang giao
                                @elseif($order->status == 'delivered') Đã giao
                                @else {{ $order->status }} @endif
                            </span>
                        </td>
                        <td class="px-5 py-3 text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-5 py-10 text-center text-gray-400 text-sm">
                            <i data-lucide="inbox" class="w-8 h-8 mx-auto mb-2 text-gray-300"></i>
                            <p>Chưa có đơn hàng nào được gán cho bạn.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
