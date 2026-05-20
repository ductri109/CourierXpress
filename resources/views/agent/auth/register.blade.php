<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Đại lý (Agent) - CourierXpress Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-gray-100 min-h-screen flex items-center justify-center p-4 sm:p-6 selection:bg-primary-100 selection:text-primary-900">

<div class="w-full max-w-[600px] bg-white rounded-lg shadow-xl border border-gray-200 relative overflow-hidden my-4 sm:my-8">
    <!-- Top decorative line -->
    <div class="absolute top-0 left-0 w-full h-1.5 bg-primary-600"></div>

    <div class="p-6 sm:p-10">
        <!-- Header & Logo -->
        <div class="flex flex-col items-center text-center mb-8">
            <div class="w-12 h-12 bg-primary-50 border border-primary-100 rounded-lg flex items-center justify-center shadow-sm mb-4">
                <i data-lucide="package" class="w-7 h-7 text-primary-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-wide leading-none">CourierXpress</h1>
            <p class="text-[0.65rem] text-primary-600 font-bold tracking-[0.25em] mt-1.5 uppercase">Logistics</p>

            <div class="mt-6 w-full">
                <h2 class="text-lg font-semibold text-gray-800">Đăng Ký Đối Tác Đại Lý</h2>
                <p class="text-sm text-gray-500 mt-1">Điền thông tin bên dưới để thiết lập bưu cục mới</p>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-lg flex items-start">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500 mr-3 mt-0.5 shrink-0"></i>
                <ul class="text-sm text-red-700 font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <li>&bull; {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Register Form -->
        <form action="{{ route('agent.register.post') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <!-- Họ và tên (Chiếm 2 cột trên màn hình lớn) -->
                <div class="sm:col-span-2">
                    <label for="FullName" class="block text-sm font-semibold text-gray-700 mb-1.5">Họ và tên người đại diện</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="text" id="FullName" name="FullName" value="{{ old('FullName') }}" placeholder="VD: Nguyễn Văn A" required
                               class="block w-full pl-10 pr-3.5 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-colors">
                    </div>
                </div>

                <!-- Tên đăng nhập -->
                <div>
                    <label for="Username" class="block text-sm font-semibold text-gray-700 mb-1.5">Tên đăng nhập (Mã ĐL)</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i data-lucide="at-sign" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="text" id="Username" name="Username" value="{{ old('Username') }}" placeholder="VD: agent_hanoi" required
                               class="block w-full pl-10 pr-3.5 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-colors">
                    </div>
                </div>

                <!-- Số điện thoại -->
                <div>
                    <label for="Phone" class="block text-sm font-semibold text-gray-700 mb-1.5">Số điện thoại liên hệ</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i data-lucide="phone" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="tel" id="Phone" name="Phone" value="{{ old('Phone') }}" placeholder="VD: 0909 123 456" required
                               class="block w-full pl-10 pr-3.5 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-colors">
                    </div>
                </div>

                <!-- Địa chỉ Email (Chiếm 2 cột trên màn hình lớn) -->
                <div class="sm:col-span-2">
                    <label for="Email" class="block text-sm font-semibold text-gray-700 mb-1.5">Địa chỉ Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="email" id="Email" name="Email" value="{{ old('Email') }}" placeholder="VD: agent@courierxpress.com" required
                               class="block w-full pl-10 pr-3.5 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-colors">
                    </div>
                </div>

                <!-- Mật khẩu -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Mật khẩu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                               class="block w-full pl-10 pr-10 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-colors">
                        <button type="button" onclick="togglePassword('password', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i data-lucide="eye" class="w-4 h-4 transition-colors"></i>
                        </button>
                    </div>
                </div>

                <!-- Xác nhận mật khẩu -->
                <div>
                    <label for="confirmPassword" class="block text-sm font-semibold text-gray-700 mb-1.5">Xác nhận mật khẩu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="••••••••" required
                               class="block w-full pl-10 pr-10 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-colors">
                        <button type="button" onclick="togglePassword('confirmPassword', this)" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                            <i data-lucide="eye" class="w-4 h-4 transition-colors"></i>
                        </button>
                    </div>
                </div>

            </div> <!-- End Grid -->

            <div class="flex items-start space-x-3 mt-6">
                <div class="flex items-center h-5">
                    <input type="checkbox" id="terms" name="terms" class="w-4 h-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 cursor-pointer mt-0.5" required>
                </div>
                <label for="terms" class="text-sm text-gray-600 cursor-pointer">
                    Tôi xác nhận thông tin chính xác và đồng ý với
                    <a href="{{ route('terms') }}" class="text-primary-600 font-semibold hover:text-primary-800 transition-colors">Điều khoản sử dụng</a> và
                    <a href="{{ route('policy') }}" class="text-primary-600 font-semibold hover:text-primary-800 transition-colors">Chính sách bảo mật</a>
                </label>
            </div>

            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2.5 px-4 rounded-md font-semibold text-sm transition-colors flex items-center justify-center space-x-2 mt-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 shadow-sm">
                <span>Đăng Ký Tài Khoản</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        <!-- Footer area -->
        <div class="mt-8 pt-6 border-t border-gray-100 text-center">
            <p class="text-sm text-gray-600">
                Đã có tài khoản đại lý?
                <a href="{{ route('agent.login') }}" class="font-semibold text-primary-600 hover:text-primary-800 transition-colors ml-1">Đăng nhập ngay</a>
            </p>
        </div>
    </div>

    <!-- Bottom Links -->
    <div class="bg-gray-50 border-t border-gray-100 py-4 px-8 flex justify-center space-x-4 text-xs text-gray-400 font-medium">
        <a href="#" class="hover:text-gray-600 transition-colors">Hướng dẫn đăng ký</a>
        <span>&bull;</span>
        <a href="#" class="hover:text-gray-600 transition-colors">Hỗ trợ đối tác</a>
        <span>&bull;</span>
        <a href="#" class="hover:text-gray-600 transition-colors">Hotline: 1900 123 456</a>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    // Khởi tạo icons
    lucide.createIcons();

    // Logic ẩn/hiện mật khẩu
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
            btn.classList.add('text-primary-600');
            btn.classList.remove('text-gray-400');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
            btn.classList.add('text-gray-400');
            btn.classList.remove('text-primary-600');
        }
        lucide.createIcons();
    }
</script>
</body>
</html>
