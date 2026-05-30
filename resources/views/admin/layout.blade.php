<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Admin') | CourierXpress</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/fonts/remixicon/remixicon.css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />

    @stack('styles')
</head>

<body class="font-sans text-gray-800 bg-gray-50 min-h-screen flex flex-col">
    <div class="flex flex-1 min-h-screen">

        <!-- ===== SIDEBAR MENU ===== -->
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col shrink-0">
            <div class="p-6 border-b border-gray-100">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 no-underline">
                    <div class="w-10 h-10 bg-red-600 rounded-xl flex items-center justify-center text-white shadow-md shrink-0">
                        <i data-lucide="package" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900 leading-none">CourierXpress</h1>
                        <p class="text-[0.6rem] text-red-600 font-bold tracking-[0.15em] mt-1">ADMIN</p>
                    </div>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <div class="p-4 space-y-6">

                <!-- Dashboard -->
                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">Tổng quan</span>
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all
                              {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">Quản lý bưu cục</span>
                    <div class="space-y-1">
                        <a href="{{ route('admin.orders.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all
                                  {{ request()->routeIs('admin.orders.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                            <span>Quản Lý Đơn Hàng </span>
                        </a>
                        {{-- Khách Hàng --}}
                        <a href="{{ route('admin.customers.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all
                                  {{ request()->routeIs('admin.customers.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            <span>Quản Lý Khách Hàng</span>
                        </a>
                    </div>
                </div>

                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">Quản lý Agent</span>
                    <a href="{{ route('admin.agents.index') }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all
                                  {{ request()->routeIs('admin.agents.*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                        <i data-lucide="users" class="w-4 h-4"></i>
                        <span>Quản Lý Agent</span>
                    </a>
                </div>

                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">User Account</span>
                    <a href="{{ route('admin.account') }} "
                       class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-sm transition-all
                                  {{ request()->routeIs('admin.account') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:text-red-600 hover:bg-red-50' }}">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                        <span>User Account</span>
                    </a>
                </div>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{-- Agent info --}}
                <div class="flex items-center gap-3 px-3 py-2 mb-2">
                    <div class="flex items-center space-x-2 text-sm font-medium text-gray-600">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        <span class="hidden sm:inline font-bold ">{{ Auth::guard('admin')->user()->user_name }}</span>
                    </div>
                </div>

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-sm text-red-600 hover:bg-red-50 transition-all">
                        <i data-lucide="log-out" class="w-4 h-4"></i>
                        <span>Đăng xuất</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-16 bg-white border-b border-gray-200 px-6 flex items-center justify-between shrink-0">
                <div class="flex items-center space-x-2 text-gray-700 font-semibold text-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 text-primary-600"></i>
                    <span>Admin Portal</span>
                </div>

                {{-- Mobile user --}}
                <div class="flex items-center space-x-2 text-sm font-medium text-gray-600">
                    <i data-lucide="user" class="w-4 h-4"></i>
                    <span class="hidden sm:inline">{{ Auth::guard('admin')->user()->user_name }}</span>
                </div>
            </header>

            <!-- /Navbar -->

            <!-- Content wrapper -->
            <div class="flex-1 p-6">
                @yield('content')
            </div>
            <!-- /Content wrapper -->
        </div>
        <!-- /Layout page -->
    </div>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
    <script>lucide.createIcons();</script>
@stack('scripts')
</body>
</html>
