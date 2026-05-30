@extends('admin.layout')

@section('title', 'Quản lý Khách hàng')

@section('content')

    {{-- Xử lý phân trang trực tiếp trên View (Không cần sửa Controller) --}}
    @php
        use Illuminate\Pagination\LengthAwarePaginator;
        use Illuminate\Pagination\Paginator;

        if(isset($customers) && $customers->count() > 0) {
            $perPage = 10;
            $page = Paginator::resolveCurrentPage('page') ?: 1;
            $pageData = $customers->slice(($page - 1) * $perPage, $perPage)->all();

            $customers = new LengthAwarePaginator(
                $pageData,
                $customers->count(),
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

        <div class="d-flex justify-content-between align-items-center mb-6">
            <div>
                <h4 class="mb-1">Quản lý Khách hàng</h4>
                <p class="mb-0 text-muted">Danh sách khách hàng sử dụng dịch vụ.</p>
            </div>
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCustomer">
                <i class="ri-user-add-line me-1"></i> Thêm Khách hàng
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
                                <p class="text-heading mb-1">Tổng Khách hàng</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $totalCustomers ?? 0 }}</h4>
                                </div>
                                <small class="text-muted">Đã đăng ký</small>
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
                            <div>
                                <p class="text-heading mb-1">Khách hàng mới</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $newCustomers ?? 0 }}</h4>
                                    <p class="text-success mb-1 small">Tháng này</p>
                                </div>
                                <small class="text-muted">Tăng trưởng</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-success rounded">
                                    <i class="ri-user-add-line ri-26px"></i>
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
                                <p class="text-heading mb-1">Đang hoạt động</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $activeCustomers ?? 0 }}</h4>
                                </div>
                                <small class="text-muted">Tất cả tài khoản</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-warning rounded">
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
                                <p class="text-heading mb-1">Tổng Đơn Hệ Thống</p>
                                <div class="d-flex align-items-center">
                                    <h4 class="mb-1 me-2">{{ $totalOrders ?? 0 }}</h4>
                                </div>
                                <small class="text-muted">Toàn hệ thống</small>
                            </div>
                            <div class="avatar">
                                <div class="avatar-initial bg-label-info rounded">
                                    <i class="ri-shopping-cart-2-line ri-26px"></i>
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
                    <h5 class="card-title mb-1">Danh sách Khách hàng</h5>
                    <small class="text-muted">Tổng: {{ isset($customers) && method_exists($customers, 'total') ? $customers->total() : (isset($customers) ? $customers->count() : 0) }} khách hàng</small>
                </div>
                <form method="GET" action="{{ route('admin.customers.index') }}" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Tìm tên, email, SĐT..." value="{{ request('search') }}" style="min-width:220px">
                    <button class="btn btn-outline-primary" type="submit"><i class="ri-search-line"></i></button>
                    @if(request()->has('search'))
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Khách hàng</th>
                        <th>Liên hệ</th>
                        <th class="text-center">Ngày tham gia</th>
                        <th class="text-center">Trạng thái</th>
                        <th class="text-end">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @if(isset($customers) && $customers->count() > 0)
                        @foreach($customers as $customer)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            <div class="avatar-initial rounded-circle bg-label-primary">
                                                {{ strtoupper(substr($customer->full_name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $customer->full_name }}</h6>
                                            <small class="text-muted">ID #{{ str_pad($customer->id, 4, '0', STR_PAD_LEFT) }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>{{ $customer->email }}</div>
                                    <small class="text-muted">{{ $customer->phone }}</small>
                                </td>
                                <td class="text-center">
                                    {{ $customer->created_at ? $customer->created_at->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-label-success rounded-pill">Hoạt động</span>
                                </td>

                                <td class="text-end">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="ri-more-2-line"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('admin.customers.overview', $customer->id) }}">
                                                <i class="ri-eye-line me-2"></i> Xem chi tiết
                                            </a>
                                            <button class="dropdown-item" type="button"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editCustomer{{ $customer->id }}">
                                                <i class="ri-pencil-line me-2"></i> Chỉnh sửa
                                            </button>
                                            <div class="dropdown-divider"></div>
                                            <form action="#" method="POST"
                                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa khách hàng này?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="ri-delete-bin-6-line me-2"></i> Xóa khách hàng
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal sửa khách hàng --}}
                            <div class="modal fade" id="editCustomer{{ $customer->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="#" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Sửa Khách hàng — {{ $customer->full_name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-floating form-floating-outline mb-4">
                                                    <input type="text" name="full_name" class="form-control" value="{{ $customer->full_name }}" required>
                                                    <label>Họ tên</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-4">
                                                    <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required>
                                                    <label>Email</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-4">
                                                    <input type="text" name="phone" class="form-control" value="{{ $customer->phone }}" required>
                                                    <label>Số điện thoại</label>
                                                </div>
                                                <div class="form-floating form-floating-outline mb-4">
                                                    <input type="text" name="address" class="form-control" value="{{ $customer->address }}">
                                                    <label>Địa chỉ</label>
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
                    @else
                        <tr>
                            <td colspan="6" class="text-center text-muted py-6">
                                <i class="ri-user-line ri-48px d-block mb-2 text-muted opacity-50"></i>
                                Chưa có khách hàng nào. <a href="javascript:void(0)" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddCustomer">Thêm ngay</a>
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>

            {{-- Thanh Phân Trang --}}
            @if(isset($customers) && method_exists($customers, 'hasPages') && $customers->hasPages())
                <div class="card-footer border-top px-4 py-3">
                    {{ $customers->appends(request()->query())->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>

    </div>

    {{-- ===== OFFCANVAS THÊM KHÁCH HÀNG ===== --}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddCustomer" aria-labelledby="offcanvasAddCustomerLabel">
        <div class="offcanvas-header border-bottom">
            <h5 id="offcanvasAddCustomerLabel" class="offcanvas-title">Thêm Khách hàng mới</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0">
            <form action="#" method="POST">
                @csrf
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="full_name" placeholder="Nguyễn Văn B" required>
                    <label>Họ tên *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="email" class="form-control" name="email" placeholder="khachhang@example.com" required>
                    <label>Email *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="phone" placeholder="0981 234 567" required>
                    <label>Số điện thoại *</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="text" class="form-control" name="address" placeholder="123 Đường ABC, Quận X">
                    <label>Địa chỉ</label>
                </div>
                <div class="form-floating form-floating-outline mb-5">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required minlength="6">
                    <label>Mật khẩu (tối thiểu 6 ký tự) *</label>
                </div>
                <button type="submit" class="btn btn-primary me-3">Lưu Khách hàng</button>
                <button type="reset" class="btn btn-outline-danger" data-bs-dismiss="offcanvas">Huỷ</button>
            </form>
        </div>
    </div>
@endsection
