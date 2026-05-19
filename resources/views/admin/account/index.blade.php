@extends('admin.layout')

@section('title', 'Tài khoản của tôi')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    <h4 class="fw-bold py-3 mb-6">
        <span class="text-muted fw-light">Cài đặt /</span> Tài khoản
    </h4>

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

    <div class="row g-6">

        {{-- ===== AVATAR + INFO CARD ===== --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body text-center pt-6">
                    <div class="mb-4">
                        <div class="avatar avatar-xl mx-auto mb-3">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar" class="rounded-circle w-px-100 h-auto" />
                        </div>
                        <h5 class="mb-0">{{ $admin->user_name }}</h5>
                        <p class="text-muted mb-0 small">Quản trị viên hệ thống</p>
                    </div>

                    <div class="border rounded-3 p-4 text-start">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-user-line me-2 text-primary"></i>
                            <div>
                                <small class="text-muted d-block">Tên đăng nhập</small>
                                <span class="fw-semibold">{{ $admin->user_name }}</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="ri-shield-check-line me-2 text-success"></i>
                            <div>
                                <small class="text-muted d-block">Vai trò</small>
                                <span class="fw-semibold">Quản trị viên</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="ri-calendar-line me-2 text-info"></i>
                            <div>
                                <small class="text-muted d-block">Tạo lúc</small>
                                <span class="fw-semibold">{{ $admin->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== FORMS ===== --}}
        <div class="col-xl-8">

            {{-- Tab nav --}}
            <ul class="nav nav-tabs nav-fill mb-4" id="accountTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="tab-username-tab" data-bs-toggle="tab" data-bs-target="#tab-username" type="button" role="tab">
                        <i class="ri-user-settings-line me-1"></i> Đổi tên đăng nhập
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-password-tab" data-bs-toggle="tab" data-bs-target="#tab-password" type="button" role="tab">
                        <i class="ri-lock-password-line me-1"></i> Đổi mật khẩu
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="accountTabContent">

                {{-- ===== ĐỔI USERNAME ===== --}}
                <div class="tab-pane fade show active" id="tab-username" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="ri-user-settings-line me-1"></i> Thay đổi tên đăng nhập</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.account.username') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-floating form-floating-outline mb-4">
                                    <input
                                        type="text"
                                        name="user_name"
                                        class="form-control @error('user_name') is-invalid @enderror"
                                        value="{{ old('user_name', $admin->user_name) }}"
                                        placeholder="Tên đăng nhập mới"
                                        required
                                        minlength="3"
                                        maxlength="50">
                                    <label>Tên đăng nhập mới</label>
                                    @error('user_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                    <input
                                        type="password"
                                        name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="Mật khẩu hiện tại"
                                        required>
                                    <label>Xác nhận bằng mật khẩu hiện tại</label>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="alert alert-info small py-2">
                                    <i class="ri-information-line me-1"></i>
                                    Tên đăng nhập mới phải từ 3–50 ký tự. Sau khi đổi, bạn cần dùng tên mới để đăng nhập.
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-save-line me-1"></i> Lưu tên đăng nhập
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- ===== ĐỔI MẬT KHẨU ===== --}}
                <div class="tab-pane fade" id="tab-password" role="tabpanel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="ri-lock-password-line me-1"></i> Thay đổi mật khẩu</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.account.password') }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="form-floating form-floating-outline mb-4">
                                    <input
                                        type="password"
                                        name="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="Mật khẩu hiện tại"
                                        required>
                                    <label>Mật khẩu hiện tại</label>
                                    @error('current_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                    <input
                                        type="password"
                                        name="new_password"
                                        class="form-control @error('new_password') is-invalid @enderror"
                                        placeholder="Mật khẩu mới"
                                        required
                                        minlength="6">
                                    <label>Mật khẩu mới (tối thiểu 6 ký tự)</label>
                                    @error('new_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-floating form-floating-outline mb-4">
                                    <input
                                        type="password"
                                        name="new_password_confirmation"
                                        class="form-control"
                                        placeholder="Xác nhận mật khẩu"
                                        required>
                                    <label>Xác nhận mật khẩu mới</label>
                                </div>

                                <div class="mb-4">
                                    <small class="text-muted d-block mb-1 fw-semibold">Yêu cầu mật khẩu mạnh:</small>
                                    <ul class="text-muted small ps-3 mb-0">
                                        <li>Tối thiểu 6 ký tự</li>
                                        <li>Nên có chữ hoa, chữ thường và số</li>
                                        <li>Không được trùng mật khẩu cũ</li>
                                    </ul>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="ri-lock-line me-1"></i> Cập nhật mật khẩu
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Nếu có lỗi ở tab password thì tự mở tab đó
    @if($errors->has('new_password') || ($errors->has('current_password') && request()->is('*password*')))
        document.addEventListener('DOMContentLoaded', function () {
            var tab = document.getElementById('tab-password-tab');
            if (tab) new bootstrap.Tab(tab).show();
        });
    @endif
</script>
@endpush
@endsection
