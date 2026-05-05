@extends('admin.layout')

@section('title', 'CourierXpress - Quản lý đơn hàng')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lý /</span> Danh sách vận đơn</h4>

    <!-- Search -->
    <div class="card mb-4">
        <h5 class="card-header">Bộ lọc nâng cao</h5>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.orders.index') }}">
                <div class="row g-3">
                    
                    <div class="col-md-4">
                        <input type="text" name="tracking_id" class="form-control"
                               placeholder="Mã vận đơn"
                               value="{{ request('tracking_id') }}">
                    </div>

                    <div class="col-md-4">
                        <input type="text" name="receiver_name" class="form-control"
                               placeholder="Người nhận"
                               value="{{ request('receiver_name') }}">
                    </div>

                    <div class="col-md-4">
                        <select name="status" class="form-control">
                            <option value="">Tất cả trạng thái</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Đang chờ</option>
                            <option value="assigned" {{ request('status') == 'assigned' ? 'selected' : '' }}>Đã gán</option>
                            <option value="in_transit" {{ request('status') == 'in_transit' ? 'selected' : '' }}>Đang giao</option>
                            <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary">Tìm kiếm</button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Reset</a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Mã</th>
                        <th>Khách hàng</th>
                        <th>Người nhận</th>
                        <th>Địa chỉ</th>
                        <th>Khối lượng</th>
                        <th>Trạng thái</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="text-primary fw-bold">{{ $order->tracking_id }}</td>

                        <td>
                            {{ optional($order->customer)->user_name ?? 'N/A' }}
                        </td>

                        <td>{{ $order->receiver_name }}</td>

                        <td>
                            {{ \Illuminate\Support\Str::limit($order->receiver_address, 30) }}
                        </td>

                        <td>{{ $order->total_weight }} kg</td>

                        <td>
                            @switch($order->status)

                                @case('pending')
                                    <span class="badge bg-warning">Đang chờ</span>
                                    @break

                                @case('assigned')
                                    <span class="badge bg-info">Đã gán</span>
                                    @break

                                @case('in_transit')
                                    <span class="badge bg-primary">Đang giao</span>
                                    @break

                                @case('delivered')
                                    <span class="badge bg-success">Đã giao</span>
                                    @break

                                @default
                                    <span class="badge bg-secondary">Không xác định</span>

                            @endswitch
                        </td>

                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}"
                               class="btn btn-sm btn-primary">
                                Xem
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Không có dữ liệu
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection