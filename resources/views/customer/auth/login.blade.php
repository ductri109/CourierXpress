<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - CourierXpress</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #7f1d1d 100%);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-gray-50 min-h-screen">
    <div class="min-h-screen flex">
        <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden items-center justify-center">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 text-white px-12 max-w-lg">
                <a href="{{ route('landing') }}" class="flex items-center space-x-3 mb-12 hover:opacity-90 transition-opacity">
                    <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                        <i data-lucide="package" class="w-8 h-8 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold">CourierXpress</h1>
                        <p class="text-sm text-white/80 font-medium">LOGISTICS</p>
                    </div>
                </a>

                <h2 class="text-4xl font-bold mb-6 leading-tight">
                    Chào mừng<br>
                    <span class="text-yellow-300">trở lại!</span>
                </h2>

                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Đăng nhập để quản lý vận đơn, tra cứu lộ trình và cập nhật trạng thái đơn hàng của bạn theo thời gian thực.
                </p>

                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <i data-lucide="bar-chart-2" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-white/90">Hệ thống báo cáo minh bạch</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                            <i data-lucide="shield-check" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-white/90">Bảo mật thông tin tuyệt đối</span>
                    </div>
                </div>

                <div class="mt-12 floating">
                    <img src="data:image/jpeg;base64,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" alt="Delivery Logistics" class="rounded-2xl shadow-2xl w-full border-4 border-white/10">
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
            <div class="w-full max-w-md">
                <div class="lg:hidden flex items-center justify-center space-x-3 mb-8">
                    <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center">
                        <i data-lucide="package" class="w-7 h-7 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-primary-700">CourierXpress</h1>
                        <p class="text-xs text-primary-500 font-medium">LOGISTICS</p>
                    </div>
                </div>

                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-900">Đăng nhập hệ thống</h2>
                    <p class="text-gray-600 mt-2">Vui lòng nhập email và mật khẩu của bạn</p>
                </div>
<!--
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <button class="flex items-center justify-center space-x-2 px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-primary-300 hover:bg-primary-50 transition-all">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" class="w-5 h-5">
                        <span class="text-gray-700 font-medium text-sm">Google</span>
                    </button>
                    <button class="flex items-center justify-center space-x-2 px-4 py-3 border-2 border-gray-200 rounded-xl hover:border-primary-300 hover:bg-primary-50 transition-all">
                        <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" class="w-5 h-5">
                        <span class="text-gray-700 font-medium text-sm">Facebook</span>
                    </button>
                </div>

                <div class="relative mb-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-gray-50 text-gray-500">Hoặc đăng nhập với email</span>
                    </div>
                </div> -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                <form class="space-y-5" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
                            class="w-full pl-12 pr-4 py-3 bg-white border-2 @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all"
                            required>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                            </div>
                            <input type="password" id="password" name="password" placeholder="••••••••"
                                class="w-full pl-12 pr-12 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all"
                                required>
                            <button type="button" onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <div class="flex items-center space-x-2">
                            <input type="checkbox" id="remember" class="w-4 h-4 rounded border-2 border-gray-300 text-primary-600 focus:ring-primary-500">
                            <label for="remember" class="text-sm text-gray-600 cursor-pointer">Ghi nhớ đăng nhập</label>
                        </div>
                        <a href="#" class="text-sm font-medium text-primary-600 hover:text-primary-700">Quên mật khẩu?</a>
                    </div>

                    <button type="submit"
                        class="w-full bg-primary-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2 mt-6">
                        <span>Đăng nhập</span>
                        <i data-lucide="log-in" class="w-5 h-5"></i>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-gray-600">
                        Chưa có tài khoản?
                        <a href="{{ route('register') }}" class="text-primary-600 font-semibold hover:text-primary-700">Đăng ký ngay</a>
                    </p>
                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-gray-500 hover:text-primary-600 transition-colors">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Quay lại trang chủ</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Toggle password visibility
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</body>
</html>
