<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CourierXpress - Trang Chủ</title>
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
        /* Thêm hiệu ứng cho các icon box */
        .icon-box {
            background: rgba(220, 38, 38, 0.05);
            border: 1px solid rgba(220, 38, 38, 0.1);
        }
        .gradient-hero {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #7f1d1d 100%);
        }
        .gradient-card {
            background: linear-gradient(145deg, #fef2f2 0%, #fee2e2 100%);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .pulse-ring {
            animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.8); opacity: 0.8; }
            50% { transform: scale(1.2); opacity: 0; }
            100% { transform: scale(0.8); opacity: 0; }
        }
        .scroll-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease-out;
        }
        .scroll-reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
        .tracking-line {
            background: linear-gradient(90deg, #dc2626 0%, #ef4444 50%, #dc2626 100%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-gray-50">
<nav class="fixed w-full z-50 bg-white/95 backdrop-blur-md shadow-sm transition-all duration-300" id="navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <a href="{{ route('landing') }}" class="flex items-center space-x-3 hover:opacity-90 transition-opacity">
                <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center shadow-lg">
                    <i data-lucide="package" class="w-7 h-7 text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-primary-700">CourierXpress</h1>
                    <p class="text-xs text-primary-500 font-medium">LOGISTICS</p>
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-8">

                <a href="{{ route('landing') }}"
                   class="{{ request()->routeIs('landing')
                            ? 'text-primary-600 font-bold'
                            : 'text-gray-600 hover:text-primary-600' }}
                            font-medium transition-colors">
                    Trang chủ
                </a>

                <a href="#tracking"
                   class="text-gray-600 hover:text-primary-600 font-medium transition-colors">
                    Tra cứu
                </a>

                <a href="{{ route('about') }}"
                   class="{{ request()->routeIs('about')
                            ? 'text-primary-600 font-bold'
                            : 'text-gray-600 hover:text-primary-600' }}
                            font-medium transition-colors">
                    Về chúng tôi
                </a>

                <a href="{{ route('services') }}"
                   class="{{ request()->routeIs('services', 'terms', 'policy')
                            ? 'text-primary-600 font-bold'
                            : 'text-gray-600 hover:text-primary-600' }}
                            font-medium transition-colors">
                    Dịch vụ
                </a>

                <a href="{{ route('contact') }}"
                   class="{{ request()->routeIs('contact')
                            ? 'text-primary-600 font-bold'
                            : 'text-gray-600 hover:text-primary-600' }}
                            font-semibold text-sm transition-colors">
                    Liên hệ
                </a>

            </div>

            <div class="hidden md:flex items-center space-x-4">
                @auth('customer')
                    <!-- User Profile Dropdown -->
                    <div class="relative group" id="userDropdown">
                        <button class="flex items-center space-x-3 focus:outline-none p-1.5 rounded-xl hover:bg-gray-100 transition-all">
                            <div class="text-right hidden lg:block">
                                <p class="text-sm font-bold text-gray-800 leading-none">{{ Auth::guard('customer')->user()->name }}</p>
                                <p class="text-[10px] text-primary-600 font-medium uppercase tracking-wider">Khách hàng</p>
                            </div>
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('customer')->user()->name) }}&background=ef4444&color=fff"
                                     alt="Avatar"
                                     class="w-10 h-10 rounded-xl object-cover border-2 border-white shadow-sm">
                                <div class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 bg-green-500 border-2 border-white rounded-full"></div>
                            </div>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-gray-400 group-hover:text-primary-600 transition-colors"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 w-56 mt-2 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform origin-top-right group-hover:translate-y-0 translate-y-2">
                            <div class="px-4 py-3 border-b border-gray-50 mb-1">
                                <p class="text-xs text-gray-500">Tài khoản của bạn</p>
                                <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::guard('customer')->user()->email }}</p>
                            </div>

                            <a href="#" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                                <i data-lucide="user" class="w-4 h-4"></i>
                                <span class="font-medium">Hồ sơ của tôi</span>
                            </a>

                            <a href="#" class="flex items-center space-x-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-colors">
                                <i data-lucide="package" class="w-4 h-4"></i>
                                <span class="font-medium">Đơn hàng của tôi</span>
                            </a>

                            <div class="h-px bg-gray-100 my-1 mx-2"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors font-semibold">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="bg-primary-600 text-white px-6 py-2.5 rounded-xl font-semibold hover:bg-primary-700 transition-all shadow-md">
                        <span>Đăng Nhập</span>
                    </a>
                @endauth

            </div>

            <button class="md:hidden p-2 rounded-lg hover:bg-gray-100" id="mobileMenuBtn">
                <i data-lucide="menu" class="w-6 h-6 text-gray-700"></i>
            </button>
        </div>
    </div>

    <div class="md:hidden hidden bg-white border-t" id="mobileMenu">
        <div class="px-4 py-4 space-y-3">
            <a href="#features" class="block py-2 text-gray-600 hover:text-primary-600">Tính năng</a>
            <a href="#tracking" class="block py-2 text-gray-600 hover:text-primary-600">Tra cứu</a>
            <a href="#pricing" class="block py-2 text-gray-600 hover:text-primary-600">Bảng giá</a>
            <a href="#testimonials" class="block py-2 text-gray-600 hover:text-primary-600">Đánh giá</a>
            <a href="{{ route('login') }}" class="w-full bg-primary-600 text-white py-3 rounded-xl font-semibold mt-2 flex justify-center items-center space-x-2">
                <i data-lucide="log-out" class="w-5 h-5"></i>
                <span>Đăng Xuất</span>
            </a>
        </div>
    </div>
</nav>

<main>
    @yield('content')
</main>

<footer class="bg-gray-900 text-white py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid md:grid-cols-4 gap-12 mb-12">
            <div>
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center">
                        <i data-lucide="package" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">CourierXpress</h3>
                        <p class="text-xs text-primary-400">LOGISTICS</p>
                    </div>
                </div>
                <p class="text-gray-400 mb-6">Giải pháp logistics toàn diện. Quản lý vận đơn, tra cứu lộ trình dễ dàng hơn bao giờ hết.</p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center hover:bg-primary-600 transition-colors">
                        <i data-lucide="youtube" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6">Dịch vụ</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Giao hàng tiêu chuẩn</a></li>
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Giao hàng hỏa tốc</a></li>
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Kho bãi & Fulfillment</a></li>
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Tích hợp API</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6">Hỗ trợ khách hàng</h4>
                <ul class="space-y-3 text-gray-400">
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Trung tâm trợ giúp</a></li>
                    <li><a href="#tracking" class="hover:text-primary-400 transition-colors">Tra cứu bưu gửi</a></li>
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Quy định khiếu nại</a></li>
                    <li><a href="#" class="hover:text-primary-400 transition-colors">Bảng giá cước</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-bold text-lg mb-6">Liên hệ</h4>
                <ul class="space-y-3 text-gray-400">
                    <li class="flex items-center space-x-3">
                        <i data-lucide="phone" class="w-5 h-5 text-primary-400"></i>
                        <span>1900 9999</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <i data-lucide="mail" class="w-5 h-5 text-primary-400"></i>
                        <span>cskh@courierxpress.vn</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <i data-lucide="map-pin" class="w-5 h-5 text-primary-400 shrink-0 mt-0.5"></i>
                        <span>Tòa nhà Logistics, Q.1, TP.HCM</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
            <p class="text-gray-500 text-sm">© 2024 CourierXpress. Hệ thống quản lý vận đơn trực tuyến.</p>
            <div class="flex space-x-6 mt-4 md:mt-0 text-sm text-gray-500">
                <a href="{{ route('terms') }}" class="hover:text-white transition-colors">Điều khoản dịch vụ</a>
                <a href="{{ route('policy') }}" class="hover:text-white transition-colors">Chính sách bảo mật</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Navbar scroll effect
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-md');
        } else {
            navbar.classList.remove('shadow-md');
        }
    });

    // Scroll reveal animation
    const scrollRevealElements = document.querySelectorAll('.scroll-reveal');

    const revealOnScroll = () => {
        scrollRevealElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (elementTop < windowHeight - 100) {
                element.classList.add('active');
            }
        });
    };

    window.addEventListener('scroll', revealOnScroll);
    revealOnScroll(); // Initial check

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Close mobile menu if open
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>
</body>
</html>
