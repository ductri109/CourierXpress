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

        {{-- ===== DOANH THU CARDS ===== --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white shadow-md">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i data-lucide="trending-up" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xs font-semibold bg-white/20 px-2.5 py-1 rounded-full">Tháng {{ now()->format('m/Y') }}</span>
                </div>
                <p class="text-3xl font-extrabold tracking-tight">
                    {{ number_format($revenueThisMonth / 1000, 0) }}<span class="text-lg font-semibold">K đ</span>
                </p>
                <p class="text-emerald-100 text-sm mt-1">Doanh thu tháng này</p>
            </div>

            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white shadow-md">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i data-lucide="wallet" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-xs font-semibold bg-white/20 px-2.5 py-1 rounded-full">Tổng tích lũy</span>
                </div>
                <p class="text-3xl font-extrabold tracking-tight">
                    {{ number_format($totalRevenue / 1000000, 2) }}<span class="text-lg font-semibold">M đ</span>
                </p>
                <p class="text-blue-100 text-sm mt-1">Tổng doanh thu từ {{ $deliveredOrders }} đơn hoàn thành</p>
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
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wide bg-amber-50 text-amber-700 border border-amber-200">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Chờ nhận
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

        {{-- ===== CHARTS ===== --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

            {{-- Chart: 7 ngày --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="bar-chart-2" class="w-4.5 h-4.5 text-blue-500"></i>
                    <h3 class="font-bold text-gray-900 text-sm">Đơn hàng 7 ngày gần nhất</h3>
                </div>
                <canvas id="agentDailyChart" height="160"></canvas>
            </div>

            {{-- Chart: 12 tháng --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="line-chart" class="w-4.5 h-4.5 text-emerald-500"></i>
                    <h3 class="font-bold text-gray-900 text-sm">Đơn hàng theo tháng (12 tháng)</h3>
                </div>
                <canvas id="agentMonthlyChart" height="160"></canvas>
            </div>

        </div>

        {{-- ===== CHART DOANH THU + BẢNG DOANH THU ===== --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-4">

            {{-- Chart doanh thu --}}
            <div class="lg:col-span-3 bg-white rounded-2xl border border-gray-200 shadow-sm p-5">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="area-chart" class="w-4.5 h-4.5 text-amber-500"></i>
                        <h3 class="font-bold text-gray-900 text-sm">Doanh thu theo tháng</h3>
                    </div>
                    <span class="text-[0.7rem] text-gray-400">Tính theo đơn hoàn thành × 35K</span>
                </div>
                <canvas id="agentRevenueChart" height="160"></canvas>
            </div>

            {{-- Bảng doanh thu --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="p-5 border-b border-gray-100 flex items-center gap-2">
                    <i data-lucide="table" class="w-4 h-4 text-gray-500"></i>
                    <h3 class="font-bold text-gray-900 text-sm">Bảng doanh thu chi tiết</h3>
                </div>
                <div class="overflow-y-auto" style="max-height: 360px;">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead class="bg-gray-50 sticky top-0">
                        <tr class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-200">
                            <th class="px-4 py-3">Tháng</th>
                            <th class="px-4 py-3 text-center">Đơn</th>
                            <th class="px-4 py-3 text-right">Doanh thu</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700">
                        @forelse($revenueTable as $row)
                            @php $isCurrent = ($row->year == now()->year && $row->month == now()->month); @endphp
                            <tr class="hover:bg-gray-50/50 transition-colors {{ $isCurrent ? 'bg-emerald-50/40' : '' }}">
                                <td class="px-4 py-3 font-semibold text-gray-800">
                                    @if($isCurrent)
                                        <span class="inline-block w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1 mb-0.5 animate-pulse"></span>
                                    @endif
                                    T{{ str_pad($row->month, 2, '0', STR_PAD_LEFT) }}/{{ $row->year }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="text-xs font-semibold">
                                        <span class="text-gray-800">{{ $row->total_orders }}</span>
                                        <span class="text-gray-400 mx-0.5">/</span>
                                        <span class="text-emerald-600">{{ $row->delivered_count }}✓</span>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right font-bold text-emerald-600 text-xs">
                                    {{ number_format($row->revenue / 1000, 0) }}K đ
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-8 text-center text-gray-400 text-xs">
                                    <i data-lucide="inbox" class="w-6 h-6 mx-auto mb-2 text-gray-300"></i>
                                    <p>Chưa có dữ liệu doanh thu</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                        @if($revenueTable->count() > 0)
                            <tfoot class="bg-gray-50 border-t-2 border-gray-200">
                            <tr>
                                <td colspan="2" class="px-4 py-3 text-xs font-bold text-gray-600 text-right">Tổng:</td>
                                <td class="px-4 py-3 text-right font-extrabold text-emerald-700 text-sm">
                                    {{ number_format($revenueTable->sum('revenue') / 1000000, 2) }}M đ
                                </td>
                            </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
            </div>

        </div>

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
                                @php $st = strtolower($order->status); @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wide
                                    @if($st == 'pending') bg-yellow-50 text-yellow-700 border border-yellow-200
                                    @elseif($st == 'assigned') bg-amber-50 text-amber-700 border border-amber-200
                                    @elseif($st == 'picked_up') bg-indigo-50 text-indigo-700 border border-indigo-200
                                    @elseif($st == 'in_transit') bg-blue-50 text-blue-700 border border-blue-200
                                    @elseif($st == 'delivered') bg-emerald-50 text-emerald-700 border border-emerald-200
                                    @elseif($st == 'canceled' || $st == 'cancelled') bg-red-50 text-red-700 border border-red-200
                                    @else bg-gray-50 text-gray-500 border border-gray-200 @endif">
                                    @if($st == 'pending') <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span> Chờ xử lý
                                    @elseif($st == 'assigned') <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Chờ nhận
                                    @elseif($st == 'picked_up') <span class="w-1.5 h-1.5 rounded-full bg-indigo-500"></span> Đã lấy hàng
                                    @elseif($st == 'in_transit') <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Đang giao
                                    @elseif($st == 'delivered') <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Đã giao
                                    @elseif($st == 'canceled' || $st == 'cancelled') <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Đã hủy
                                    @else {{ $order->status }}
                                    @endif
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

    {{-- ===== CHART JS ===== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const agentDailyData   = @json($dailyStats);
        const agentMonthlyData = @json($monthlyStats);
        const agentRevenueData = @json($revenueByMonth);

        const MONTHS_VI = ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'];

        function buildMonthLabels() {
            const arr = [];
            for (let i = 11; i >= 0; i--) {
                const d = new Date();
                d.setDate(1);
                d.setMonth(d.getMonth() - i);
                arr.push({ year: d.getFullYear(), month: d.getMonth() + 1,
                    label: MONTHS_VI[d.getMonth()] + '/' + String(d.getFullYear()).slice(-2) });
            }
            return arr;
        }

        // Daily chart
        (function () {
            const days = [], totals = [], deliveredArr = [];
            for (let i = 6; i >= 0; i--) {
                const d = new Date(); d.setDate(d.getDate() - i);
                const dateStr = d.toISOString().split('T')[0];
                days.push(d.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' }));
                const f = agentDailyData.find(r => r.date === dateStr);
                totals.push(f ? f.total : 0); deliveredArr.push(f ? f.delivered : 0);
            }
            new Chart(document.getElementById('agentDailyChart'), {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [
                        { label: 'Tổng đơn', data: totals,
                            backgroundColor: 'rgba(59,130,246,0.15)', borderColor: 'rgba(59,130,246,0.8)',
                            borderWidth: 2, borderRadius: 6, borderSkipped: false },
                        { label: 'Hoàn thành', data: deliveredArr,
                            backgroundColor: 'rgba(16,185,129,0.8)', borderColor: 'rgba(16,185,129,1)',
                            borderWidth: 2, borderRadius: 6, borderSkipped: false }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top' }, tooltip: { mode: 'index', intersect: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.04)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();

        // Monthly chart
        (function () {
            const months = buildMonthLabels();
            const totals = [], deliveredArr = [], cancelledArr = [];
            months.forEach(m => {
                const f = agentMonthlyData.find(r => r.year == m.year && r.month == m.month);
                totals.push(f ? f.total : 0);
                deliveredArr.push(f ? f.delivered : 0);
                cancelledArr.push(f ? f.cancelled : 0);
            });
            new Chart(document.getElementById('agentMonthlyChart'), {
                type: 'line',
                data: {
                    labels: months.map(m => m.label),
                    datasets: [
                        { label: 'Tổng đơn', data: totals,
                            borderColor: 'rgba(59,130,246,0.9)', backgroundColor: 'rgba(59,130,246,0.07)',
                            borderWidth: 2.5, pointRadius: 4, fill: true, tension: 0.4 },
                        { label: 'Hoàn thành', data: deliveredArr,
                            borderColor: 'rgba(16,185,129,0.9)', backgroundColor: 'rgba(16,185,129,0.07)',
                            borderWidth: 2.5, pointRadius: 4, fill: true, tension: 0.4 },
                        { label: 'Đã hủy', data: cancelledArr,
                            borderColor: 'rgba(239,68,68,0.8)', backgroundColor: 'rgba(239,68,68,0.04)',
                            borderWidth: 1.5, pointRadius: 3, fill: true, tension: 0.4, borderDash: [4,3] }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top' }, tooltip: { mode: 'index', intersect: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.04)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();

        // Revenue chart
        (function () {
            const months = buildMonthLabels();
            const revenues = [];
            months.forEach(m => {
                const f = agentRevenueData.find(r => r.year == m.year && r.month == m.month);
                revenues.push(f ? Math.round(f.revenue / 1000) : 0);
            });
            new Chart(document.getElementById('agentRevenueChart'), {
                type: 'bar',
                data: {
                    labels: months.map(m => m.label),
                    datasets: [{
                        label: 'Doanh thu (nghìn đồng)',
                        data: revenues,
                        backgroundColor: (ctx) => {
                            const g = ctx.chart.ctx.createLinearGradient(0, 0, 0, 240);
                            g.addColorStop(0, 'rgba(16,185,129,0.85)');
                            g.addColorStop(1, 'rgba(16,185,129,0.20)');
                            return g;
                        },
                        borderColor: 'rgba(16,185,129,1)',
                        borderWidth: 2, borderRadius: 7, borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        tooltip: { callbacks: { label: ctx => ' ' + ctx.parsed.y.toLocaleString('vi-VN') + 'K đ' } }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' },
                            ticks: { callback: v => v.toLocaleString('vi-VN') + 'K' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();
    </script>
@endsection
