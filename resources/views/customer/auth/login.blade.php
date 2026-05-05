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
                    <img src="https://static.photos/delivery/640x360/88" alt="Delivery Logistics" class="rounded-2xl shadow-2xl w-full border-4 border-white/10">
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