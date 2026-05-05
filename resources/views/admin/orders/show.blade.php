@extends('admin.layout')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Đơn hàng /</span> Chi tiết #{{ $order->tracking_id }}</h4>

    <div class="row">
        <!-- Thông tin đơn hàng -->
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Thông tin vận đơn</h5>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mb-3">
                            <h6>Người gửi:</h6>
                            <p>{{ $order->customer->user_name }} ({{ $order->sender_name }})</p>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <h6>Người nhận:</h6>
                            <p>{{ $order->receiver_name }}</p>
                        </div>
                        <div class="col-12">
                            <h6>Địa chỉ giao hàng:</h6>
                            <p>{{ $order->receiver_address }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 7, 8, 9. Form Gán Agent -->
        <div class="col-md-4">
            <div class="card">
                <h5 class="card-header text-primary"><i class="ri-user-add-line"></i> Gán Nhân Viên (Agent)</h5>
                <div class="card-body">
                    @if($order->status == 'pending')
                        <form action="{{ route('admin.orders.assign', $order->id) }}" method="POST">
                            @csrf
                            <div class="form-floating form-floating-outline mb-4">
                                <select name="agent_id" class="form-select" required>
                                    <option value="">-- Chọn Agent đang rảnh --</option>
                                    @foreach($freeAgents as $agent)
                                        <option value="{{ $agent->id }}">{{ $agent->full_name }} (ID: {{ $agent->id }})</option>
                                    @endforeach
                                </select>
                                <label>Danh sách Agent</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">XÁC NHẬN GÁN ĐƠN</button>
                        </form>
                    @else
                        <div class="alert alert-info">Đơn hàng này đã được gán hoặc đang xử lý.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection