<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Agent Panel') - CourierXpress</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: { 50: '#fef2f2', 100: '#fee2e2', 500: '#ef4444', 600: '#dc2626', 700: '#b91c1c' }
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-gray-50 min-h-screen flex flex-col">

<div class="flex flex-1 min-h-screen">
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col justify-between shrink-0">
        <div>
            <div class="p-6 border-b border-gray-100">
                <a href="{{ route('agent.orders.index') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-md">
                        <i data-lucide="package" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900 leading-none">CourierXpress</h1>
                        <p class="text-[0.6rem] text-primary-600 font-bold tracking-[0.15em] mt-1">AGENT PORTAL</p>
                    </div>
                </a>
            </div>

            <div class="p-4 space-y-6">
                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">Tổng quan</span>
                    <a href="{{ route('agent.orders.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ request()->routeIs('agent.orders.index') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i><span>Dashboard</span>
                    </a>
                </div>
                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">Quản lý bưu cục</span>
                    <div class="space-y-1">
                        <a href="{{ route('agent.orders.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ request()->is('agent/orders*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <i data-lucide="file-text" class="w-4 h-4"></i><span>Đơn hàng của tôi</span>
                        </a>
                        <a href="{{ route('agent.couriers.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ request()->routeIs('agent.couriers.index') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <i data-lucide="truck" class="w-4 h-4"></i><span>Tra cứu Courier</span>
                        </a>
                        <a href="{{ route('agent.customers.index') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all {{ request()->is('agent/customers*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <i data-lucide="users" class="w-4 h-4"></i><span>Khách hàng</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 border-t border-gray-100">
            <form method="POST" action="{{ route('agent.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-sm text-red-600 hover:bg-red-50 transition-all">
                    <i data-lucide="log-out" class="w-4 h-4"></i><span>Đăng xuất</span>
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-16 bg-white border-b border-gray-200 px-6 flex items-center justify-between shrink-0">
            <div class="flex items-center space-x-2 text-gray-700 font-semibold text-sm">
                <i data-lucide="shield-check" class="w-4 h-4 text-primary-600"></i><span>Agent Portal</span>
            </div>
            <div class="flex items-center space-x-3">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-900 leading-none">{{ Auth::guard('agent')->user()->FullName ?? 'Đại lý' }}</p>
                    <span class="text-[0.65rem] font-bold text-primary-600 uppercase tracking-wider mt-1 inline-block">Active</span>
                </div>
                <div class="w-10 h-10 rounded-xl bg-primary-100 text-primary-700 flex items-center justify-center font-bold text-sm shadow-inner">
                    {{ strtoupper(substr(Auth::guard('agent')->user()->FullName ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="flex-1 p-6 md:p-8 overflow-y-auto max-w-7xl w-full mx-auto">
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl flex items-start">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 mr-3 mt-0.5 shrink-0"></i>
                    <p class="text-sm text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl flex items-start">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500 mr-3 mt-0.5 shrink-0"></i>
                    <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>lucide.createIcons();</script>
</body>
</html>
