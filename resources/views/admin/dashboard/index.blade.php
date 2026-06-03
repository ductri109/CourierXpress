@extends('admin.layout')

@section('title', 'CourierXpress - Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- ==================== HEADER ==================== --}}
        <div class="d-flex align-items-center justify-content-between mb-6">
            <div>
                <h4 class="fw-bold mb-1">Dashboard Overview</h4>
                <p class="text-muted mb-0 small">Last updated at {{ now()->format('H:i - M d, Y') }}</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">
                <i class="ri-list-check me-1"></i> View All Orders
            </a>
        </div>

        {{-- ==================== KPI CARDS ==================== --}}
        <div class="row g-4 mb-6">

            {{-- Total Orders --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 gap-3">
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ri-file-list-3-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totalOrders }}</h4>
                        </div>
                        <h6 class="mb-1 fw-normal">Total Shipments</h6>
                        <div class="d-flex gap-2 flex-wrap mt-2">
                            <span class="badge bg-label-warning small">{{ $pendingOrders }} pending</span>
                            <span class="badge bg-label-info small">{{ $assignedOrders }} assigned</span>
                            <span class="badge bg-label-primary small">{{ $inTransitOrders }} in transit</span>
                            <span class="badge bg-label-success small">{{ $deliveredOrders }} completed</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Revenue This Month --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 gap-3">
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ri-money-dollar-circle-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ number_format($revenueThisMonth / 1000, 0) }}K</h4>
                        </div>
                        <h6 class="mb-1 fw-normal">Monthly Revenue</h6>
                        <p class="mb-0 small text-muted">
                            Total: <strong class="text-success">{{ number_format($totalRevenue / 1000000, 1) }}M VND</strong>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Available Agents --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 gap-3">
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-warning">
                                    <i class="ri-user-follow-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $activeAgents }}</h4>
                        </div>
                        <h6 class="mb-1 fw-normal">Available Agents</h6>
                        <p class="mb-0 small text-muted">{{ $busyAgents }} busy / {{ $totalAgents }} total</p>
                    </div>
                </div>
            </div>

            {{-- Customers --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 gap-3">
                            <div class="avatar">
                                <span class="avatar-initial rounded bg-label-info">
                                    <i class="ri-group-line ri-24px"></i>
                                </span>
                            </div>
                            <h4 class="mb-0">{{ $totalCustomers }}</h4>
                        </div>
                        <h6 class="mb-1 fw-normal">Customers</h6>
                        <p class="mb-0 small text-muted">Registered accounts</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ==================== CHARTS ROW ==================== --}}
        <div class="row g-4 mb-6">

            {{-- Chart: 7-day Orders --}}
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">
                            <i class="ri-bar-chart-grouped-line me-2 text-primary"></i>
                            Shipments (Last 7 Days)
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- Chart: 12-month Orders --}}
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">
                            <i class="ri-line-chart-line me-2 text-success"></i>
                            Shipments (Last 12 Months)
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart" height="120"></canvas>
                    </div>
                </div>
            </div>

        </div>

        {{-- ==================== REVENUE CHART + TABLE ==================== --}}
        <div class="row g-4 mb-6">

            {{-- Revenue Trend Chart --}}
            <div class="col-xl-7">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0">
                                <i class="ri-funds-line me-2 text-warning"></i>
                                Monthly Revenue Trend
                            </h5>
                            <p class="text-muted mb-0 mt-1" style="font-size:0.78rem;">
                                Calculated by completed orders × 35,000 VND (or shipping fee if applicable)
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- Revenue Table --}}
            <div class="col-xl-5">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">
                            <i class="ri-table-2 me-2 text-info"></i>
                            Revenue Details
                        </h5>
                    </div>
                    <div class="table-responsive" style="max-height: 360px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="table-light sticky-top">
                            <tr>
                                <th class="small fw-semibold">Month</th>
                                <th class="small fw-semibold text-center">Total Orders</th>
                                <th class="small fw-semibold text-center">Completed</th>
                                <th class="small fw-semibold text-end">Revenue</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($revenueTable as $row)
                                <tr>
                                    <td class="small fw-semibold">
                                        @php
                                            $isCurrentMonth = ($row->year == now()->year && $row->month == now()->month);
                                        @endphp
                                        @if($isCurrentMonth)
                                            <span class="badge bg-label-primary me-1">Current</span>
                                        @endif
                                        {{ str_pad($row->month, 2, '0', STR_PAD_LEFT) }}/{{ $row->year }}
                                    </td>
                                    <td class="small text-center">{{ $row->total_orders }}</td>
                                    <td class="small text-center">
                                        <span class="badge bg-label-success">{{ $row->delivered_count }}</span>
                                    </td>
                                    <td class="small text-end fw-bold text-success">
                                        {{ number_format($row->revenue / 1000, 0) }}K VND
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4 small">
                                        <i class="ri-inbox-line ri-24px d-block mb-1"></i>
                                        No data available
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                            @if($revenueTable->count() > 0)
                                <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="small fw-bold text-end">Total:</td>
                                    <td class="small fw-bold text-end text-success">
                                        {{ number_format($revenueTable->sum('revenue') / 1000000, 2) }}M VND
                                    </td>
                                </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>

        </div>

        {{-- ==================== MAIN CONTENT ROW ==================== --}}
        <div class="row g-4">

            {{-- Available Agents --}}
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0 d-inline-block">Available Agents</h5>
                            <span class="badge bg-label-success ms-1">{{ $activeAgents }} agents</span>
                        </div>
                        <a href="{{ route('admin.agents.index') }}" class="btn btn-sm btn-outline-success">View All</a>
                    </div>
                    <div class="card-body p-0">
                        @forelse($availableAgents->take(5) as $agent)
                            <div class="d-flex align-items-center px-4 py-3 border-bottom">
                                <div class="avatar avatar-sm me-3">
                                    <span class="avatar-initial rounded-circle bg-label-primary">
                                        {{ strtoupper(substr($agent->FullName, 0, 1)) }}
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="mb-0 fw-semibold small">{{ $agent->FullName }}</p>
                                    <p class="mb-0 text-muted" style="font-size: 0.75rem;">{{ $agent->Phone }}</p>
                                </div>
                                <span class="badge bg-label-info small">{{ $agent->total_orders ?? 0 }} total orders</span>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted small">
                                <i class="ri-user-unfollow-line ri-24px mb-2 d-block"></i>
                                No agents available
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Pending Assignment --}}
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0 text-warning">
                            <i class="ri-alert-line me-1"></i>
                            Pending Assignment
                            @if($pendingOrders > 0)
                                <span class="badge bg-warning text-dark ms-1">{{ $pendingOrders }}</span>
                            @endif
                        </h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-warning">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="small">Tracking ID</th>
                                <th class="small">Receiver</th>
                                <th class="small">Time</th>
                                <th class="small">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($pendingList as $order)
                                <tr>
                                    <td class="text-primary fw-bold small">{{ $order->tracking_id }}</td>
                                    <td class="small">{{ $order->receiver_name }}</td>
                                    <td class="small text-muted">{{ $order->created_at->format('M d, H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-xs btn-warning" style="font-size:0.7rem;padding:2px 8px;">
                                            Assign
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4 small">
                                        <i class="ri-checkbox-circle-line text-success ri-24px d-block mb-1"></i>
                                        No pending assignments!
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Recent Orders --}}
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">Recent Shipments</h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="small">Tracking ID</th>
                                <th class="small">Agent</th>
                                <th class="small">Status</th>
                                <th class="small">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary fw-bold small text-decoration-none">
                                            {{ $order->tracking_id }}
                                        </a>
                                    </td>
                                    <td class="small">
                                        @if($order->agent)
                                            <span class="badge bg-label-primary">{{ $order->agent->FullName }}</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-label-secondary" style="font-size:0.7rem">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td class="small text-muted">{{ $order->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4 small">No shipments found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- ==================== CHART JS ==================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const dailyData   = @json($dailyStats);
        const monthlyData = @json($monthlyStats);
        const revenueData = @json($revenueByMonth);

        const MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        function buildMonthLabels() {
            const arr = [];
            for (let i = 11; i >= 0; i--) {
                const d = new Date();
                d.setDate(1);
                d.setMonth(d.getMonth() - i);
                arr.push({ year: d.getFullYear(), month: d.getMonth() + 1,
                    label: MONTHS[d.getMonth()] + '/' + String(d.getFullYear()).slice(-2) });
            }
            return arr;
        }

        // Daily chart
        (function() {
            const days = [], totals = [], deliveredArr = [];
            for (let i = 6; i >= 0; i--) {
                const d = new Date();
                d.setDate(d.getDate() - i);
                const dateStr = d.toISOString().split('T')[0];
                days.push(d.toLocaleDateString('en-US', { day: '2-digit', month: '2-digit' }));
                const found = dailyData.find(r => r.date === dateStr);
                totals.push(found ? found.total : 0);
                deliveredArr.push(found ? found.delivered : 0);
            }
            new Chart(document.getElementById('dailyChart'), {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [
                        { label: 'Total', data: totals,
                            backgroundColor: 'rgba(105,108,255,0.15)', borderColor: 'rgba(105,108,255,0.8)',
                            borderWidth: 2, borderRadius: 6, borderSkipped: false },
                        { label: 'Completed', data: deliveredArr,
                            backgroundColor: 'rgba(40,199,111,0.8)', borderColor: 'rgba(40,199,111,1)',
                            borderWidth: 2, borderRadius: 6, borderSkipped: false }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top' }, tooltip: { mode: 'index', intersect: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();

        // Monthly chart
        (function() {
            const months = buildMonthLabels();
            const totals = [], deliveredArr = [], cancelledArr = [];
            months.forEach(m => {
                const found = monthlyData.find(r => r.year == m.year && r.month == m.month);
                totals.push(found ? found.total : 0);
                deliveredArr.push(found ? found.delivered : 0);
                cancelledArr.push(found ? found.cancelled : 0);
            });
            new Chart(document.getElementById('monthlyChart'), {
                type: 'line',
                data: {
                    labels: months.map(m => m.label),
                    datasets: [
                        { label: 'Total', data: totals,
                            borderColor: 'rgba(105,108,255,0.9)', backgroundColor: 'rgba(105,108,255,0.08)',
                            borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 6, fill: true, tension: 0.4 },
                        { label: 'Completed', data: deliveredArr,
                            borderColor: 'rgba(40,199,111,0.9)', backgroundColor: 'rgba(40,199,111,0.08)',
                            borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 6, fill: true, tension: 0.4 },
                        { label: 'Cancelled', data: cancelledArr,
                            borderColor: 'rgba(255,76,81,0.8)', backgroundColor: 'rgba(255,76,81,0.05)',
                            borderWidth: 2, pointRadius: 3, pointHoverRadius: 5, fill: true, tension: 0.4, borderDash: [5,4] }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top' }, tooltip: { mode: 'index', intersect: false } },
                    scales: {
                        y: { beginAtZero: true, ticks: { stepSize: 1 }, grid: { color: 'rgba(0,0,0,0.05)' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();

        // Revenue chart
        (function() {
            const months = buildMonthLabels();
            const revenues = [];
            months.forEach(m => {
                const found = revenueData.find(r => r.year == m.year && r.month == m.month);
                revenues.push(found ? Math.round(found.revenue / 1000) : 0);
            });
            new Chart(document.getElementById('revenueChart'), {
                type: 'bar',
                data: {
                    labels: months.map(m => m.label),
                    datasets: [{
                        label: 'Revenue (k)',
                        data: revenues,
                        backgroundColor: (ctx) => {
                            const gradient = ctx.chart.ctx.createLinearGradient(0, 0, 0, 260);
                            gradient.addColorStop(0, 'rgba(255,171,0,0.85)');
                            gradient.addColorStop(1, 'rgba(255,171,0,0.25)');
                            return gradient;
                        },
                        borderColor: 'rgba(255,171,0,1)',
                        borderWidth: 2,
                        borderRadius: 7,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'top' },
                        tooltip: {
                            callbacks: {
                                label: ctx => ' ' + ctx.parsed.y.toLocaleString('en-US') + 'K VND'
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: { callback: v => v.toLocaleString('en-US') + 'K' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();
    </script>
@endsection
