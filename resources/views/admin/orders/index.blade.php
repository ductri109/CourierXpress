@extends('admin.layout')

@section('title', 'CourierXpress - Order Management')

@section('content')

    {{-- Handle pagination directly in View (No controller changes needed) --}}
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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Management /</span> Shipment List</h4>

        <div class="card mb-4">
            <h5 class="card-header">Advanced Filters</h5>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.orders.index') }}">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <input type="text" name="tracking_id" class="form-control"
                                   placeholder="Tracking ID"
                                   value="{{ request('tracking_id') }}">
                        </div>

                        <div class="col-md-4">
                            <input type="text" name="receiver_name" class="form-control"
                                   placeholder="Receiver Name"
                                   value="{{ request('receiver_name') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="status" class="form-control">
                                <option value="">All Statuses</option>
                                <option value="pending"    {{ strtolower(request('status')) == 'pending'    ? 'selected' : '' }}>Pending</option>
                                <option value="assigned"   {{ strtolower(request('status')) == 'assigned'   ? 'selected' : '' }}>Assigned</option>
                                <option value="picked_up"  {{ strtolower(request('status')) == 'picked_up'  ? 'selected' : '' }}>Picked Up</option>
                                <option value="in_transit" {{ strtolower(request('status')) == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                                <option value="delivered"  {{ strtolower(request('status')) == 'delivered'  ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled"  {{ in_array(strtolower(request('status')), ['canceled', 'cancelled']) ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-muted small mb-1">From Date</label>
                            <input type="date" name="date_from" class="form-control"
                                   value="{{ request('date_from') }}">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label text-muted small mb-1">To Date</label>
                            <input type="date" name="date_to" class="form-control"
                                   value="{{ request('date_to') }}">
                        </div>

                        <div class="col-md-4 d-flex align-items-end gap-2">
                            <button class="btn btn-primary"><i class="ri-search-line me-1"></i>Search</button>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Reset</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        @if(request()->hasAny(['status','tracking_id','receiver_name','date_from','date_to']))
            <div class="alert alert-info alert-dismissible mb-3 py-2" role="alert">
                <i class="ri-filter-line me-1"></i>
                Filtering &mdash;
                @if(request('status'))
                    Status: <strong>{{ ['pending'=>'Pending','assigned'=>'Assigned','picked_up'=>'Picked Up','in_transit'=>'In Transit','delivered'=>'Delivered','canceled'=>'Cancelled','cancelled'=>'Cancelled'][strtolower(request('status'))] ?? request('status') }}</strong>
                @endif
                @if(request('date_from') || request('date_to'))
                    &nbsp;Time: <strong>{{ request('date_from') ?: '...' }}</strong> → <strong>{{ request('date_to') ?: '...' }}</strong>
                @endif
                &nbsp;— Results: <strong>{{ method_exists($orders, 'total') ? $orders->total() : (isset($orders) ? $orders->count() : 0) }}</strong> shipments
                <button type="button" class="btn-close py-2" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Code</th>
                        <th>Customer</th>
                        <th>Receiver</th>
                        <th>Address</th>
                        <th class="text-center">Weight</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Created At</th>
                        <th class="text-end">Actions</th>
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

                            <td class="text-center">{{ $order->total_weight }} kg</td>

                            <td class="text-center">
                                @php
                                    $st = strtolower($order->status);
                                @endphp

                                @switch($st)
                                    @case('pending')
                                        <span class="badge bg-label-warning rounded-pill">Pending</span>
                                        @break

                                    @case('assigned')
                                        <span class="badge bg-label-primary rounded-pill">Assigned</span>
                                        @break

                                    @case('picked_up')
                                        <span class="badge bg-label-secondary rounded-pill">Picked Up</span>
                                        @break

                                    @case('in_transit')
                                        <span class="badge bg-label-info rounded-pill">In Transit</span>
                                        @break

                                    @case('delivered')
                                        <span class="badge bg-label-success rounded-pill">Delivered</span>
                                        @break

                                    @case('canceled')
                                    @case('cancelled')
                                        <span class="badge bg-label-danger rounded-pill">Cancelled</span>
                                        @break

                                    @default
                                        <span class="badge bg-label-secondary rounded-pill">{{ $order->status }}</span>
                                @endswitch
                            </td>

                            <td class="text-center">
                                <small class="text-muted">{{ $order->created_at->format('d/m/Y') }}</small><br>
                                <small class="text-muted opacity-75">{{ $order->created_at->format('H:i') }}</small>
                            </td>

                            <td class="text-end">
                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                   class="btn btn-sm btn-primary">
                                    View
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-5">
                                No data available
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if(isset($orders) && method_exists($orders, 'hasPages') && $orders->hasPages())
                <div class="card-footer border-top px-4 py-3">
                    {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

@endsection
