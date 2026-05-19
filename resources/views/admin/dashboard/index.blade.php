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

            {{-- Đơn chờ gán --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 gap-3">
                            <div class="avatar">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="ri-time-line ri-24px"></i>
                            </span>
                            </div>
                            <h4 class="mb-0">{{ $pendingOrders }}</h4>
                        </div>
                        <h6 class="mb-1 fw-normal">Đơn chờ gán agent</h6>
                        <p class="mb-0 small text-muted">Cần phân công ngay</p>
                    </div>
                </div>
            </div>

            {{-- Agent sẵn sàng --}}
            <div class="col-sm-6 col-lg-3">
                <div class="card card-border-shadow-success h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 gap-3">
                            <div class="avatar">
                            <span class="avatar-initial rounded bg-label-success">
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

        {{-- ==================== MAIN CONTENT ROW ==================== --}}
        <div class="row g-4">

            {{-- ===== CHART: Đơn hàng 7 ngày ===== --}}
            <div class="col-xxl-8">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">Thống kê vận đơn (7 ngày gần nhất)</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="dailyChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            {{-- ===== AGENT RẢNH ===== --}}
            <div class="col-xxl-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0">Agent đang rảnh</h5>
                        <span class="badge bg-label-success">{{ $activeAgents }} người</span>
                    </div>
                    <div class="card-body p-0">
                        @forelse($availableAgents as $agent)
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
                                <span class="badge bg-label-info small">{{ $agent->total_orders }} đơn tổng</span>
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

        </div>

        <div class="row g-4 mt-1">

            {{-- ===== BẢNG ĐƠN CHỜ GÁN ===== --}}
            <div class="col-lg-6">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="m-0 text-warning">
                            <i class="ri-alert-line me-1"></i>
                            Đơn chờ gán
                            @if($pendingOrders > 0)
                                <span class="badge bg-warning ms-1">{{ $pendingOrders }}</span>
                            @endif
                        </h5>
                        <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning">Xem tất cả</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th class="small">Mã vận đơn</th>
                                <th class="small">Người nhận</th>
                                <th class="small">Ngày tạo</th>
                                <th class="small"></th>
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
            <div class="col-lg-6">
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
                                        @switch($order->status)
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
        const dailyData = @json($dailyStats);

        // Tạo labels cho 7 ngày (kể cả ngày chưa có dữ liệu)
        const days = [];
        const totals = [];
        const deliveredArr = [];

        for (let i = 6; i >= 0; i--) {
            const d = new Date();
            d.setDate(d.getDate() - i);
            const dateStr = d.toISOString().split('T')[0];
            const label = d.toLocaleDateString('vi-VN', { day: '2-digit', month: '2-digit' });
            days.push(label);

            const found = dailyData.find(r => r.date === dateStr);
            totals.push(found ? found.total : 0);
            deliveredArr.push(found ? found.delivered : 0);
        }

        const ctx = document.getElementById('dailyChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: days,
                datasets: [
                    {
                        label: 'Tổng đơn',
                        data: totals,
                        backgroundColor: 'rgba(105, 108, 255, 0.15)',
                        borderColor: 'rgba(105, 108, 255, 0.8)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    },
                    {
                        label: 'Hoàn thành',
                        data: deliveredArr,
                        backgroundColor: 'rgba(40, 199, 111, 0.8)',
                        borderColor: 'rgba(40, 199, 111, 1)',
                        borderWidth: 2,
                        borderRadius: 6,
                        borderSkipped: false,
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: 'rgba(0,0,0,0.05)' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    </script>
@endsection
