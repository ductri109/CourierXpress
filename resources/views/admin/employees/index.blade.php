@extends('admin.layout')

@section('content')
@php
    $employees = collect($employees ?? [
        [
            'id' => 1,
            'name' => 'Nguyễn Văn An',
            'email' => 'an.nguyen@courierxpress.vn',
            'phone' => '0981 234 567',
            'role' => 'Quản trị viên',
            'department' => 'Vận hành',
            'status' => 'active',
            'avatar' => '1.png',
            'joined_at' => '12/03/2025',
        ],
        [
            'id' => 2,
            'name' => 'Trần Minh Đức',
            'email' => 'duc.tran@courierxpress.vn',
            'phone' => '0972 111 222',
            'role' => 'Nhân viên giao hàng',
            'department' => 'Last Mile',
            'status' => 'active',
            'avatar' => '2.png',
            'joined_at' => '22/04/2025',
        ],
        [
            'id' => 3,
            'name' => 'Lê Thị Mai',
            'email' => 'mai.le@courierxpress.vn',
            'phone' => '0963 555 888',
            'role' => 'Nhân viên kho',
            'department' => 'Warehouse',
            'status' => 'pending',
            'avatar' => '3.png',
            'joined_at' => '01/05/2025',
        ],
        [
            'id' => 4,
            'name' => 'Phạm Quốc Huy',
            'email' => 'huy.pham@courierxpress.vn',
            'phone' => '0912 789 456',
            'role' => 'Điều phối viên',
            'department' => 'Dispatching',
            'status' => 'inactive',
            'avatar' => '4.png',
            'joined_at' => '18/01/2025',
        ],
    ]);

    $totalEmployees = $employees->count();
    $activeEmployees = $employees->where('status', 'active')->count();
    $pendingEmployees = $employees->where('status', 'pending')->count();
    $deliveryEmployees = $employees->filter(fn ($employee) => str_contains(mb_strtolower($employee['role']), 'giao hàng'))->count();

    $statusConfig = [
        'active' => ['text' => 'Đang làm', 'class' => 'bg-label-success'],
        'pending' => ['text' => 'Chờ duyệt', 'class' => 'bg-label-warning'],
        'inactive' => ['text' => 'Tạm nghỉ', 'class' => 'bg-label-secondary'],
    ];
@endphp

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h4 class="mb-1">Quản lý nhân viên</h4>
            <p class="mb-0 text-muted">Theo dõi thông tin, vai trò và trạng thái làm việc của nhân viên CourierXpress.</p>
        </div>
        <button
            class="btn btn-primary"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasAddEmployee"
            aria-controls="offcanvasAddEmployee">
            <i class="ri-user-add-line me-1"></i>
            Thêm nhân viên
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-6 mb-6">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="me-1">
                            <p class="text-heading mb-1">Tổng nhân viên</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $totalEmployees }}</h4>
                                <p class="text-success mb-1">(+12%)</p>
                            </div>
                            <small class="mb-0">Toàn hệ thống</small>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="ri-group-line ri-26px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="me-1">
                            <p class="text-heading mb-1">Đang làm việc</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $activeEmployees }}</h4>
                                <p class="text-success mb-1">(+8%)</p>
                            </div>
                            <small class="mb-0">Nhân viên active</small>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-success rounded">
                                <i class="ri-user-follow-line ri-26px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="me-1">
                            <p class="text-heading mb-1">Nhân viên giao hàng</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $deliveryEmployees }}</h4>
                                <p class="text-success mb-1">(+5%)</p>
                            </div>
                            <small class="mb-0">Last Mile</small>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="ri-truck-line ri-26px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="me-1">
                            <p class="text-heading mb-1">Chờ duyệt</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $pendingEmployees }}</h4>
                                <p class="text-warning mb-1">Cần xử lý</p>
                            </div>
                            <small class="mb-0">Hồ sơ mới</small>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-warning rounded">
                                <i class="ri-user-search-line ri-26px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header border-bottom">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <h5 class="card-title mb-1">Danh sách nhân viên</h5>
                    <small class="text-muted">Dữ liệu đang để demo, muốn lưu thật thì nối thêm Model và bảng database.</small>
                </div>
                <form method="GET" action="{{ route('admin.employees.index') }}" class="d-flex gap-2">
                    <input type="text" name="keyword" class="form-control" placeholder="Tìm nhân viên..." value="{{ request('keyword') }}">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="ri-search-line"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="card-body border-bottom">
            <div class="row g-4">
                <div class="col-md-4">
                    <select class="form-select">
                        <option selected>Vai trò</option>
                        <option>Quản trị viên</option>
                        <option>Điều phối viên</option>
                        <option>Nhân viên kho</option>
                        <option>Nhân viên giao hàng</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option selected>Phòng ban</option>
                        <option>Vận hành</option>
                        <option>Warehouse</option>
                        <option>Dispatching</option>
                        <option>Last Mile</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-select">
                        <option selected>Trạng thái</option>
                        <option>Đang làm</option>
                        <option>Chờ duyệt</option>
                        <option>Tạm nghỉ</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nhân viên</th>
                        <th>Liên hệ</th>
                        <th>Vai trò</th>
                        <th>Phòng ban</th>
                        <th>Trạng thái</th>
                        <th>Ngày vào</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($employees as $employee)
                        @php
                            $status = $statusConfig[$employee['status']] ?? ['text' => 'Không rõ', 'class' => 'bg-label-secondary'];
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar me-3">
                                        <img src="{{ asset('assets/img/avatars/' . $employee['avatar']) }}" alt="Avatar" class="rounded-circle">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $employee['name'] }}</h6>
                                        <small class="text-muted">Mã NV #{{ str_pad($employee['id'], 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div>{{ $employee['email'] }}</div>
                                <small class="text-muted">{{ $employee['phone'] }}</small>
                            </td>
                            <td>{{ $employee['role'] }}</td>
                            <td>{{ $employee['department'] }}</td>
                            <td><span class="badge rounded-pill {{ $status['class'] }}">{{ $status['text'] }}</span></td>
                            <td>{{ $employee['joined_at'] }}</td>
                            <td class="text-end">
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ri-more-2-line"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="{{ route('admin.employees.show', $employee['id']) }}">
                                            <i class="ri-eye-line me-2"></i> Xem chi tiết
                                        </a>
                                        <button
                                            type="button"
                                            class="dropdown-item"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editEmployee{{ $employee['id'] }}">
                                            <i class="ri-pencil-line me-2"></i> Sửa
                                        </button>
                                        <form action="{{ route('admin.employees.destroy', $employee['id']) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xoá nhân viên này không?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="ri-delete-bin-6-line me-2"></i> Xoá
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editEmployee{{ $employee['id'] }}" tabindex="-1" aria-hidden="true">
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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasAddEmployee"
        aria-labelledby="offcanvasAddEmployeeLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasAddEmployeeLabel" class="offcanvas-title">Thêm nhân viên</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 h-100">
            <form action="{{ route('admin.employees.store') }}" method="POST">
                @csrf
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="name" placeholder="Nguyễn Văn A" required>
                    <label>Họ tên</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="email" class="form-control" name="email" placeholder="employee@example.com" required>
                    <label>Email</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="phone" placeholder="0981 234 567" required>
                    <label>Số điện thoại</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <select name="department" class="form-select" required>
                        <option value="">Chọn phòng ban</option>
                        <option>Vận hành</option>
                        <option>Warehouse</option>
                        <option>Dispatching</option>
                        <option>Last Mile</option>
                    </select>
                    <label>Phòng ban</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <select name="role" class="form-select" required>
                        <option value="">Chọn vai trò</option>
                        <option>Quản trị viên</option>
                        <option>Điều phối viên</option>
                        <option>Nhân viên kho</option>
                        <option>Nhân viên giao hàng</option>
                    </select>
                    <label>Vai trò</label>
                </div>
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Lưu nhân viên</button>
                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Huỷ</button>
            </form>
        </div>
    </div>
</div>
@endsection
