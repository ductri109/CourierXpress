<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Đại lý (Agent) - CourierXpress Logistics</title>
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
<body class="font-sans text-gray-800 bg-gray-100 min-h-screen flex items-center justify-center p-4 selection:bg-primary-100 selection:text-primary-900">

<div class="w-full max-w-[450px] bg-white rounded-lg shadow-xl border border-gray-200 relative overflow-hidden my-8">
    <!-- Top decorative line -->
    <div class="absolute top-0 left-0 w-full h-1.5 bg-primary-600"></div>

    <div class="p-8 sm:p-10">
        <!-- Header & Logo -->
        <div class="flex flex-col items-center text-center mb-8">
            <div class="w-12 h-12 bg-primary-50 border border-primary-100 rounded-lg flex items-center justify-center shadow-sm mb-4">
                <i data-lucide="package" class="w-7 h-7 text-primary-600"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-wide leading-none">CourierXpress</h1>
            <p class="text-[0.65rem] text-primary-600 font-bold tracking-[0.25em] mt-1.5 uppercase">Logistics</p>

            <div class="mt-6 w-full">
                <h2 class="text-lg font-semibold text-gray-800">Cổng Quản Trị Đại Lý</h2>
                <p class="text-sm text-gray-500 mt-1">Đăng nhập để truy cập không gian làm việc</p>
            </div>
        </div>

        <!-- Error Messages -->
        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 p-3.5 rounded-lg flex items-start">
                <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500 mr-2.5 shrink-0"></i>
                <p class="text-sm text-red-700 font-medium">{{ $errors->first() }}</p>
            </div>
        @endif

        <!-- Login Form -->
        <form class="space-y-5" action="{{ route('agent.login.post') }}" method="POST">
            @csrf

            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-1.5">Mã đại lý / Tên đăng nhập</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
                    </div>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" placeholder="VD: AGENT_HANOI_01" required autofocus
                           class="block w-full pl-10 pr-3.5 py-2.5 text-sm bg-gray-50 border border-gray-300 rounded-md text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary-500/20 focus:border-primary-600 transition-colors">
                </div>
            </div>

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

            <div class="flex items-center justify-between pt-1">
                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 cursor-pointer">
                    <label for="remember" class="ml-2 text-sm text-gray-600 cursor-pointer select-none">Ghi nhớ phiên</label>
                </div>
                <a href="#" class="text-sm font-semibold text-primary-600 hover:text-primary-800 transition-colors">Quên mật khẩu?</a>
            </div>

            <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white py-2.5 px-4 rounded-md font-semibold text-sm transition-colors flex items-center justify-center space-x-2 mt-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-600 shadow-sm">
                <span>Đăng nhập hệ thống</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>
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
