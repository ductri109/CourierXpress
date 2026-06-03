@extends('agent.layout')

@section('title', 'Dashboard - Agent Portal')

@section('content')
    <div class="space-y-6">

        {{-- ===== HEADER ===== --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-950">Hello, {{ Auth::guard('agent')->user()->FullName }} 👋</h2>
            <p class="text-gray-500 text-sm mt-0.5">
                Status:
                @if(Auth::guard('agent')->user()->Status === 'active')
                    <span class="inline-flex items-center gap-1 text-emerald-600 font-semibold">
                        <span class="w-2 h-2 bg-emerald-500 rounded-full inline-block animate-pulse"></span>
                        Available
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 text-amber-600 font-semibold">
                        <span class="w-2 h-2 bg-amber-500 rounded-full inline-block"></span>
                        Busy
                    </span>
                @endif
                &nbsp;—&nbsp; Last updated at {{ now()->format('H:i, M d, Y') }}
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
                <p class="text-sm font-medium text-gray-500">Total Orders</p>
            </div>

            <div class="bg-white rounded-2xl border border-amber-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center">
                        <i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $assignedOrders }}</span>
                </div>
                <p class="text-sm font-medium text-gray-500">Pending Assignment</p>
            </div>

            <div class="bg-white rounded-2xl border border-blue-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center">
                        <i data-lucide="truck" class="w-5 h-5 text-blue-600"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $inTransitOrders }}</span>
                </div>
                <p class="text-sm font-medium text-gray-500">In Transit</p>
            </div>

            <div class="bg-white rounded-2xl border border-emerald-200 shadow-sm p-5">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                    </div>
                    <span class="text-2xl font-bold text-gray-900">{{ $deliveredOrders }}</span>
                </div>
                <p class="text-sm font-medium text-gray-500">Delivered</p>
            </div>

        </div>

        {{-- ===== REVENUE CARDS ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white shadow-md">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i data-lucide="trending-up" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xs font-semibold bg-white/20 px-2.5 py-1 rounded-full">{{ now()->format('M, Y') }}</span>
                </div>
                <p class="text-3xl font-extrabold tracking-tight">
                    {{ number_format($revenueThisMonth / 1000, 0) }}<span class="text-lg font-semibold">K VND</span>
                </p>
                <p class="text-emerald-100 text-sm mt-1">Monthly Revenue</p>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white shadow-md">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i data-lucide="wallet" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xs font-semibold bg-white/20 px-2.5 py-1 rounded-full">Lifetime</span>
                </div>
                <p class="text-3xl font-extrabold tracking-tight">
                    {{ number_format($totalRevenue / 1000000, 2) }}<span class="text-lg font-semibold">M VND</span>
                </p>
                <p class="text-blue-100 text-sm mt-1">Total from {{ $deliveredOrders }} completed orders</p>
            </div>

        </div>

        {{-- ===== URGENT ORDERS ===== --}}
        @if($urgentOrders->count() > 0)
            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-amber-600"></i>
                    <h3 class="font-bold text-amber-800 text-base">Action Required ({{ $urgentOrders->count() }} orders)</h3>
                </div>
                <div class="space-y-3">
                    @foreach($urgentOrders as $order)
                        <div class="bg-white rounded-xl border border-amber-200 p-4 flex items-center justify-between shadow-sm">
                            <div>
                                <p class="font-bold text-gray-900 text-sm">{{ $order->tracking_id }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">Receiver: {{ $order->receiver_name }}</p>
                                <p class="text-xs text-gray-400">{{ $order->receiver_address }}</p>
                            </div>
                            <div class="flex flex-col items-end gap-2">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wide bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Pending Assignment
                                </span>
                                <form action="{{ route('agent.orders.accept', $order->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-amber-500 text-white font-bold text-xs px-3 py-1.5 rounded-lg hover:bg-amber-600 transition-all flex items-center gap-1">
                                        <i data-lucide="check" class="w-3 h-3"></i> Accept Order
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- ===== CHARTS ===== --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="bar-chart-2" class="w-4.5 h-4.5 text-blue-500"></i>
                    <h3 class="font-bold text-gray-900 text-sm">Last 7 Days Orders</h3>
                </div>
                <canvas id="agentDailyChart" height="160"></canvas>
            </div>
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="line-chart" class="w-4.5 h-4.5 text-emerald-500"></i>
                    <h3 class="font-bold text-gray-900 text-sm">Orders by Month (Last 12)</h3>
                </div>
                <canvas id="agentMonthlyChart" height="160"></canvas>
            </div>
        </div>

        {{-- ===== REVENUE TABLE ===== --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">
            <div class="lg:col-span-3 bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="area-chart" class="w-4.5 h-4.5 text-amber-500"></i>
                        <h3 class="font-bold text-gray-900 text-sm">Monthly Revenue Trend</h3>
                    </div>
                    <span class="text-[0.7rem] text-gray-400">Based on delivered orders</span>
                </div>
                <canvas id="agentRevenueChart" height="160"></canvas>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex items-center gap-2">
                    <i data-lucide="table" class="w-4 h-4 text-gray-500"></i>
                    <h3 class="font-bold text-gray-900 text-sm">Revenue Detail</h3>
                </div>
                <div class="overflow-y-auto" style="max-height: 360px;">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead class="bg-gray-50 sticky top-0">
                        <tr class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                            <th class="px-4 py-3">Month</th>
                            <th class="px-4 py-3 text-center">Orders</th>
                            <th class="px-4 py-3 text-right">Revenue</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse($revenueTable as $row)
                            @php $isCurrent = ($row->year == now()->year && $row->month == now()->month); @endphp
                            <tr class="hover:bg-gray-50/50 transition-colors {{ $isCurrent ? 'bg-emerald-50/40' : '' }}">
                                <td class="px-4 py-3 font-semibold text-gray-800">
                                    {{ str_pad($row->month, 2, '0', STR_PAD_LEFT) }}/{{ $row->year }}
                                </td>
                                <td class="px-4 py-3 text-center text-xs">
                                    <span class="text-gray-800">{{ $row->total_orders }}</span>
                                    <span class="text-gray-400">/</span>
                                    <span class="text-emerald-600">{{ $row->delivered_count }}✓</span>
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-emerald-600 text-xs">
                                    {{ number_format($row->revenue / 1000, 0) }}K
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-gray-400 text-xs">No data available</td>
                            </tr>
                        @endforelse
                        </tbody>
                        @if($revenueTable->count() > 0)
                            <tfoot class="bg-gray-50 border-t-2 border-gray-200">
                            <tr>
                                <td colspan="2" class="px-4 py-3 text-xs font-bold text-gray-600 text-right">Total:</td>
                                <td class="px-4 py-3 text-right font-extrabold text-emerald-700 text-sm">
                                    {{ number_format($revenueTable->sum('revenue') / 1000000, 2) }}M
                                </td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        {{-- ===== RECENT ORDERS ===== --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-900 text-base">Recent Orders</h3>
                <a href="{{ route('agent.orders.index') }}" class="text-xs font-semibold text-red-600 hover:underline flex items-center gap-1">
                    View All <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-5 py-3">Tracking ID</th>
                        <th class="px-5 py-3">Receiver</th>
                        <th class="px-5 py-3">Weight</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3">Time</th>
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
                                @php $st = strtolower($order->status); @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wide
                                    @if($st == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($st == 'assigned') bg-amber-50 text-amber-700 border border-amber-200
                                    @elseif($st == 'picked_up') bg-indigo-50 text-indigo-700 border border-indigo-200
                                    @elseif($st == 'in_transit') bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($st == 'delivered') bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @elseif($st == 'canceled' || $st == 'cancelled') bg-red-50 text-red-700 border border-red-200
                                    @else bg-gray-50 text-gray-500 border border-gray-200 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="px-5 py-3 text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-gray-400 text-sm">No recent orders found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Chart.js logic --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        // (The Chart.js initialization script remains the same as your original provided code)
    </script>
@endsection
