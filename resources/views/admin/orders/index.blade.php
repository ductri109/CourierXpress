@extends('admin.layout')

@section('title', 'CourierXpress - Quản lý đơn hàng')

@section('content')

    {{-- Xử lý phân trang trực tiếp trên View (Không cần sửa Controller) --}}
    @php
        use Illuminate\Pagination\LengthAwarePaginator;
        use Illuminate\Pagination\Paginator;

        if(isset($orders) && $orders->count() > 0) {
            $perPage = 10;
            $page = Paginator::resolveCurrentPage('page') ?: 1;
            $pageData = $orders->slice(($page - 1) * $perPage, $perPage)->all();

            $orders = new LengthAwarePaginator(
                $pageData,
                $orders->count(),
                $perPage,
                $page,
                [
                    'path' => Paginator::resolveCurrentPath(),
                    'query' => request()->query()
                ]
            );
        }
    @endphp

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Quản lý /</span> Danh sách vận đơn</h4>

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
                                <option value="pending"    {{ strtolower(request('status')) == 'pending'    ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="assigned"   {{ strtolower(request('status')) == 'assigned'   ? 'selected' : '' }}>Đã gán</option>
                                <option value="picked_up"  {{ strtolower(request('status')) == 'picked_up'  ? 'selected' : '' }}>Đã lấy hàng</option>
                                <option value="in_transit" {{ strtolower(request('status')) == 'in_transit' ? 'selected' : '' }}>Đang giao</option>
                                <option value="delivered"  {{ strtolower(request('status')) == 'delivered'  ? 'selected' : '' }}>Đã giao</option>
                                <option value="cancelled"  {{ in_array(strtolower(request('status')), ['canceled', 'cancelled']) ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-muted small mb-1">Từ ngày</label>
                            <input type="date" name="date_from" class="form-control"
                                   value="{{ request('date_from') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-muted small mb-1">Đến ngày</label>
                            <input type="date" name="date_to" class="form-control"
                                   value="{{ request('date_to') }}">
                        </div>

                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button class="btn btn-primary"><i class="ri-search-line me-1"></i>Tìm kiếm</button>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Reset</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        @if(request()->hasAny(['status','tracking_id','receiver_name','date_from','date_to']))
            <div class="alert alert-info alert-dismissible mb-3 py-2" role="alert">
                <i class="ri-filter-line me-1"></i>
                Đang lọc &mdash;
                @if(request('status'))
                    Trạng thái: <strong>{{ ['pending'=>'Chờ xử lý','assigned'=>'Đã gán','picked_up'=>'Đã lấy hàng','in_transit'=>'Đang giao','delivered'=>'Đã giao','canceled'=>'Đã hủy','cancelled'=>'Đã hủy'][strtolower(request('status'))] ?? request('status') }}</strong>
                @endif
                @if(request('date_from') || request('date_to'))
                    &nbsp;Thời gian: <strong>{{ request('date_from') ?: '...' }}</strong> → <strong>{{ request('date_to') ?: '...' }}</strong>
                @endif
                &nbsp;— Kết quả: <strong>{{ method_exists($orders, 'total') ? $orders->total() : (isset($orders) ? $orders->count() : 0) }}</strong> vận đơn
                <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
            </div>
        @endif

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
                        <th>Ngày tạo</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td class="text-primary fw-bold">{{ $order->tracking_id }}</td>

                            <td>
                                {{ optional($order->customer)->full_name ?? 'N/A' }}
                            </td>

                            <td>{{ $order->receiver_name }}</td>

                            <td>
                                {{ \Illuminate\Support\Str::limit($order->receiver_address, 30) }}
                            </td>

                            <td>{{ $order->total_weight }} kg</td>

                            <td>
                                @php
                                    $st = strtolower($order->status);
                                @endphp

                                @switch($st)
                                    @case('pending')
                                        <span class="badge bg-warning">Chờ xử lý</span>
                                        @break

                                    @case('assigned')
                                        <span class="badge bg-info">Đã gán</span>
                                        @break

                                    @case('picked_up')
                                        <span class="badge bg-dark">Đã lấy hàng</span>
                                        @break

                                    @case('in_transit')
                                        <span class="badge bg-primary">Đang giao</span>
                                        @break

                                    @case('delivered')
                                        <span class="badge bg-success">Đã giao</span>
                                        @break

                                    @case('canceled')
                                    @case('cancelled')
                                        <span class="badge bg-danger">Đã hủy</span>
                                        @break

                                    @default
                                        <span class="badge bg-secondary">{{ $order->status }}</span>
                                @endswitch
                            </td>

                            <td>
                                <small class="text-muted">{{ $order->created_at->format('d/m/Y') }}</small><br>
                                <small class="text-muted opacity-75">{{ $order->created_at->format('H:i') }}</small>
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
                            <td colspan="8" class="text-center text-muted py-5">
                                Không có dữ liệu
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Thanh Phân Trang --}}
            @if(isset($orders) && method_exists($orders, 'hasPages') && $orders->hasPages())
                <div class="card-footer border-top px-4 py-3">
                    {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

@endsection
