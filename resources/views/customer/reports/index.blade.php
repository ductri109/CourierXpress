@extends('customer.layout')

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="bg-gradient-to-r from-red-600 to-red-800 rounded-2xl p-8 text-white mb-6 mt-24 sm:mt-20">
            <h1 class="text-3xl font-bold">Detailed Report</h1>
            <p class="mt-2 text-red-100">
                Track your total expenses and the orders you have created
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Total Orders Created</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $totalCouriers }}</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Total Shipping Fees</p>
                <h3 class="text-2xl font-bold text-red-600">
                    {{ number_format($totalShippingFee, 0, ',', '.') }} VNĐ
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Total Paid</p>
                <h3 class="text-2xl font-bold text-green-600">
                    {{ number_format($totalPaid, 0, ',', '.') }} VNĐ
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Total Unpaid</p>
                <h3 class="text-2xl font-bold text-yellow-600">
                    {{ number_format($totalUnpaid, 0, ',', '.') }} VNĐ
                </h3>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Pending</p>
                <h3 class="text-xl font-bold">{{ $pendingCouriers }}</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Delivered</p>
                <h3 class="text-xl font-bold">{{ $deliveredCouriers }}</h3>
            </div>

            <div class="bg-white rounded-xl shadow p-5">
                <p class="text-gray-500 text-sm">Failed</p>
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
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="shipping" {{ request('status') == 'shipping' ? 'selected' : '' }}>In Transit</option>
                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>

                <select name="payment_status" class="border rounded-lg px-4 py-2">
                    <option value="">All Payments</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>

                <button class="bg-red-600 hover:bg-red-700 text-white rounded-lg px-4 py-2 font-semibold">
                    Filter Report
                </button>
            </div>
        </form>

        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-100 text-gray-600">
                    <tr>
                        <th class="px-4 py-4 text-left text-sm font-bold text-gray-700 w-[120px] whitespace-nowrap">
                            Tracking ID
                        </th>

                        <th class="px-4 py-4 text-left text-sm font-bold text-gray-700 w-[160px] whitespace-nowrap">
                            Created Date
                        </th>
                        <th class="px-4 py-3 text-left">Sender</th>
                        <th class="px-4 py-3 text-left">Receiver</th>
                        <th class="px-4 py-3 text-left">Weight</th>
                        <th class="px-4 py-3 text-left">Goods Type</th>
                        <th class="px-4 py-3 text-left">Shipping Fee</th>
                        <th class="px-4 py-3 text-left">COD</th>
                        <th class="px-4 py-3 text-left">Payment Status</th>
                        <th class="px-4 py-3 text-left">Order Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse ($couriers as $courier)
                        <tr class="border-t hover:bg-gray-50 transition">
                            {{-- 1. Tracking ID --}}
                            <td class="px-4 py-4 align-middle">
            <span class="font-bold text-gray-900 whitespace-nowrap">
                {{ $courier->tracking_id ?? 'N/A' }}
            </span>
                            </td>

                            {{-- 2. Created Date --}}
                            <td class="px-4 py-4 align-middle">
                                <div class="text-gray-900 whitespace-nowrap">
                                    {{ $courier->created_at->format('m/d/Y') }}
                                </div>
                                <div class="text-sm text-gray-500 whitespace-nowrap">
                                    {{ $courier->created_at->format('H:i') }}
                                </div>
                            </td>

                            {{-- 3. Sender --}}
                            <td class="px-4 py-4 align-middle">
                                {{ $courier->sender_name }}
                            </td>

                            {{-- 4. Receiver --}}
                            <td class="px-4 py-4 align-middle">
                                {{ $courier->receiver_name }}
                            </td>

                            {{-- 5. Weight --}}
                            <td class="px-4 py-4 align-middle whitespace-nowrap">
                                {{ $courier->total_weight }} kg
                            </td>

                            {{-- 6. Goods Type --}}
                            <td class="px-4 py-4 align-middle">
                                @php
                                    $goodsTypeMap = [
                                        'quần áo' => 'Clothes',
                                        'quan ao' => 'Clothes',
                                        'tài liệu' => 'Documents',
                                        'tai lieu' => 'Documents',
                                        'điện tử' => 'Electronics',
                                        'dien tu' => 'Electronics',
                                        'thực phẩm' => 'Food',
                                        'thuc pham' => 'Food',
                                        'mỹ phẩm' => 'Cosmetics',
                                        'my pham' => 'Cosmetics',
                                        'hàng dễ vỡ' => 'Fragile Goods',
                                        'hang de vo' => 'Fragile Goods',
                                        'thực phẩm khô' => 'Dry Food',
                                        'thuc pham kho' => 'Dry Food',
                                        'khác' => 'Other',
                                        'khac' => 'Other',
                                    ];

                                    $goodsType = strtolower(trim($courier->goods_type ?? ''));
                                @endphp

                                {{ $goodsTypeMap[$goodsType] ?? ($courier->goods_type ?? 'Not updated') }}
                            </td>

                            {{-- 7. Shipping Fee --}}
                            <td class="px-4 py-4 align-middle text-red-600 font-bold whitespace-nowrap">
                                {{ number_format($courier->shipping_fee ?? 0, 0, ',', '.') }} VNĐ
                            </td>

                            {{-- 8. COD --}}
                            <td class="px-4 py-4 align-middle whitespace-nowrap">
                                {{ number_format($courier->cod_amount ?? 0, 0, ',', '.') }} VNĐ
                            </td>

                            {{-- 9. Payment Status --}}
                            <td class="px-4 py-4 align-middle">
                                @if ($courier->status === 'delivered' || $courier->payment_status === 'paid')
                                    <span class="inline-flex items-center justify-center min-w-[120px] px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold whitespace-nowrap">
                    Paid
                </span>
                                @else
                                    <span class="inline-flex items-center justify-center min-w-[120px] px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold whitespace-nowrap">
                    Unpaid
                </span>
                                @endif
                            </td>

                            {{-- 10. Order Status --}}
                            <td class="px-4 py-4 align-middle">
                                @switch($courier->status)
                                    @case('pending')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold whitespace-nowrap">
                        Pending
                    </span>
                                        @break

                                    @case('shipping')
                                    @case('in_transit')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold whitespace-nowrap">
                        In Transit
                    </span>
                                        @break

                                    @case('delivered')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold whitespace-nowrap">
                        Delivered
                    </span>
                                        @break

                                    @case('failed')
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold whitespace-nowrap">
                        Failed
                    </span>
                                        @break

                                    @default
                                        <span class="inline-flex items-center justify-center min-w-[110px] px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold whitespace-nowrap">
                        {{ ucfirst($courier->status) }}
                    </span>
                                @endswitch
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-6 text-gray-500">
                                No orders found
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
