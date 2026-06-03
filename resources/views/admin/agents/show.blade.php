@extends('admin.layout')

@section('title', 'Agent Details — {{ $agent->FullName }}')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">
            <a href="{{ route('admin.agents.index') }}" class="text-muted">Agent Management</a> /
        </span>
            {{ $agent->FullName }}
        </h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible mb-4" role="alert">
                <i class="ri-check-double-line me-1"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- ===== AGENT INFO ===== --}}
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body text-center pt-5">
                        <div class="avatar avatar-xl mb-3 mx-auto">
                            <div class="avatar-initial rounded-circle bg-label-primary" style="font-size:2rem; width:80px; height:80px; line-height:80px;">
                                {{ strtoupper(substr($agent->FullName, 0, 1)) }}
                            </div>
                        </div>
                        <h5 class="mb-0">{{ $agent->FullName }}</h5>
                        <p class="text-muted small mb-3">Agent ID #{{ str_pad($agent->ID, 4, '0', STR_PAD_LEFT) }}</p>

                        @php $st = strtolower($agent->Status); @endphp
                        @if($st === 'active')
                            <span class="badge bg-label-success rounded-pill px-3 py-2">Available</span>
                        @elseif($st === 'busy')
                            <span class="badge bg-label-warning rounded-pill px-3 py-2">Busy</span>
                        @elseif($st === 'inactive')
                            <span class="badge bg-label-danger rounded-pill px-3 py-2">Inactive</span>
                        @else
                            <span class="badge bg-label-secondary rounded-pill px-3 py-2">{{ $agent->Status }}</span>
                        @endif
                    </div>
                    <div class="card-body border-top pt-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-mail-line me-2 text-muted"></i>
                            <span class="small">{{ $agent->Email }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-phone-line me-2 text-muted"></i>
                            <span class="small">{{ $agent->Phone }}</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-user-line me-2 text-muted"></i>
                            <span class="small">{{ '@' . $agent->Username }}</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="ri-calendar-line me-2 text-muted"></i>
                            <span class="small">Joined on {{ $agent->created_at->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Quick Statistics --}}
                <div class="card">
                    <div class="card-header"><h6 class="mb-0">Order Statistics</h6></div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                            <span class="small text-muted">Total Orders</span>
                            <span class="fw-bold">{{ $totalOrders }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                            <span class="small text-muted">Pending</span>
                            <span class="fw-bold text-warning">{{ $assignedOrders }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between px-4 py-3 border-bottom">
                            <span class="small text-muted">In Transit</span>
                            <span class="fw-bold text-primary">{{ $inTransitOrders }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between px-4 py-3">
                            <span class="small text-muted">Delivered</span>
                            <span class="fw-bold text-success">{{ $deliveredOrders }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===== ORDERS TABLE ===== --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Agent's Orders</h5>
                        <span class="badge bg-label-primary">{{ $orders->count() }} orders</span>
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
                            @forelse($orders as $order)
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
                                        @switch($order->status)
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
                                                <span class="badge bg-label-danger rounded-pill">Cancelled</span>
                                                @break
                                            @default
                                                <span class="badge bg-label-secondary rounded-pill">{{ ucfirst($order->status) }}</span>
                                        @endswitch
                                    </td>
                                    <td class="text-center text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-5">
                                        This agent has no orders assigned.
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">
                        <i class="ri-arrow-left-line me-1"></i> Back
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
