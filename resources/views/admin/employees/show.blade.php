@extends('admin.layout')

@section('content')
@php
    $employee = $employee ?? [
        'id' => 1,
        'name' => 'Nguyễn Văn An',
        'email' => 'an.nguyen@courierxpress.vn',
        'phone' => '0981 234 567',
        'role' => 'Quản trị viên',
        'department' => 'Vận hành',
        'status' => 'active',
        'avatar' => '1.png',
        'joined_at' => '12/03/2025',
    ];

    $statusConfig = [
        'active' => ['text' => 'Đang làm', 'class' => 'bg-label-success'],
        'pending' => ['text' => 'Chờ duyệt', 'class' => 'bg-label-warning'],
        'inactive' => ['text' => 'Tạm nghỉ', 'class' => 'bg-label-secondary'],
    ];

    $status = $statusConfig[$employee['status']] ?? ['text' => 'Không rõ', 'class' => 'bg-label-secondary'];
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h4 class="mb-1">Chi tiết nhân viên #{{ str_pad($employee['id'], 4, '0', STR_PAD_LEFT) }}</h4>
            <p class="mb-0 text-muted">Thông tin hồ sơ và hoạt động của nhân viên.</p>
        </div>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary">
            <i class="ri-arrow-left-line me-1"></i> Quay lại
        </a>
    </div>

    <div class="row g-6">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <div class="card mb-6">
                <div class="card-body">
                    <div class="user-avatar-section">
                        <div class="d-flex align-items-center flex-column">
                            <img class="img-fluid rounded mb-4" src="{{ asset('assets/img/avatars/' . $employee['avatar']) }}" height="120" width="120" alt="Avatar">
                            <div class="user-info text-center">
                                <h5 class="mb-1">{{ $employee['name'] }}</h5>
                                <span class="badge {{ $status['class'] }} rounded-pill">{{ $status['text'] }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-around flex-wrap my-6 gap-0 gap-md-3 gap-lg-4">
                        <div class="d-flex align-items-center me-5 gap-4">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-primary rounded">
                                    <i class="ri-truck-line ri-24px"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">184</h5>
                                <span>Đơn xử lý</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded">
                                    <i class="ri-checkbox-circle-line ri-24px"></i>
                                </div>
                            </div>
                            <div>
                                <h5 class="mb-0">98%</h5>
                                <span>Hiệu suất</span>
                            </div>
                        </div>
                    </div>

                    <h5 class="pb-4 border-bottom mb-4">Thông tin chi tiết</h5>
                    <div class="info-container">
                        <ul class="list-unstyled mb-6">
                            <li class="mb-2"><span class="h6">Mã nhân viên:</span> <span>#{{ str_pad($employee['id'], 4, '0', STR_PAD_LEFT) }}</span></li>
                            <li class="mb-2"><span class="h6">Email:</span> <span>{{ $employee['email'] }}</span></li>
                            <li class="mb-2"><span class="h6">Số điện thoại:</span> <span>{{ $employee['phone'] }}</span></li>
                            <li class="mb-2"><span class="h6">Vai trò:</span> <span>{{ $employee['role'] }}</span></li>
                            <li class="mb-2"><span class="h6">Phòng ban:</span> <span>{{ $employee['department'] }}</span></li>
                            <li class="mb-2"><span class="h6">Ngày vào làm:</span> <span>{{ $employee['joined_at'] }}</span></li>
                        </ul>
                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#editEmployeeModal">
                            <i class="ri-pencil-line me-1"></i> Cập nhật
                        </button>
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary">Danh sách</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8 col-lg-7 col-md-7">
            <div class="card mb-6">
                <div class="card-header">
                    <h5 class="card-title mb-0">Hoạt động gần đây</h5>
                </div>
                <div class="card-body">
                    <ul class="timeline mb-0">
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-primary"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">Cập nhật trạng thái vận đơn</h6>
                                    <small class="text-muted">12 phút trước</small>
                                </div>
                                <p class="mb-2">Nhân viên đã cập nhật trạng thái đơn hàng sang “Đang giao”.</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent">
                            <span class="timeline-point timeline-point-success"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">Hoàn thành phiên giao hàng</h6>
                                    <small class="text-muted">45 phút trước</small>
                                </div>
                                <p class="mb-2">Đã hoàn tất 8/8 đơn trong tuyến được phân công.</p>
                            </div>
                        </li>
                        <li class="timeline-item timeline-item-transparent border-transparent">
                            <span class="timeline-point timeline-point-info"></span>
                            <div class="timeline-event">
                                <div class="timeline-header mb-3">
                                    <h6 class="mb-0">Nhận phân công mới</h6>
                                    <small class="text-muted">2 giờ trước</small>
                                </div>
                                <p class="mb-0">Hệ thống đã phân công tuyến giao hàng mới cho nhân viên.</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">KPI tháng này</h5>
                    <span class="badge bg-label-primary">Demo</span>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Đơn hoàn thành</span>
                            <span>86%</span>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div class="progress-bar" role="progressbar" style="width: 86%" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Đúng giờ</span>
                            <span>92%</span>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Khiếu nại xử lý</span>
                            <span>74%</span>
                        </div>
                        <div class="progress" style="height: 8px">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 74%" aria-valuenow="74" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.employees.update', $employee['id']) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Cập nhật nhân viên</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" name="name" class="form-control" value="{{ $employee['name'] }}" placeholder="Họ tên">
                            <label>Họ tên</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="email" name="email" class="form-control" value="{{ $employee['email'] }}" placeholder="Email">
                            <label>Email</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" name="phone" class="form-control" value="{{ $employee['phone'] }}" placeholder="Số điện thoại">
                            <label>Số điện thoại</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select name="role" class="form-select">
                                <option {{ $employee['role'] === 'Quản trị viên' ? 'selected' : '' }}>Quản trị viên</option>
                                <option {{ $employee['role'] === 'Điều phối viên' ? 'selected' : '' }}>Điều phối viên</option>
                                <option {{ $employee['role'] === 'Nhân viên kho' ? 'selected' : '' }}>Nhân viên kho</option>
                                <option {{ $employee['role'] === 'Nhân viên giao hàng' ? 'selected' : '' }}>Nhân viên giao hàng</option>
                            </select>
                            <label>Vai trò</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
