@extends('admin.layout')

@section('title', 'Quản lý Agent')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="d-flex justify-content-between align-items-center mb-6">
        <div>
            <h4 class="mb-1">Quản lý Agent</h4>
            <p class="mb-0 text-muted">Danh sách đại lý giao hàng — dữ liệu thật từ database.</p>
        </div>
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddAgent">
            <i class="ri-user-add-line me-1"></i> Thêm Agent
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible mb-4" role="alert">
            <i class="ri-check-double-line me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible mb-4" role="alert">
            <i class="ri-alert-line me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ===== KPI CARDS ===== --}}
    <div class="row g-6 mb-6">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <p class="text-heading mb-1">Tổng Agent</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $totalAgents }}</h4>
                            </div>
                            <small class="text-muted">Đã đăng ký</small>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-primary rounded">
                                <i class="ri-shield-user-line ri-26px"></i>
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
                        <div>
                            <p class="text-heading mb-1">Đang rảnh</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $activeAgents }}</h4>
                                <p class="text-success mb-1 small">Sẵn sàng nhận đơn</p>
                            </div>
                            <small class="text-muted">Status: active</small>
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
                        <div>
                            <p class="text-heading mb-1">Đang bận</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $busyAgents }}</h4>
                                <p class="text-warning mb-1 small">Đang giao đơn</p>
                            </div>
                            <small class="text-muted">Status: busy</small>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-warning rounded">
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
                        <div>
                            <p class="text-heading mb-1">Tổng đơn đã giao</p>
                            <div class="d-flex align-items-center">
                                <h4 class="mb-1 me-2">{{ $totalDelivered }}</h4>
                            </div>
                            <small class="text-muted">Tất cả agent</small>
                        </div>
                        <div class="avatar">
                            <div class="avatar-initial bg-label-info rounded">
                                <i class="ri-checkbox-circle-line ri-26px"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== TABLE ===== --}}
    <div class="card">
        <div class="card-header border-bottom d-flex justify-content-between align-items-center gap-3 flex-wrap">
            <div>
                <h5 class="card-title mb-1">Danh sách Agent</h5>
                <small class="text-muted">Tổng: {{ $agents->count() }} agent</small>
            </div>
            <form method="GET" action="{{ route('admin.agents.index') }}" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Tìm tên, email, SĐT..." value="{{ request('search') }}" style="min-width:220px">
                <select name="status" class="form-select" style="min-width:130px">
                    <option value="">Tất cả</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Đang rảnh</option>
                    <option value="busy" {{ request('status') === 'busy' ? 'selected' : '' }}>Đang bận</option>
                </select>
                <button class="btn btn-outline-primary" type="submit"><i class="ri-search-line"></i></button>
                @if(request()->hasAny(['search', 'status']))
                    <a href="{{ route('admin.agents.index') }}" class="btn btn-outline-secondary">Reset</a>
                @endif
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Agent</th>
                        <th>Liên hệ</th>
                        <th>Tên đăng nhập</th>
                        <th>Trạng thái</th>
                        <th>Đơn tổng</th>
                        <th>Đã giao</th>
                        <th>Đang giao</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($agents as $agent)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar">
                                    <div class="avatar-initial rounded-circle bg-label-primary">
                                        {{ strtoupper(substr($agent->FullName, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0">{{ $agent->FullName }}</h6>
                                    <small class="text-muted">ID #{{ str_pad($agent->ID, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div>{{ $agent->Email }}</div>
                            <small class="text-muted">{{ $agent->Phone }}</small>
                        </td>
                        <td>
                            <code class="text-body">{{ $agent->Username }}</code>
                        </td>
                        <td>
                            @if($agent->Status === 'active')
                                <span class="badge bg-label-success rounded-pill">Đang rảnh</span>
                            @elseif($agent->Status === 'busy')
                                <span class="badge bg-label-warning rounded-pill">Đang bận</span>
                            @else
                                <span class="badge bg-label-secondary rounded-pill">{{ $agent->Status }}</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $agent->total_orders }}</td>
                        <td class="text-success fw-semibold">{{ $agent->delivered_orders }}</td>
                        <td class="text-primary fw-semibold">{{ $agent->active_orders }}</td>
                        <td class="text-end">
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="ri-more-2-line"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('admin.agents.show', $agent->ID) }}">
                                        <i class="ri-eye-line me-2"></i> Xem chi tiết
                                    </a>
                                    <button class="dropdown-item" type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editAgent{{ $agent->ID }}">
                                        <i class="ri-pencil-line me-2"></i> Chỉnh sửa
                                    </button>

                                    {{-- Đổi trạng thái nhanh --}}
                                    @if($agent->Status !== 'active')
                                    <form action="{{ route('admin.agents.status', $agent->ID) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="active">
                                        <button type="submit" class="dropdown-item text-success">
                                            <i class="ri-user-follow-line me-2"></i> Đặt thành Rảnh
                                        </button>
                                    </form>
                                    @endif
                                    @if($agent->Status !== 'busy')
                                    <form action="{{ route('admin.agents.status', $agent->ID) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="busy">
                                        <button type="submit" class="dropdown-item text-warning">
                                            <i class="ri-truck-line me-2"></i> Đặt thành Bận
                                        </button>
                                    </form>
                                    @endif

                                    <div class="dropdown-divider"></div>
                                    <form action="{{ route('admin.agents.destroy', $agent->ID) }}" method="POST"
                                        onsubmit="return confirm('Xóa agent {{ $agent->FullName }}? Thao tác này không thể hoàn tác!')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="ri-delete-bin-6-line me-2"></i> Xóa agent
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal sửa --}}
                    <div class="modal fade" id="editAgent{{ $agent->ID }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <form action="{{ route('admin.agents.update', $agent->ID) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title">Sửa Agent — {{ $agent->FullName }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="text" name="FullName" class="form-control" value="{{ $agent->FullName }}" placeholder="Họ tên" required>
                                            <label>Họ tên</label>
                                        </div>
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="email" name="Email" class="form-control" value="{{ $agent->Email }}" placeholder="Email" required>
                                            <label>Email</label>
                                        </div>
                                        <div class="form-floating form-floating-outline mb-4">
                                            <input type="text" name="Phone" class="form-control" value="{{ $agent->Phone }}" placeholder="Số điện thoại" required>
                                            <label>Số điện thoại</label>
                                        </div>
                                        <div class="form-floating form-floating-outline mb-4">
                                            <select name="Status" class="form-select">
                                                <option value="active" {{ $agent->Status === 'active' ? 'selected' : '' }}>Đang rảnh (active)</option>
                                                <option value="busy" {{ $agent->Status === 'busy' ? 'selected' : '' }}>Đang bận (busy)</option>
                                            </select>
                                            <label>Trạng thái</label>
                                        </div>
                                        <div class="form-floating form-floating-outline">
                                            <input type="password" name="new_password" class="form-control" placeholder="Để trống nếu không đổi">
                                            <label>Mật khẩu mới (để trống = không đổi)</label>
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

                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-6">
                            <i class="ri-shield-user-line ri-48px d-block mb-2 text-muted opacity-50"></i>
                            Chưa có agent nào. <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddAgent">Thêm ngay</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ===== OFFCANVAS THÊM AGENT ===== --}}
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddAgent" aria-labelledby="offcanvasAddAgentLabel">
    <div class="offcanvas-header border-bottom">
        <h5 id="offcanvasAddAgentLabel" class="offcanvas-title">Thêm Agent mới</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body mx-0 flex-grow-0">
        <form action="{{ route('admin.agents.store') }}" method="POST">
            @csrf
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" name="FullName" placeholder="Nguyễn Văn A" required>
                <label>Họ tên *</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="email" class="form-control" name="Email" placeholder="agent@example.com" required>
                <label>Email *</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" name="Phone" placeholder="0981 234 567" required>
                <label>Số điện thoại *</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="text" class="form-control" name="Username" placeholder="agent_username" required>
                <label>Tên đăng nhập *</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required minlength="6">
                <label>Mật khẩu (tối thiểu 6 ký tự) *</label>
            </div>
            <div class="form-floating form-floating-outline mb-5">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                <label>Xác nhận mật khẩu *</label>
            </div>
            <button type="submit" class="btn btn-primary me-3">Lưu Agent</button>
            <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Huỷ</button>
        </form>
    </div>
</div>

@endsection
