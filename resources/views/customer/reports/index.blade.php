@extends('customer.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="bg-gradient-to-r from-red-600 to-red-800 rounded-2xl p-8 text-white mb-6">
            <h1 class="text-3xl font-bold">Báo Cáo Chi Tiết</h1>
            <p class="mt-2 text-red-100">
                Theo dõi tổng chi phí và các đơn hàng bạn đã tạo
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Tổng đơn đã tạo</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalCouriers }}</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Tổng phí vận chuyển</p>
                <h3 class="text-2xl font-bold text-red-600">
                    {{ number_format($totalShippingFee, 0, ',', '.') }} VNĐ
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Đã thanh toán</p>
                <h3 class="text-2xl font-bold text-green-600">
                    {{ number_format($totalPaid, 0, ',', '.') }} VNĐ
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Chưa thanh toán</p>
                <h3 class="text-2xl font-bold text-yellow-600">
                    {{ number_format($totalUnpaid, 0, ',', '.') }} VNĐ
                </h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Chờ xử lý</p>
                <h3 class="text-xl font-bold">{{ $pendingCouriers }}</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Đã giao</p>
                <h3 class="text-xl font-bold">{{ $deliveredCouriers }}</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Thất bại</p>
                <h3 class="text-xl font-bold">{{ $failedCouriers }}</h3>
            </div>
        </div>

        <form method="GET" class="bg-white rounded-xl shadow p-5 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <input type="date" name="from_date"
                       value="{{ request('from_date') }}"
                       class="border rounded-lg px-4 py-2">

                <input type="date" name="to_date"
                       value="{{ request('to_date') }}"
                       class="border rounded-lg px-4 py-2">

                <select name="status" class="border rounded-lg px-4 py-2">
                    <option value="">Tất cả trạng thái</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                    <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Thất bại</option>
                </select>

                <select name="payment_status" class="border rounded-lg px-4 py-2">
                    <option value="">Tất cả thanh toán</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Đã thanh toán</option>
                    <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Chưa thanh toán</option>
                </select>

                <button class="bg-red-600 hover:bg-red-700 text-white rounded-lg px-4 py-2 font-semibold">
                    Lọc báo cáo
                </button>
            </div>
        </form>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-4 text-left text-sm font-bold text-gray-700 w-[120px] whitespace-nowrap">
                            Mã vận đơn
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-bold text-gray-700 w-[160px] whitespace-nowrap">
                            Ngày tạo
                        </th>
                        <th class="px-4 py-3 text-left">Người gửi</th>
                        <th class="px-4 py-3 text-left">Người nhận</th>
                        <th class="px-4 py-3 text-left">Cân nặng</th>
                        <th class="px-4 py-3 text-left">Loại hàng</th>
                        <th class="px-4 py-3 text-left">Phí vận chuyển</th>
                        <th class="px-4 py-3 text-left">COD</th>
                        <th class="px-4 py-3 text-left">Thanh toán</th>
                        <th class="px-4 py-3 text-left">Trạng thái</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($couriers as $courier)
                        <tr class="border-t">
                            <td class="px-4 py-3 font-bold">
                                {{ $courier->tracking_id }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $courier->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $courier->sender_name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $courier->receiver_name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $courier->total_weight }} kg
                            </td>

                            <td class="px-4 py-3">
                                {{ $courier->goods_type ?? 'Chưa cập nhật' }}
                            </td>

                            <td class="px-4 py-3 text-red-600 font-semibold">
                                {{ number_format($courier->shipping_fee, 0, ',', '.') }} VNĐ
                            </td>

                            <td class="px-4 py-3">
                                {{ number_format($courier->cod_amount, 0, ',', '.') }} VNĐ
                            </td>

                            <td class="px-4 py-3">
                                @if ($courier->payment_status == 'paid')
                                    <span class="inline-flex items-center justify-center min-w-[120px] px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold whitespace-nowrap">
            Đã thanh toán
        </span>
                                @else
                                    <span class="inline-flex items-center justify-center min-w-[120px] px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold whitespace-nowrap">
            Chưa thanh toán
        </span>
                                @endif
                            </td>

                            <td class="px-4 py-3">
                                @switch($courier->status)
                                    @case('pending')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold whitespace-nowrap">
                Chờ xử lý
            </span>
                                        @break

                                    @case('shipping')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold whitespace-nowrap">
                Đang giao
            </span>
                                        @break

                                    @case('delivered')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold whitespace-nowrap">
                Đã giao
            </span>
                                        @break

                                    @case('failed')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold whitespace-nowrap">
                Thất bại
            </span>
                                        @break

                                    @default
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold whitespace-nowrap">
                {{ $courier->status }}
            </span>
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-6 text-gray-500">
                                Chưa có đơn hàng nào
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $couriers->links() }}
            </div>
        </div>

    </div>
@endsection
