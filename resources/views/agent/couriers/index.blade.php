@extends('agent.layout')

@section('title', 'Tra cứu Courier')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-950">Tra cứu Vận đơn</h2>
            <p class="text-gray-500 text-sm mt-0.5">Tìm kiếm chi tiết kiện hàng theo số ID hệ thống hoặc Tracking ID bưu cục.</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <form action="{{ route('agent.couriers.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1 input-focus rounded-xl border-2 border-gray-200 bg-gray-50 flex items-center transition-all">
                    <div class="pl-4 flex items-center text-gray-400"><i data-lucide="search" class="w-5 h-5"></i></div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nhập ID hệ thống hoặc Mã vận đơn (VD: CX-XXXXXX)..." class="w-full pl-3 pr-4 py-3 bg-transparent border-none focus:ring-0 focus:outline-none text-gray-800 font-medium text-sm">
                </div>
                <button type="submit" class="bg-primary-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-700 transition-all text-sm shrink-0 shadow-lg"><span>Truy xuất dữ liệu</span></button>
            </form>
        </div>

        @if(request()->filled('search'))
            <div>
                @if($courier)
                    <div class="bg-white border border-primary-500/20 rounded-2xl shadow-sm p-6 space-y-6">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-100 pb-4 gap-2">
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs font-bold text-primary-600 bg-primary-50 px-2 py-0.5 rounded">ID: #{{ $courier->id }}</span>
                                    <h4 class="text-xl font-bold text-gray-900 tracking-tight">{{ $courier->tracking_id }}</h4>
                                </div>
                            </div>
                            <div>
                            <span class="px-3 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider inline-block bg-primary-50 text-primary-700">
                                {{ $courier->status }}
                            </span>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-sm">
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase block mb-1">Người Gửi</span>
                                <p class="font-bold text-gray-900">{{ $courier->sender_name }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $courier->sender_address }}</p>
                            </div>
                            <div>
                                <span class="text-xs font-bold text-gray-400 uppercase block mb-1">Người Nhận</span>
                                <p class="font-bold text-gray-900">{{ $courier->receiver_name }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $courier->receiver_address }}</p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-xl flex flex-col justify-center space-y-2">
                                <div class="flex justify-between items-center"><span class="text-gray-400 font-medium">Trọng lượng:</span><span class="font-bold text-gray-900">{{ $courier->total_weight }} kg</span></div>
                                <div class="flex justify-between items-center"><span class="text-gray-400 font-medium">Khách hàng đặt:</span><span class="font-bold text-primary-600">{{ $courier->customer->full_name ?? 'N/A' }}</span></div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl flex items-center space-x-3"><i data-lucide="alert-circle" class="shrink-0 text-amber-600"></i><span class="font-medium text-sm">Không tìm thấy mã số vận đơn hợp lệ trong bưu cục. Vui lòng thử lại!</span></div>
                @endif
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between"><h3 class="font-bold text-gray-900 text-lg">Tất cả hồ sơ bưu cục</h3><span class="text-xs font-bold bg-gray-100 text-gray-600 px-3 py-1 rounded-full">Tổng số: {{ $orders->count() }} đơn</span></div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider"><th class="px-6 py-4">ID</th><th class="px-6 py-4">Mã Vận Đơn</th><th class="px-6 py-4">Tuyến đi - nhận</th><th class="px-6 py-4">Khách hàng đặt</th><th class="px-6 py-4">Khối lượng</th><th class="px-6 py-4">Trạng thái</th></tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                    @foreach($orders as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-xs font-bold text-gray-400">#{{ $item->id }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900">{{ $item->tracking_id }}</td>
                            <td class="px-6 py-4"><div class="text-xs">Từ: {{ $item->sender_name }}</div><div class="text-xs mt-0.5">Đến: {{ $item->receiver_name }}</div></td>
                            <td class="px-6 py-4 text-gray-500 font-normal">{{ $item->customer->full_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 font-semibold text-gray-900">{{ $item->total_weight }} kg</td>
                            <td class="px-6 py-4"><span class="px-2.5 py-1 rounded-full text-[0.7rem] font-bold uppercase tracking-wider inline-block bg-gray-50 text-gray-700">{{ $item->status }}</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
