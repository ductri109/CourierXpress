@extends('admin.layout')

@section('title', 'CourierXpress - Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        {{-- ==================== HEADER ==================== --}}
        <div class="d-flex align-items-center justify-content-between mb-6">
            <div>
                <h4 class="fw-bold mb-1">Dashboard Tổng Quan</h4>
                <p class="text-muted mb-0 small">Cập nhật lúc {{ now()->format('H:i - d/m/Y') }}</p>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">
                <i class="ri-list-check me-1"></i> Xem tất cả đơn hàng
            </a>
        </div>

        {{-- ==================== KPI CARDS ==================== --}}
        <div class="row g-4 mb-6">

            {{-- Tổng đơn hàng --}}
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
                        <h6 class="mb-1 fw-normal">Tổng vận đơn</h6>
                        <div class="d-flex gap-2 flex-wrap mt-2">
                            <span class="badge bg-label-warning small">{{ $pendingOrders }} chờ</span>
                            <span class="badge bg-label-info small">{{ $assignedOrders }} gán</span>
                            <span class="badge bg-label-primary small">{{ $inTransitOrders }} đang giao</span>
                            <span class="badge bg-label-success small">{{ $deliveredOrders }} hoàn thành</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Doanh thu tháng này --}}
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
                        <h6 class="mb-1 fw-normal">Doanh thu tháng này</h6>
                        <p class="mb-0 small text-muted">
                            Tổng: <strong class="text-success">{{ number_format($totalRevenue / 1000000, 1) }}M đ</strong>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Agent sẵn sàng --}}
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
                        <h6 class="mb-1 fw-normal">Agent đang rảnh</h6>
                        <p class="mb-0 small text-muted">{{ $busyAgents }} đang bận / {{ $totalAgents }} tổng</p>
                    </div>
                </div>
            </div>

            {{-- Khách hàng --}}
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
                        <h6 class="mb-1 fw-normal">Khách hàng</h6>
                        <p class="mb-0 small text-muted">Đã đăng ký tài khoản</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- ==================== CHARTS ROW ==================== --}}
        <div class="row g-4 mb-6">

            {{-- ===== CHART: Đơn hàng 7 ngày ===== --}}
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">
                            <i class="ri-bar-chart-grouped-line me-2 text-primary"></i>
                            Vận đơn 7 ngày gần nhất
                        </h5>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- ===== CHART: Đơn hàng theo tháng ===== --}}
            <div class="col-xl-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">
                            <i class="ri-line-chart-line me-2 text-success"></i>
                            Vận đơn theo tháng (12 tháng)
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

            {{-- ===== CHART: Doanh thu theo tháng ===== --}}
            <div class="col-xl-7">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0">
                                <i class="ri-funds-line me-2 text-warning"></i>
                                Doanh thu theo tháng
                            </h5>
                            <p class="text-muted mb-0 mt-1" style="font-size:0.78rem;">
                                Tính theo đơn hoàn thành × 35,000đ (hoặc phí vận chuyển nếu có)
                            </p>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart" height="120"></canvas>
                    </div>
                </div>
            </div>

            {{-- ===== BẢNG: Tổng doanh thu từng tháng ===== --}}
            <div class="col-xl-5">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">
                            <i class="ri-table-2 me-2 text-info"></i>
                            Bảng doanh thu chi tiết
                        </h5>
                    </div>
                    <div class="table-responsive" style="max-height: 360px; overflow-y: auto;">
                        <table class="table table-hover mb-0">
                            <thead class="table-light sticky-top">
                            <tr>
                                <th class="small fw-semibold">Tháng</th>
                                <th class="small fw-semibold text-center">Tổng đơn</th>
                                <th class="small fw-semibold text-center">Hoàn thành</th>
                                <th class="small fw-semibold text-end">Doanh thu</th>
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
                                            <span class="badge bg-label-primary me-1">Hiện tại</span>
                                        @endif
                                        T{{ str_pad($row->month, 2, '0', STR_PAD_LEFT) }}/{{ $row->year }}
                                    </td>
                                    <td class="small text-center">{{ $row->total_orders }}</td>
                                    <td class="small text-center">
                                        <span class="badge bg-label-success">{{ $row->delivered_count }}</span>
                                    </td>
                                    <td class="small text-end fw-bold text-success">
                                        {{ number_format($row->revenue / 1000, 0) }}K đ
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4 small">
                                        <i class="ri-inbox-line ri-24px d-block mb-1"></i>
                                        Chưa có dữ liệu
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                            @if($revenueTable->count() > 0)
                                <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="small fw-bold text-end">Tổng cộng:</td>
                                    <td class="small fw-bold text-end text-success">
                                        {{ number_format($revenueTable->sum('revenue') / 1000000, 2) }}M đ
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

            {{-- ===== AGENT RẢNH ===== --}}
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="m-0 d-inline-block">Agent đang rảnh</h5>
                            <span class="badge bg-label-success ms-1">{{ $activeAgents }} người</span>
                        </div>
                        <a href="{{ route('admin.agents.index') }}" class="btn btn-sm btn-outline-success">Xem tất cả</a>
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
                                <span class="badge bg-label-info small">{{ $agent->total_orders ?? 0 }} đơn tổng</span>
                            </div>
                        @empty
                            <div class="p-4 text-center text-muted small">
                                <i class="ri-user-unfollow-line ri-24px mb-2 d-block"></i>
                                Hiện không có agent nào rảnh
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- ===== BẢNG ĐƠN CHỜ GÁN ===== --}}
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0 text-warning">
                            <i class="ri-alert-line me-1"></i>
                            Đơn chờ gán
                            @if($pendingOrders > 0)
                                <span class="badge bg-warning text-dark ms-1">{{ $pendingOrders }}</span>
                            @endif
                        </h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-warning">Xem tất cả</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="small">Mã vận đơn</th>
                                <th class="small">Người nhận</th>
                                <th class="small">Thời gian</th>
                                <th class="small">Thao tác</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($pendingList as $order)
                                <tr>
                                    <td class="text-primary fw-bold small">{{ $order->tracking_id }}</td>
                                    <td class="small">{{ $order->receiver_name }}</td>
                                    <td class="small text-muted">{{ $order->created_at->format('d/m H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-xs btn-warning" style="font-size:0.7rem;padding:2px 8px;">
                                            Gán ngay
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4 small">
                                        <i class="ri-checkbox-circle-line text-success ri-24px d-block mb-1"></i>
                                        Không có đơn nào đang chờ gán!
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- ===== BẢNG ĐƠN GẦN ĐÂY ===== --}}
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">Đơn hàng gần đây</h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="small">Mã vận đơn</th>
                                <th class="small">Agent</th>
                                <th class="small">Trạng thái</th>
                                <th class="small">Thời gian</th>
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
                                        @switch(strtolower($order->status))
                                            @case('pending')
                                                <span class="badge bg-label-warning" style="font-size:0.7rem">Chờ gán</span>
                                                @break
                                            @case('assigned')
                                                <span class="badge bg-label-info" style="font-size:0.7rem">Đã gán</span>
                                                @break
                                            @case('in_transit')
                                                <span class="badge bg-label-primary" style="font-size:0.7rem">Đang giao</span>
                                                @break
                                            @case('delivered')
                                                <span class="badge bg-label-success" style="font-size:0.7rem">Hoàn thành</span>
                                                @break
                                            @case('canceled')
                                            @case('cancelled')
                                                <span class="badge bg-label-danger" style="font-size:0.7rem">Đã hủy</span>
                                                @break
                                            @default
                                                <span class="badge bg-label-secondary" style="font-size:0.7rem">{{ $order->status }}</span>
                                        @endswitch
                                    </td>
                                    <td class="small text-muted">{{ $order->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4 small">Chưa có vận đơn nào</td>
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
        // ─── Dữ liệu từ PHP ───────────────────────────────────────────────
        const dailyData   = @json($dailyStats);
        const monthlyData = @json($monthlyStats);
        const revenueData = @json($revenueByMonth);

        const MONTHS_VI = ['T1','T2','T3','T4','T5','T6','T7','T8','T9','T10','T11','T12'];

        // ─── HELPER: Build 12-month label array ───────────────────────────
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

        // ─── Chart 1: Daily (7 ngày) ──────────────────────────────────────
        (function() {
            const days = [], totals = [], deliveredArr = [];
            for (let i = 6; i >= 0; i--) {
                const d = new Date();
                d.setDate(d.getDate() - i);
                const dateStr = d.toISOString().split('T')[0];
                days.push(d.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' }));
                const found = dailyData.find(r => r.date === dateStr);
                totals.push(found ? found.total : 0);
                deliveredArr.push(found ? found.delivered : 0);
            }
            new Chart(document.getElementById('dailyChart'), {
                type: 'bar',
                data: {
                    labels: days,
                    datasets: [
                        { label: 'Tổng đơn', data: totals,
                            backgroundColor: 'rgba(105,108,255,0.15)', borderColor: 'rgba(105,108,255,0.8)',
                            borderWidth: 2, borderRadius: 6, borderSkipped: false },
                        { label: 'Hoàn thành', data: deliveredArr,
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

        // ─── Chart 2: Monthly orders (12 tháng) ──────────────────────────
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
                        { label: 'Tổng đơn', data: totals,
                            borderColor: 'rgba(105,108,255,0.9)', backgroundColor: 'rgba(105,108,255,0.08)',
                            borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 6, fill: true, tension: 0.4 },
                        { label: 'Hoàn thành', data: deliveredArr,
                            borderColor: 'rgba(40,199,111,0.9)', backgroundColor: 'rgba(40,199,111,0.08)',
                            borderWidth: 2.5, pointRadius: 4, pointHoverRadius: 6, fill: true, tension: 0.4 },
                        { label: 'Đã hủy', data: cancelledArr,
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

        // ─── Chart 3: Revenue by month ────────────────────────────────────
        (function() {
            const months = buildMonthLabels();
            const revenues = [];
            months.forEach(m => {
                const found = revenueData.find(r => r.year == m.year && r.month == m.month);
                revenues.push(found ? Math.round(found.revenue / 1000) : 0); // đơn vị K
            });
            new Chart(document.getElementById('revenueChart'), {
                type: 'bar',
                data: {
                    labels: months.map(m => m.label),
                    datasets: [{
                        label: 'Doanh thu (nghìn đồng)',
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
                                label: ctx => ' ' + ctx.parsed.y.toLocaleString('vi-VN') + 'K đ'
                            }
                        }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' },
                            ticks: { callback: v => v.toLocaleString('vi-VN') + 'K' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        })();
    </script>
@endsection
