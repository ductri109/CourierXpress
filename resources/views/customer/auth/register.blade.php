<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - CourierXpress Logistics</title>
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
    <!-- Left Side - Image/Branding -->
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden items-center justify-center">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 text-white px-12 max-w-lg">
            <!-- Logo -->
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
                Bắt đầu hành trình<br>
                <span class="text-yellow-300">giao hàng siêu tốc</span>
            </h2>

            <p class="text-xl text-white/90 mb-8 leading-relaxed">
                Tham gia cùng 50,000+ khách hàng đang sử dụng CourierXpress Logistics để tối ưu hóa logistics của họ.
            </p>

            <!-- Features List -->
            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-white/90">Miễn phí 10 đơn hàng đầu tiên</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-white/90">Theo dõi đơn hàng real-time</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-white/90">Hỗ trợ 24/7 tận tâm</span>
                </div>
            </div>

            <!-- Floating Illustration -->
            <div class="mt-12 floating">
                <img src="data:image/jpeg;base64,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" alt="Delivery" class="rounded-2xl shadow-2xl w-full">
            </div>
        </div>
    </div>

    <!-- Right Side - Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="w-full max-w-md">
            <!-- Mobile Logo -->
            <a href="{{ route('landing') }}" class="lg:hidden flex items-center justify-center space-x-3 mb-8 hover:opacity-90 transition-opacity">
                <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="package" class="w-7 h-7 text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-primary-700">FastDelivery</h1>
                    <p class="text-xs text-primary-500 font-medium">PRO</p>
                </div>
            </a>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Tạo tài khoản mới</h2>
                <p class="text-gray-600 mt-2">Điền thông tin để bắt đầu sử dụng dịch vụ</p>
            </div>

            <!-- Registration Form -->
            <form class="space-y-5" action="{{ route('register') }}" method="POST">
                @csrf
                <!-- Full Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Họ và tên</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="Nguyễn Văn A"
                               class="w-full pl-12 pr-4 py-3 bg-white border-2 @error('full_name') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                    </div>
                    @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Số điện thoại</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="phone" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="0909 123 456"
                               class="w-full pl-12 pr-4 py-3 bg-white border-2 @error('phone') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                    </div>
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
                               class="w-full pl-12 pr-4 py-3 bg-white border-2 @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mật khẩu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                               class="w-full pl-12 pr-12 py-3 bg-white border-2 @error('password') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                        <button type="button" onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Xác nhận mật khẩu</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="••••••••"
                               class="w-full pl-12 pr-12 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                        <button type="button" onclick="togglePassword('confirmPassword', this)"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start space-x-3">
                    <input type="checkbox" id="terms" class="w-5 h-5 rounded border-2 border-gray-300 text-primary-600 focus:ring-primary-500 mt-0.5" required>
                    <label for="terms" class="text-sm text-gray-600">
                        Tôi đồng ý với <a href="{{ route('terms') }}" class="text-primary-600 hover:text-primary-700 font-medium">Điều khoản sử dụng</a> và
                        <a href="{{ route('policy') }}" class="text-primary-600 hover:text-primary-700 font-medium">Chính sách bảo mật</a> của CourierXpress Logistics
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full bg-primary-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                    <span>Đăng ký ngay</span>
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Đã có tài khoản?
                    <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:text-primary-700">Đăng nhập</a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-gray-500 hover:text-primary-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Quay lại trang chủ</span>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
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

    // Account type selection visual feedback
    document.querySelectorAll('input[name="accountType"]').forEach(radio => {
        radio.addEventListener('change', function() {
            lucide.createIcons();
        });
    });
</script>
</body>
</html>
