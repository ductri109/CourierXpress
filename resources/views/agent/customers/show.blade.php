@extends('agent.layout')

@section('title', 'Chi tiết đối tác #' . $customer->id)

@section('content')
    <div class="space-y-6">
        <div class="flex items-center space-x-4">
            <a href="{{ route('agent.customers.index') }}" class="w-9 h-9 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-600 hover:text-gray-900 transition-all"><i data-lucide="arrow-left" class="w-5 h-5"></i></a>
            <div>
                <h2 class="text-2xl font-bold text-gray-950">Hồ sơ khách hàng: {{ $customer->full_name }}</h2>
                <p class="text-gray-500 text-sm mt-0.5">Xem lịch sử vận đơn bưu cục liên kết chi tiết.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col items-center text-center justify-center h-fit">
                <div class="w-14 h-14 rounded-2xl bg-primary-100 text-primary-700 flex items-center justify-center font-extrabold text-xl shadow-inner mb-3">{{ strtoupper(substr($customer->full_name ?? 'C', 0, 1)) }}</div>
                <span class="text-xs font-bold text-primary-600 bg-primary-50 px-2.5 py-0.5 rounded-full mb-1">Mã đối tác: #{{ $customer->id }}</span>
                <h4 class="text-lg font-bold text-gray-900">{{ $customer->full_name }}</h4>
                <div class="w-full space-y-2 text-xs font-medium text-gray-500 border-t border-gray-100 pt-4 mt-4 text-left">
                    <div class="flex items-center space-x-2"><i data-lucide="phone" class="w-4 h-4"></i> <span class="text-gray-700 font-semibold">{{ $customer->phone }}</span></div>
                    <div class="flex items-center space-x-2"><i data-lucide="mail" class="w-4 h-4"></i> <span class="text-gray-700 font-semibold truncate block max-w-[220px]">{{ $customer->email }}</span></div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                <h4 class="font-bold text-gray-900 mb-4 flex items-center text-base"><i data-lucide="history" class="w-5 h-5 text-gray-400 mr-2"></i> Lịch sử vận đơn bưu cục</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider">
                            <th class="px-4 py-3">Mã Vận Đơn</th>
                            <th class="px-4 py-3">Người nhận</th>
                            <th class="px-4 py-3">Trọng lượng</th>
                            <th class="px-4 py-3">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 font-medium text-gray-700">
                        @forelse($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-3 font-bold text-gray-900">{{ $order->tracking_id }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $order->receiver_name }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $order->total_weight }} kg</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-0.5 rounded text-[0.65rem] font-bold uppercase tracking-wider bg-gray-100 text-gray-700">{{ $order->status }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-gray-400 font-medium py-6">Chưa phát sinh dữ liệu đơn hàng bưu cục.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
