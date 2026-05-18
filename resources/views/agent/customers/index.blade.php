@extends('agent.layout')

@section('title', 'Quản lý Khách hàng')

@section('content')
    <div class="space-y-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-950">Quản lý Khách hàng bưu cục</h2>
            <p class="text-gray-500 text-sm mt-0.5">Tra cứu thông tin khách hàng bưu cục theo ID để kiểm soát chi tiết lịch sử giao nhận hàng.</p>
        </div>

        <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm">
            <form action="{{ route('agent.customers.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                <div class="relative flex-1 input-focus rounded-xl border-2 border-gray-200 bg-gray-50 flex items-center transition-all">
                    <div class="pl-4 flex items-center text-gray-400"><i data-lucide="search" class="w-5 h-5"></i></div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nhập mã số ID Khách hàng, số điện thoại hoặc email hệ thống..." class="w-full pl-3 pr-4 py-3 bg-transparent border-none focus:ring-0 focus:outline-none text-gray-800 font-medium text-sm">
                </div>
                <button type="submit" class="bg-primary-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-700 transition-all text-sm shrink-0 shadow-lg"><span>Tra cứu khách hàng</span></button>
            </form>
        </div>

        @if(request()->filled('search'))
            <div>
                @if($customer)
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col items-center text-center justify-center">
                            <div class="w-14 h-14 rounded-2xl bg-primary-100 text-primary-700 flex items-center justify-center font-extrabold text-xl shadow-inner mb-3">{{ strtoupper(substr($customer->full_name ?? 'C', 0, 1)) }}</div>
                            <span class="text-xs font-bold text-primary-600 bg-primary-50 px-2.5 py-0.5 rounded-full mb-1">ID Khách: #{{ $customer->id }}</span>
                            <h4 class="text-lg font-bold text-gray-900">
                                <a href="{{ route('agent.customers.show', $customer->id) }}" class="text-primary-600 hover:underline">{{ $customer->full_name }}</a>
                            </h4>
                            <div class="w-full space-y-2 text-xs font-medium text-gray-500 border-t border-gray-100 pt-4 mt-4 text-left">
                                <div class="flex items-center space-x-2"><i data-lucide="phone" class="w-4 h-4"></i> <span class="text-gray-700 font-semibold">{{ $customer->phone }}</span></div>
                                <div class="flex items-center space-x-2"><i data-lucide="mail" class="w-4 h-4"></i> <span class="text-gray-700 font-semibold truncate block max-w-[220px]">{{ $customer->email }}</span></div>
                            </div>
                        </div>
                        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
                            <h4 class="font-bold text-gray-900 mb-4 flex items-center text-base"><i data-lucide="history" class="w-5 h-5 text-gray-400 mr-2"></i> Lịch sử gửi hàng tại đại lý bưu cục</h4>
                            <div class="space-y-2.5 max-h-[160px] overflow-y-auto pr-1 flex-1">
                                @forelse($customerOrders as $order)
                                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex justify-between items-center text-xs font-medium">
                                        <div><span class="font-bold text-gray-900">{{ $order->tracking_id }}</span><div class="text-gray-400 mt-0.5">Người nhận: <span class="text-gray-600 font-semibold">{{ $order->receiver_name }}</span></div></div>
                                        <span class="px-2 py-0.5 rounded text-[0.65rem] font-bold uppercase tracking-wider bg-gray-100 text-gray-700">{{ $order->status }}</span>
                                    </div>
                                @empty
                                    <p class="text-gray-400 font-medium text-center py-8 text-xs">Khách hàng này hiện chưa tạo đơn hàng nào đi qua bưu cục của bạn.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl flex items-center space-x-3"><i data-lucide="alert-circle" class="shrink-0 text-amber-600"></i><span class="font-medium text-sm">Không tìm thấy tài khoản khách hàng trùng khớp dữ liệu. Vui lòng kiểm tra lại ID hệ thống!</span></div>
                @endif
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100"><h3 class="font-bold text-gray-900 text-lg">Danh sách khách hàng giao nhận</h3></div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider"><th class="px-6 py-4">Mã số ID</th><th class="px-6 py-4">Họ và Tên khách hàng</th><th class="px-6 py-4">Số Điện Thoại</th><th class="px-6 py-4">Địa Chỉ Email</th><th class="px-6 py-4 text-center">Đơn đã gửi</th></tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm font-medium text-gray-700">
                    @foreach($customers as $user)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 text-xs font-bold text-gray-400">#{{ $user->id }}</td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                <a href="{{ route('agent.customers.show', $user->id) }}" class="text-primary-600 hover:underline">{{ $user->full_name }}</a>
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-semibold tracking-tight">{{ $user->phone }}</td>
                            <td class="px-6 py-4 text-gray-500 font-normal">{{ $user->email }}</td>
                            <td class="px-6 py-4 text-center"><span class="bg-primary-50 text-primary-600 font-bold text-xs px-3 py-1.5 rounded-full">{{ $user->orders_count }} vận đơn</span></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
