@extends('admin.layout')

@section('title', 'Chi tiết đơn hàng #' . $order->tracking_id . ' | CourierXpress')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Quản lý đơn hàng /</span>
            Chi tiết #{{ $order->tracking_id }}
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

            {{-- ===== THÔNG TIN VẬN ĐƠN ===== --}}
            <div class="col-md-8">
                <div class="card mb-4">
                    <h5 class="card-header">Thông tin vận đơn</h5>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">MÃ VẬN ĐƠN</label>
                                <p class="fw-bold text-primary mb-0">{{ $order->tracking_id }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">TRẠNG THÁI</label>
                                <div>
                                    @switch(strtolower($order->status))
                                        @case('pending')
                                            <span class="badge bg-label-warning rounded-pill">Chờ gán agent</span>
                                            @break
                                        @case('assigned')
                                            <span class="badge bg-label-primary rounded-pill">Đã gán agent</span>
                                            @break
                                        @case('in_transit')
                                            <span class="badge bg-label-info rounded-pill">Đang giao hàng</span>
                                            @break
                                        @case('delivered')
                                            <span class="badge bg-label-success rounded-pill">Đã giao thành công</span>
                                            @break
                                        @case('cancelled')
                                        @case('canceled')
                                            <span class="badge bg-label-danger rounded-pill">Đã hủy</span>
                                            @break
                                        @default
                                            <span class="badge bg-label-secondary rounded-pill">{{ ucfirst($order->status) }}</span>
                                    @endswitch
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">NGƯỜI GỬI</label>
                                <p class="fw-semibold mb-0">{{ $order->sender_name }}</p>
                                <p class="text-muted small mb-0">{{ $order->sender_address }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="bx bx-phone"></i>
                                    {{ $order->sender_phone }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">NGƯỜI NHẬN</label>
                                <p class="fw-semibold mb-0">{{ $order->receiver_name }}</p>
                                <p class="text-muted small mb-0">{{ $order->receiver_address }}</p>
                                <p class="text-sm text-gray-500 mt-1">
                                    <i class="bx bx-phone"></i>
                                    {{ $order->receiver_phone }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">KHỐI LƯỢNG</label>
                                <p class="fw-semibold mb-0">{{ $order->total_weight }} kg</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">KHÁCH HÀNG</label>
                                <p class="fw-semibold mb-0">{{ optional($order->customer)->full_name ?? 'N/A' }}</p>
                                <p class="text-muted small mb-0">{{ optional($order->customer)->email }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">NGÀY TẠO</label>
                                <p class="fw-semibold mb-0">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label text-muted small fw-semibold">CẬP NHẬT LẦN CUỐI</label>
                                <p class="fw-semibold mb-0">{{ $order->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Agent hiện tại (nếu đã gán) --}}
                @if($order->agent)
                    <div class="card">
                        <h5 class="card-header text-success">
                            <i class="ri-user-follow-line me-1"></i>Agent đang phụ trách
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
                                        <span class="badge bg-label-success rounded-pill">Đang rảnh</span>
                                    @elseif($agentStatus === 'busy')
                                        <span class="badge bg-label-warning rounded-pill">Đang bận</span>
                                    @elseif($agentStatus === 'inactive')
                                        <span class="badge bg-label-danger rounded-pill">Ngưng hoạt động</span>
                                    @else
                                        <span class="badge bg-label-secondary rounded-pill">{{ ucfirst($order->agent->Status) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- ===== FORM GÁN AGENT ===== --}}
            <div class="col-md-4">
                <div class="card">
                    <h5 class="card-header text-primary">
                        <i class="ri-user-add-line me-1"></i>
                        Gán Nhân Viên (Agent)
                    </h5>
                    <div class="card-body">

                        @if($order->status === 'pending')
                            {{-- Hiển thị form gán nếu đơn đang pending --}}
                            @if($freeAgents->isEmpty())
                                <div class="alert alert-warning">
                                    <i class="ri-alert-line me-1"></i>
                                    Hiện tại không có agent nào đang rảnh. Vui lòng thử lại sau.
                                </div>
                            @else
                                <form action="{{ route('admin.orders.assign', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Chọn Agent đang rảnh</label>
                                        <select name="agent_id" class="form-select @error('agent_id') is-invalid @enderror" required>
                                            <option value="">-- Chọn agent --</option>
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
                                        Sau khi gán, trạng thái đơn hàng sẽ chuyển sang <strong>Đã gán</strong> và agent sẽ nhận được thông báo để xử lý.
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="ri-send-plane-line me-1"></i> XÁC NHẬN GÁN ĐƠN
                                    </button>
                                </form>
                            @endif

                        @elseif($order->status === 'assigned')
                            <div class="alert alert-info mb-0">
                                <i class="ri-user-follow-line me-1"></i>
                                Đơn hàng đã được gán cho agent <strong>{{ optional($order->agent)->FullName }}</strong>. Đang chờ agent nhận xử lý.
                            </div>

                        @elseif($order->status === 'in_transit')
                            <div class="alert alert-primary mb-0">
                                <i class="ri-truck-line me-1"></i>
                                Agent <strong>{{ optional($order->agent)->FullName }}</strong> đang trên đường giao hàng.
                            </div>

                        @elseif($order->status === 'delivered')
                            <div class="alert alert-success mb-0">
                                <i class="ri-checkbox-circle-line me-1"></i>
                                Đơn hàng đã được giao thành công bởi agent <strong>{{ optional($order->agent)->FullName }}</strong>.
                            </div>

                        @endif

                    </div>
                </div>

                {{-- Nút quay lại --}}
                <div class="mt-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100">
                        <i class="ri-arrow-left-line me-1"></i> Quay lại danh sách
                    </a>
                </div>
            </div>

        </div>
    </div>
@endsection
