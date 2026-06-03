@extends('admin.layout')

@section('title', 'Customer Details — ' . $customer->full_name)

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('admin.customers.index') }}" class="text-muted">Customer Management</a> /
        </span>
            {{ $customer->full_name }}
        </h4>

        <div class="row g-4">

            {{-- ===== CUSTOMER INFO ===== --}}
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center pt-5">
                        <div class="avatar avatar-xl mb-3 mx-auto">
                            <div class="avatar-initial rounded-circle bg-label-primary" style="font-size:2rem; width:80px; height:80px; line-height:80px;">
                                {{ strtoupper(substr($customer->full_name, 0, 1)) }}
                            </div>
                        </div>
                        <h5 class="mb-0">{{ $customer->full_name }}</h5>
                        <p class="text-muted small mb-3">Customer ID #{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</p>

                        <span class="badge bg-label-success rounded-pill px-3 py-2">Active</span>
                    </div>
                    <div class="card-body border-top pt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-mail-line me-2 text-muted"></i>
                            <span class="small">{{ $customer->email }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-phone-line me-2 text-muted"></i>
                            <span class="small">{{ $customer->phone }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-map-pin-line me-2 text-muted"></i>
                            <span class="small">{{ $customer->address ?? 'Address not updated' }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="ri-calendar-line me-2 text-muted"></i>
                            <span class="small">Joined on {{ $customer->created_at ? $customer->created_at->format('d/m/Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Quick Statistics --}}
                <div class="card">
                    <div class="card-header"><h6 class="mb-0">Order Statistics</h6></div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                            <span class="small text-muted">Total Orders</span>
                            <span class="fw-bold">{{ $totalOrders ?? 0 }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                            <span class="small text-muted">Pending</span>
                            <span class="fw-bold text-warning">{{ $pendingOrders ?? 0 }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                            <span class="small text-muted">In Transit</span>
                            <span class="fw-bold text-primary">{{ $inTransitOrders ?? 0 }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between px-4 py-3">
                            <span class="small text-muted">Delivered</span>
                            <span class="fw-bold text-success">{{ $deliveredOrders ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== ORDERS TABLE ===== --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Customer Order History</h5>
                        <span class="badge bg-label-primary">{{ isset($orders) ? $orders->count() : 0 }} orders</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Tracking ID</th>
                                <th>Receiver</th>
                                <th class="text-center">Weight</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Created At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($orders) && $orders->count() > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary fw-bold text-decoration-none">
                                                {{ $order->tracking_id }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $order->receiver_name }}</div>
                                            <small class="text-muted">{{ \Str::limit($order->receiver_address, 30) }}</small>
                                        </td>
                                        <td class="text-center">{{ $order->total_weight }} kg</td>
                                        <td class="text-center">
                                            @switch(strtolower($order->status))
                                                @case('pending')
                                                    <span class="badge bg-label-warning rounded-pill">Pending</span>
                                                    @break
                                                @case('assigned')
                                                    <span class="badge bg-label-primary rounded-pill">Assigned</span>
                                                    @break
                                                @case('in_transit')
                                                    <span class="badge bg-label-info rounded-pill">In Transit</span>
                                                    @break
                                                @case('delivered')
                                                    <span class="badge bg-label-success rounded-pill">Delivered</span>
                                                    @break
                                                @case('cancelled')
                                                @case('canceled')
                                                    <span class="badge bg-label-danger rounded-pill">Cancelled</span>
                                                    @break
                                                @default
                                                    <span class="badge bg-label-secondary rounded-pill">{{ ucfirst($order->status) }}</span>
                                            @endswitch
                                        </td>
                                        <td class="text-center text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        This customer has no orders yet.
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">
                        <i class="ri-arrow-left-line me-1"></i> Back
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
