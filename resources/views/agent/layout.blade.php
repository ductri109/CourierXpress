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

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col justify-between shrink-0">
        <div>
            {{-- Logo --}}
            <div class="p-6 border-b border-gray-100">
                <a href="{{ route('agent.dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center text-white shadow-md">
                        <i data-lucide="package" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900 leading-none">CourierXpress</h1>
                        <p class="text-[0.6rem] text-primary-600 font-bold tracking-[0.15em] mt-1">AGENT PORTAL</p>
                    </div>
                </a>
            </div>

            {{-- Nav --}}
            <div class="p-4 space-y-6">

                {{-- Tổng quan --}}
                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">Tổng quan</span>
                    <a href="{{ route('agent.dashboard') }}"
                       class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all
                              {{ request()->routeIs('agent.dashboard') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                {{-- Quản lý bưu cục --}}
                <div>
                    <span class="px-3 text-[0.7rem] font-bold text-gray-400 uppercase tracking-wider block mb-2">Quản lý bưu cục</span>
                    <div class="space-y-1">
                        <a href="{{ route('agent.orders.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all
                                  {{ request()->is('agent/orders*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <i data-lucide="file-text" class="w-4 h-4"></i>
                            <span>Quản Lý Đơn Hàng </span>
                        </a>
                        {{-- Khách Hàng --}}
                        <a href="{{ route('agent.customers.index') }}"
                           class="flex items-center space-x-3 px-3 py-2.5 rounded-xl font-medium text-sm transition-all
                                  {{ request()->is('agent/customers*') ? 'bg-primary-50 text-primary-600 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            <span>Quản Lý Khách Hàng</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- User info + Logout --}}
        <div class="p-4 border-t border-gray-100">
            {{-- Agent info --}}
            <div class="flex items-center gap-3 px-3 py-2 mb-2">
                <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center shrink-0">
                    <span class="text-primary-700 font-bold text-xs">
                        {{ strtoupper(substr(Auth::guard('agent')->user()->FullName ?? 'A', 0, 1)) }}
                    </span>
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::guard('agent')->user()->FullName ?? '' }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ Auth::guard('agent')->user()->Email ?? '' }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('agent.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2.5 rounded-xl font-semibold text-sm text-red-600 hover:bg-red-50 transition-all">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Đăng xuất</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ===== MAIN ===== --}}
    <div class="flex-1 flex flex-col min-w-0">

        {{-- Header --}}
        <header class="h-16 bg-white border-b border-gray-200 px-6 flex items-center justify-between shrink-0">
            <div class="flex items-center space-x-2 text-gray-700 font-semibold text-sm">
                <i data-lucide="shield-check" class="w-4 h-4 text-primary-600"></i>
                <span>Agent Portal</span>
            </div>

            {{-- Alert đơn chờ nhận --}}
            @php
                $pendingCount = \App\Models\Courier::where('agent_id', Auth::guard('agent')->id())->where('status', 'assigned')->count();
            @endphp
            @if($pendingCount > 0)
                <a href="{{ route('agent.orders.index') }}" class="flex items-center gap-2 bg-amber-50 border border-amber-200 text-amber-700 text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-amber-100 transition">
                    <i data-lucide="bell" class="w-3.5 h-3.5"></i>
                    {{ $pendingCount }} đơn chờ bạn nhận
                </a>
            @endif

            {{-- Mobile user --}}
            <div class="flex items-center space-x-2 text-sm font-medium text-gray-600">
                <i data-lucide="user" class="w-4 h-4"></i>
                <span class="hidden sm:inline">{{ Auth::guard('agent')->user()->FullName ?? '' }}</span>
            </div>
        </header>

        {{-- Flash messages --}}
        <div class="px-6 pt-4">
            @if(session('success'))
                <div class="flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium px-4 py-3 rounded-xl mb-4">
                    <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="flex items-center gap-2 bg-red-50 border border-red-200 text-red-700 text-sm font-medium px-4 py-3 rounded-xl mb-4">
                    <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                    {{ session('error') }}
                </div>
            @endif
        </div>

        {{-- Content --}}
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>
</div>

<script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
<script>lucide.createIcons();</script>

</body>
</html>
