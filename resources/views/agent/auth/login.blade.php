<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Đại lý (Agent) - CourierXpress Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
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
    <style>
        .gradient-bg { background: radial-gradient(circle at center, #e53935 0%, #9a0000 100%); }
        .floating { animation: floating 3s ease-in-out infinite; }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .input-focus:focus-within {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.15);
            border-color: #dc2626;
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-gray-50 min-h-screen">
<div class="min-h-screen flex">
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden items-center justify-center p-12">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 text-white w-full max-w-md flex flex-col h-full justify-between py-4">
            <div>
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg">
                        <i data-lucide="package" class="w-7 h-7 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold leading-none tracking-tight">CourierXpress</h1>
                        <p class="text-sm text-white/80 font-medium tracking-[0.2em] mt-1">LOGISTICS</p>
                    </div>
                </div>
                <h2 class="text-4xl font-extrabold mb-6 leading-[1.2]">Bắt đầu quản lý<br><span class="text-yellow-300">bưu cục toàn diện</span></h2>
                <p class="text-lg text-white/90 mb-8 leading-relaxed font-medium">Đăng nhập vào hệ thống dành cho Agent để bắt đầu điều phối luồng vận đơn và vận hành đại lý giao nhận chuyên nghiệp.</p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0"><i data-lucide="check" class="w-5 h-5 text-white"></i></div>
                        <span class="text-white/90 font-medium">Khởi tạo và quản lý vận đơn trực tiếp</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0"><i data-lucide="check" class="w-5 h-5 text-white"></i></div>
                        <span class="text-white/90 font-medium">Cập nhật trạng thái giao hàng real-time</span>
                    </div>
                    <div class="flex items-center space-x-4">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center shrink-0"><i data-lucide="check" class="w-5 h-5 text-white"></i></div>
                        <span class="text-white/90 font-medium">Hệ thống thống kê & báo cáo độc lập</span>
                    </div>
                </div>
            </div>
            <div class="mt-8 floating">
                <img src="https://images.unsplash.com/photo-1553413077-190dd305871c?q=80&w=800&auto=format&fit=crop" alt="Warehouse" class="rounded-2xl shadow-2xl w-full h-56 object-cover border-4 border-white/10">
            </div>
        </div>
    </div>
    <div class="w-full lg:w-1/2 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12 bg-white">
        <div class="w-full max-w-md">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Chào mừng trở lại! 👋</h2>
                <p class="text-gray-500 mt-2 font-medium">Đăng nhập vào cổng quản trị bưu cục Đại lý</p>
            </div>
            @if($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-start shadow-sm">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mr-3 mt-0.5 shrink-0"></i>
                    <p class="text-sm text-red-600 font-semibold">{{ $errors->first() }}</p>
                </div>
            @endif
            <form class="space-y-5" action="{{ route('agent.login.post') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tên đăng nhập</label>
                    <div class="relative input-focus rounded-xl border-2 bg-white flex items-center border-gray-200"><div class="pl-4"><i data-lucide="user" class="w-5 h-5 text-gray-400"></i></div><input type="text" name="username" value="{{ old('username') }}" placeholder="Nhập tên đăng nhập đại lý" required autofocus class="w-full pl-3 pr-4 py-3 bg-transparent border-none focus:ring-0 focus:outline-none text-gray-800 font-medium"></div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mật khẩu</label>
                    <div class="relative input-focus rounded-xl border-2 bg-white flex items-center border-gray-200"><div class="pl-4"><i data-lucide="lock" class="w-5 h-5 text-gray-400"></i></div><input type="password" id="password" name="password" placeholder="••••••••" required class="w-full pl-3 pr-12 py-3 bg-transparent border-none focus:ring-0 focus:outline-none text-gray-800 font-medium"><button type="button" onclick="togglePassword('password', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-primary-600"><i data-lucide="eye" class="w-5 h-5"></i></button></div>
                </div>
                <div class="flex items-center justify-between mt-4">
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" id="remember" class="w-4 h-4 rounded text-primary-600 focus:ring-primary-500 cursor-pointer"><label for="remember" class="text-sm text-gray-600 cursor-pointer font-medium select-none">Ghi nhớ đăng nhập</label>
                    </div>
                    <a href="#" class="text-sm font-semibold text-primary-600 hover:text-primary-700">Quên mật khẩu?</a>
                </div>
                <button type="submit" class="w-full bg-primary-600 text-white py-4 rounded-xl font-bold text-[1.05rem] hover:bg-primary-700 transition-all shadow-lg transform hover:-translate-y-0.5 flex items-center justify-center space-x-2 mt-6"><span>Đăng nhập hệ thống</span><i data-lucide="log-in" class="w-5 h-5"></i></button>
            </form>
            <div class="mt-8 text-center">
                <p class="text-gray-600 font-medium">Chưa có tài khoản bưu cục? <a href="{{ route('agent.register') }}" class="text-primary-600 font-bold hover:text-primary-700 ml-1">Đăng ký ngay</a></p>
            </div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId); const icon = btn.querySelector('i');
        if (input.type === 'password') { input.type = 'text'; icon.setAttribute('data-lucide', 'eye-off'); btn.classList.add('text-primary-600'); }
        else { input.type = 'password'; icon.setAttribute('data-lucide', 'eye'); btn.classList.remove('text-primary-600'); }
        lucide.createIcons();
    }
</script>
</body>
</html>
