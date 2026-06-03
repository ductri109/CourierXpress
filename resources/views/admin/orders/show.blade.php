@extends('admin.layout')

@section('title', 'Order Details #' . $order->tracking_id . ' | CourierXpress')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Order Management /</span>
            Details #{{ $order->tracking_id }}
        </h4>

        {{-- Alert messages --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible mb-4" role="alert">
                <i class="ri-check-double-line me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                <i class="ri-alert-line me-1"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- ===== SHIPMENT INFORMATION ===== --}}
            <div class="col-md-8">
                <div class="card mb-4">
                    <h5 class="card-header">Shipment Information</h5>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">TRACKING ID</label>
                                <p class="fw-bold text-primary mb-0">{{ $order->tracking_id }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">STATUS</label>
                                <div>
                                    @switch(strtolower($order->status))
                                        @case('pending')
                                            <span class="badge bg-label-warning rounded-pill">Pending Assignment</span>
                                            @break
                                        @case('assigned')
                                            <span class="badge bg-label-primary rounded-pill">Assigned to Agent</span>
                                            @break
                                        @case('in_transit')
                                            <span class="badge bg-label-info rounded-pill">In Transit</span>
                                            @break
                                        @case('delivered')
                                            <span class="badge bg-label-success rounded-pill">Delivered Successfully</span>
                                            @break
                                        @case('cancelled')
                                        @case('canceled')
                                            <span class="badge bg-label-danger rounded-pill">Cancelled</span>
                                            @break
                                        @default
                                            <span class="badge bg-label-secondary rounded-pill">{{ ucfirst($order->status) }}</span>
                                    @endswitch
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">SENDER</label>
                                <p class="fw-semibold mb-0">{{ $order->sender_name }}</p>
                                <p class="text-muted small mb-0">{{ $order->sender_address }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="bx bx-phone"></i>
                                    {{ $order->sender_phone }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">RECEIVER</label>
                                <p class="fw-semibold mb-0">{{ $order->receiver_name }}</p>
                                <p class="text-muted small mb-0">{{ $order->receiver_address }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="bx bx-phone"></i>
                                    {{ $order->receiver_phone }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">WEIGHT</label>
                                <p class="fw-semibold mb-0">{{ $order->total_weight }} kg</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">CUSTOMER</label>
                                <p class="fw-semibold mb-0">{{ optional($order->customer)->full_name ?? 'N/A' }}</p>
                                <p class="text-muted small mb-0">{{ optional($order->customer)->email }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">CREATED AT</label>
                                <p class="fw-semibold mb-0">{{ $order->created_at->format('M d, Y H:i') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">LAST UPDATED</label>
                                <p class="fw-semibold mb-0">{{ $order->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Current Agent (if assigned) --}}
                @if($order->agent)
                    <div class="card">
                        <h5 class="card-header text-success">
                            <i class="ri-user-follow-line me-1"></i>Assigned Agent
                        </h5>
                        <div class="card-body">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar avatar-lg">
                                    <span class="avatar-initial rounded-circle bg-label-success fs-4">
                                        {{ strtoupper(substr($order->agent->FullName, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">{{ $order->agent->FullName }}</h6>
                                    <p class="mb-0 text-muted small">{{ $order->agent->Email }}</p>
                                    <p class="mb-0 text-muted small"><i class="ri-phone-line me-1"></i>{{ $order->agent->Phone }}</p>
                                </div>
                                <div class="ms-auto">
                                    @php $agentStatus = strtolower($order->agent->Status); @endphp
                                    @if($agentStatus === 'active')
                                        <span class="badge bg-label-success rounded-pill">Available</span>
                                    @elseif($agentStatus === 'busy')
                                        <span class="badge bg-label-warning rounded-pill">Busy</span>
                                    @elseif($agentStatus === 'inactive')
                                        <span class="badge bg-label-danger rounded-pill">Inactive</span>
                                    @else
                                        <span class="badge bg-label-secondary rounded-pill">{{ ucfirst($order->agent->Status) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ===== AGENT ASSIGNMENT FORM ===== --}}
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header text-primary">
                        <i class="ri-user-add-line me-1"></i>
                        Assign Agent
                    </h5>
                    <div class="card-body">

                        @if($order->status === 'pending')
                            {{-- Show form if order is pending --}}
                            @if($freeAgents->isEmpty())
                                <div class="alert alert-warning">
                                    <i class="ri-alert-line me-1"></i>
                                    No available agents at the moment. Please try again later.
                                </div>
                            @else
                                <form action="{{ route('admin.orders.assign', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Select an available agent</label>
                                        <select name="agent_id" class="form-select @error('agent_id') is-invalid @enderror" required>
                                            <option value="">-- Choose agent --</option>
                                            @foreach($freeAgents as $agent)
                                                <option value="{{ $agent->ID }}"
                                                    {{ old('agent_id') == $agent->ID ? 'selected' : '' }}>
                                                    {{ $agent->FullName }} — {{ $agent->Phone }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('agent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3 p-3 bg-light rounded small text-muted">
                                        <i class="ri-information-line me-1"></i>
                                        After assignment, the order status will update to <strong>Assigned</strong> and the agent will receive a notification.
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ri-send-plane-line me-1"></i> CONFIRM ASSIGNMENT
                                    </button>
                                </form>
                            @endif

                        @elseif($order->status === 'assigned')
                            <div class="alert alert-info mb-0">
                                <i class="ri-user-follow-line me-1"></i>
                                This order is assigned to <strong>{{ optional($order->agent)->FullName }}</strong>. Waiting for agent processing.
                            </div>

                        @elseif($order->status === 'in_transit')
                            <div class="alert alert-primary mb-0">
                                <i class="ri-truck-line me-1"></i>
                                Agent <strong>{{ optional($order->agent)->FullName }}</strong> is currently in transit with this order.
                            </div>

                        @elseif($order->status === 'delivered')
                            <div class="alert alert-success mb-0">
                                <i class="ri-checkbox-circle-line me-1"></i>
                                Order has been delivered successfully by <strong>{{ optional($order->agent)->FullName }}</strong>.
                            </div>

                        @endif

                    </div>
                </div>

                {{-- Back button --}}
                <div class="mt-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="ri-arrow-left-line me-1"></i> Back to List
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
