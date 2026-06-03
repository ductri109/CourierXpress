@extends('customer.layout')

@section('title', 'My Orders - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto px-4">

            {{-- Breadcrumb --}}
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
                <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-primary-600 font-medium">My orders</span>
            </div>

            {{-- Toast --}}
            @if(session('success'))
                <div id="toast-success" class="fixed bottom-5 right-5 z-50 transform transition-all duration-500 translate-y-20 opacity-0">
                    <div class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-2xl shadow-2xl border border-gray-100">
                        <div class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10 text-green-500 bg-green-100 rounded-xl">
                            <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                        </div>
                        <div class="ml-3 text-sm font-bold text-gray-800">{{ session('success') }}</div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const toast = document.getElementById('toast-success');
                        setTimeout(() => { toast.classList.remove('translate-y-20', 'opacity-0'); toast.classList.add('translate-y-0', 'opacity-100'); }, 100);
                        setTimeout(() => { toast.classList.add('opacity-0', 'translate-y-2'); setTimeout(() => toast.remove(), 500); }, 3500);
                    });
                </script>
            @endif

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">

                {{-- Header --}}
                <div class="gradient-bg p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="text-left">
                            <h2 class="text-3xl font-extrabold tracking-tight">My Orders</h2>
                            <p class="text-white/80 mt-2 font-medium">Track all the orders you have created</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-center bg-white/10 backdrop-blur-sm rounded-2xl px-6 py-3 border border-white/20">
                                <p class="text-2xl font-extrabold">{{ $orders->total() }}</p>
                                <p class="text-white/70 text-xs font-medium uppercase tracking-wider">Total Orders</p>
                            </div>
                            <a href="{{ route('booking') }}" class="flex items-center space-x-2 bg-white text-primary-600 px-5 py-3 rounded-2xl font-bold hover:bg-primary-50 transition-all shadow-lg">
                                <i data-lucide="plus-circle" class="w-5 h-5"></i>
                                <span>Create New Order</span>
                            </a>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                {{-- Stats Bar --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-px bg-gray-100 border-b border-gray-100">
                    @php
                        $statusConfig = [
                            'pending'    => ['label' => 'Pending',     'color' => 'yellow', 'icon' => 'clock'],
                            'assigned'   => ['label' => 'Assigned',    'color' => 'blue',   'icon' => 'user-check'],
                            'in_transit' => ['label' => 'In Transit',  'color' => 'indigo', 'icon' => 'truck'],
                            'delivered'  => ['label' => 'Delivered',   'color' => 'green',  'icon' => 'package-check'],
                            'failed'     => ['label' => 'Failed',      'color' => 'red',    'icon' => 'x-circle'],
                        ];
                        $statColors = [
                            'yellow' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600', 'icon' => 'text-yellow-400'],
                            'blue'   => ['bg' => 'bg-blue-50',   'text' => 'text-blue-600',   'icon' => 'text-blue-400'],
                            'indigo' => ['bg' => 'bg-indigo-50', 'text' => 'text-indigo-600', 'icon' => 'text-indigo-400'],
                            'green'  => ['bg' => 'bg-green-50',  'text' => 'text-green-600',  'icon' => 'text-green-400'],
                            'red'    => ['bg' => 'bg-red-50',    'text' => 'text-red-600',    'icon' => 'text-red-400'],
                        ];
                        $paymentConfig = [
                             'cod' => [
                              'label' => 'COD',
                            'name' => 'Cash on Delivery',
                            'badge' => 'bg-orange-100 text-orange-700 border-orange-200',
                            'icon' => 'banknote',
                        ],
                        ];

                        $paymentStatusConfig = [
                        'unpaid' => [
                        'label' => 'Unpaid',
                        'badge' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                        ],
                        'paid' => [
                        'label' => 'Paid',
                        'badge' => 'bg-green-100 text-green-700 border-green-200',
                        ],
                        'failed' => [
                        'label' => 'Payment Error',
                        'badge' => 'bg-red-100 text-red-700 border-red-200',
                        ],
                        ];
                    @endphp

                    @foreach(['pending', 'in_transit', 'delivered', 'failed'] as $s)
                        @php $cfg = $statusConfig[$s]; $col = $statColors[$cfg['color']]; @endphp
                        <div class="bg-white p-5 flex items-center space-x-3">
                            <div class="p-2.5 {{ $col['bg'] }} rounded-xl">
                                <i data-lucide="{{ $cfg['icon'] }}" class="w-5 h-5 {{ $col['icon'] }}"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-gray-800">{{ $statusCounts[$s] ?? 0 }}</p>
                                <p class="text-xs text-gray-500 font-medium">{{ $cfg['label'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Filter & Search --}}
                <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                    <form method="GET" action="{{ route('customer.orders.index') }}" class="flex flex-col md:flex-row gap-3">
                        {{-- Search --}}
                        <div class="relative flex-1">
                            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                            <input type="text" name="search" value="{{ request('search') }}"
                                   placeholder="Search by tracking ID, receiver..."
                                   class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:border-primary-400 focus:outline-none focus:ring-2 focus:ring-primary-50 bg-white transition-all">
                        </div>

                        {{-- Status Filter --}}
                        <select name="status" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 focus:border-primary-400 focus:outline-none bg-white min-w-[160px]">
                            <option value="">All Statuses</option>
                            @foreach($statusConfig as $val => $cfg)
                                <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>{{ $cfg['label'] }}</option>
                            @endforeach
                        </select>

                        {{-- Sort --}}
                        <select name="sort" class="px-4 py-2.5 border border-gray-200 rounded-xl text-sm text-gray-600 focus:border-primary-400 focus:outline-none bg-white min-w-[160px]">
                            <option value="newest" {{ request('sort','newest') == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                        </select>

                        <button type="submit" class="px-5 py-2.5 gradient-bg text-white rounded-xl text-sm font-semibold hover:opacity-90 transition-all flex items-center space-x-2 whitespace-nowrap">
                            <i data-lucide="filter" class="w-4 h-4"></i>
                            <span>Filter</span>
                        </button>

                        @if(request()->hasAny(['search','status','sort']))
                            <a href="{{ route('customer.orders.index') }}" class="px-5 py-2.5 bg-gray-200 text-gray-600 rounded-xl text-sm font-semibold hover:bg-gray-300 transition-all flex items-center space-x-2 whitespace-nowrap">
                                <i data-lucide="x" class="w-4 h-4"></i>
                                <span>Clear Filter</span>
                            </a>
                        @endif
                    </form>
                </div>

                {{-- Orders List --}}
                <div class="divide-y divide-gray-50">
                    @forelse($orders as $order)
                        @php
                            $s = $order->status;
                            $cfg = $statusConfig[$s] ?? ['label' => $s, 'color' => 'yellow', 'icon' => 'help-circle'];
                            $col = $statColors[$cfg['color']] ?? $statColors['yellow'];

                            $badgeClass = [
                                'pending'    => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                'assigned'   => 'bg-blue-100 text-blue-700 border-blue-200',
                                'in_transit' => 'bg-indigo-100 text-indigo-700 border-indigo-200',
                                'delivered'  => 'bg-green-100 text-green-700 border-green-200',
                                'failed'     => 'bg-red-100 text-red-700 border-red-200',
                            ][$s] ?? 'bg-gray-100 text-gray-700 border-gray-200';

                            $paymentMethod = $order->payment_method ?? 'cod';
                           $paymentStatus = $order->status === 'delivered'
                                 ? 'paid'
                                     : ($order->payment_status ?? 'unpaid');

                            $payCfg = $paymentConfig[$paymentMethod] ?? $paymentConfig['cod'];
                            $payStatusCfg = $paymentStatusConfig[$paymentStatus] ?? $paymentStatusConfig['unpaid'];
                        @endphp

                        <div class="p-6 hover:bg-primary-50/30 transition-all group">
                            <div class="grid grid-cols-1 xl:grid-cols-[260px_1fr_360px] gap-6 items-center">

                                {{-- Left: Tracking ID + Status --}}
                                <div class="flex items-start gap-4 min-w-0">
                                    <div class="p-3 {{ $col['bg'] }} rounded-2xl shrink-0 group-hover:scale-105 transition-transform">
                                        <i data-lucide="{{ $cfg['icon'] }}" class="w-6 h-6 {{ $col['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center flex-wrap gap-2 mb-1">
                                            <span class="font-mono font-extrabold text-gray-900 text-base tracking-wide">{{ $order->tracking_id }}</span>
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $badgeClass }}">
                                            {{ $cfg['label'] }}
                                        </span>
                                        </div>
                                        <p class="text-sm text-gray-500">
                                            <i data-lucide="calendar" class="inline w-3.5 h-3.5 mr-1"></i>
                                            Created at {{ $order->created_at->format('H:i - d/m/Y') }}
                                        </p>

                                        <div class="flex flex-wrap items-center gap-2 mt-3">
                                            {{-- Payment Method --}}
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $payCfg['badge'] }}">
                                                  <i data-lucide="{{ $payCfg['icon'] }}" class="w-3.5 h-3.5"></i>
                                                          {{ $payCfg['label'] }}
                                             </span>

                                            {{-- COD Amount --}}
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border bg-orange-100 text-orange-700 border-orange-200 whitespace-nowrap">
                                                     {{ number_format($order->cod_amount ?? 0, 0, ',', '.') }} VNĐ
                                             </span>

                                            {{-- Payment Status --}}
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold border {{ $payStatusCfg['badge'] }}">
                                                     {{ $payStatusCfg['label'] }}
                                              </span>
                                        </div>

                                    </div>
                                </div>

                                {{-- Center: Sender → Receiver --}}
                                <div class="grid grid-cols-[1fr_80px_1fr] items-center gap-4 min-w-0">
                                    <div class="text-right min-w-0">
                                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-0.5">Sender</p>
                                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $order->sender_name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Str::limit($order->sender_address, 28) }}</p>
                                    </div>

                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-full h-px bg-gray-200 relative">
                                            <div class="absolute -top-1 right-0">
                                                <i data-lucide="chevron-right" class="w-3 h-3 text-primary-400"></i>
                                            </div>
                                        </div>
                                        <span class="text-xs text-gray-400 mt-1 whitespace-nowrap">{{ $order->total_weight }}kg</span>
                                    </div>

                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-400 font-medium uppercase tracking-wider mb-0.5">Receiver</p>
                                        <p class="font-semibold text-gray-800 text-sm truncate">{{ $order->receiver_name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Str::limit($order->receiver_address, 28) }}</p>
                                    </div>
                                </div>

                                {{-- Right: Copy Tracking + Actions --}}
                                <div class="flex flex-wrap xl:flex-nowrap items-center justify-end gap-2 shrink-0">
                                    <button onclick="copyTracking('{{ $order->tracking_id }}')"
                                            class="h-9 inline-flex items-center space-x-1.5 px-3 border border-gray-200 text-gray-500 rounded-xl text-xs font-semibold hover:border-primary-300 hover:text-primary-600 hover:bg-primary-50 transition-all whitespace-nowrap"
                                            title="Copy Tracking ID">
                                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                        <span>Copy</span>
                                    </button>

                                    <a href="{{ route('customer.booking.bill', $order->id) }}"
                                       target="_blank"
                                       class="h-9 inline-flex items-center space-x-1.5 px-3 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition-all shadow-sm whitespace-nowrap">
                                        <i data-lucide="printer" class="w-3.5 h-3.5"></i>
                                        <span>Print Bill</span>
                                    </a>

                                    @if($paymentStatus !== 'paid')
                                        <button onclick="openPaymentModal({{ $order->id }})"
                                                class="h-9 inline-flex items-center space-x-1.5 px-3 bg-green-600 text-white rounded-xl text-xs font-bold hover:bg-green-700 transition-all shadow-sm whitespace-nowrap">
                                            <i data-lucide="wallet" class="w-3.5 h-3.5"></i>
                                            <span>Pay Now</span>
                                        </button>
                                    @endif

                                    <button onclick="openDetail({{ $order->id }})"
                                            class="h-9 inline-flex items-center space-x-1.5 px-3 gradient-bg text-white rounded-xl text-xs font-bold hover:opacity-90 transition-all shadow-sm whitespace-nowrap">
                                        <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                        <span>Details</span>
                                    </button>
                                </div>

                            </div>

                            {{-- Progress Bar --}}
                            @if(in_array($s, ['pending', 'assigned', 'in_transit']))
                                @php
                                    $progress = ['pending' => 25, 'assigned' => 55, 'in_transit' => 80][$s];
                                @endphp
                                <div class="mt-5 w-full">
                                    <div class="flex justify-between text-xs text-gray-400 mb-1">
                                        <span>Progress</span>
                                        <span>{{ $progress }}%</span>
                                    </div>
                                    <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                        <div class="h-full tracking-line rounded-full" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <div class="flex justify-between mt-2">
                                        @foreach(['Received', 'Assigned', 'In Transit', 'Completed'] as $i => $step)
                                            <span class="text-xs {{ $progress >= ($i+1)*25 ? 'text-primary-600 font-semibold' : 'text-gray-300' }}">{{ $step }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            @elseif($s === 'delivered')
                                <div class="mt-3 ml-14 flex items-center space-x-2 text-green-600 text-xs font-semibold">
                                    <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                                    <span>Order has been delivered successfully!</span>
                                </div>
                            @elseif($s === 'failed')
                                <div class="mt-3 ml-14 flex items-center space-x-2 text-red-500 text-xs font-semibold">
                                    <i data-lucide="alert-circle" class="w-4 h-4"></i>
                                    <span>Delivery failed. Please contact support for assistance.</span>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="py-24 flex flex-col items-center justify-center text-center">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                                <i data-lucide="package-x" class="w-12 h-12 text-gray-300"></i>
                            </div>
                            <h3 class="text-xl font-bold text-gray-400 mb-2">No orders found</h3>
                            <p class="text-gray-400 text-sm mb-8">
                                @if(request()->hasAny(['search','status']))
                                    No orders match your current filter criteria.
                                @else
                                    You haven't created any orders yet. Start now!
                                @endif
                            </p>
                            @if(request()->hasAny(['search','status']))
                                <a href="{{ route('customer.orders.index') }}" class="px-6 py-3 border-2 border-primary-200 text-primary-600 rounded-2xl font-semibold hover:bg-primary-50 transition-all">
                                    Clear Filters
                                </a>
                            @else
                                <a href="{{ route('booking') }}" class="px-8 py-3.5 gradient-bg text-white rounded-2xl font-bold hover:opacity-90 transition-all shadow-lg flex items-center space-x-2">
                                    <i data-lucide="plus-circle" class="w-5 h-5"></i>
                                    <span>Create Your First Order</span>
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if($orders->hasPages())
                    <div class="p-6 border-t border-gray-100 bg-gray-50/50 flex justify-between items-center">
                        <p class="text-sm text-gray-500">
                            Showing <strong>{{ $orders->firstItem() }}</strong> – <strong>{{ $orders->lastItem() }}</strong>
                            of <strong>{{ $orders->total() }}</strong> orders
                        </p>
                        <div class="flex items-center gap-1">
                            {{-- Previous --}}
                            @if($orders->onFirstPage())
                                <span class="px-3 py-2 rounded-xl text-gray-300 bg-gray-100 text-sm cursor-not-allowed">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                                   class="px-3 py-2 rounded-xl text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-all text-sm">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </a>
                            @endif

                            @foreach($orders->getUrlRange(max(1, $orders->currentPage()-2), min($orders->lastPage(), $orders->currentPage()+2)) as $page => $url)
                                <a href="{{ $url }}&{{ http_build_query(request()->except('page')) }}"
                                   class="w-9 h-9 flex items-center justify-center rounded-xl text-sm font-semibold transition-all
                               {{ $page == $orders->currentPage() ? 'gradient-bg text-white shadow-md' : 'text-gray-600 hover:bg-primary-50 hover:text-primary-600' }}">
                                    {{ $page }}
                                </a>
                            @endforeach

                            {{-- Next --}}
                            @if($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}"
                                   class="px-3 py-2 rounded-xl text-gray-600 hover:bg-primary-50 hover:text-primary-600 transition-all text-sm">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </a>
                            @else
                                <span class="px-3 py-2 rounded-xl text-gray-300 bg-gray-100 text-sm cursor-not-allowed">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            {{-- Security Note --}}
            <div class="mt-8 p-6 bg-white rounded-2xl flex items-center justify-between border border-gray-100 shadow-sm">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <i data-lucide="shield-check" class="w-6 h-6 text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Protected Information</p>
                        <p class="text-xs text-gray-500">Your order data is completely encrypted and secure.</p>
                    </div>
                </div>
                <i data-lucide="lock" class="w-5 h-5 text-gray-300"></i>
            </div>
        </div>
    </div>

    {{-- Order Detail Modal --}}
    <div id="orderDetailModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closeDetail()"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all">

                <div class="gradient-bg p-6 text-white relative overflow-hidden">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-extrabold">Waybill Details</h3>
                            <p id="modalTrackingId" class="font-mono font-bold text-white/90 mt-1 text-lg"></p>
                        </div>
                        <button onclick="closeDetail()" class="p-2 bg-white/20 rounded-xl hover:bg-white/30 transition-all">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                </div>

                <div class="p-6 space-y-4" id="modalContent">
                    <div class="flex items-center justify-center py-8">
                        <div class="w-8 h-8 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin"></div>
                    </div>
                </div>

                <div class="p-6 pt-0 border-t border-gray-100">
                    <button onclick="closeDetail()" class="w-full py-3 border-2 border-gray-200 text-gray-600 rounded-2xl font-semibold hover:bg-gray-50 transition-all">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Payment Modal --}}
    <div id="paymentModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="closePaymentModal()"></div>

        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all">

                <div class="gradient-bg p-6 text-white relative overflow-hidden">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-extrabold">Order Payment</h3>
                            <p id="paymentTrackingId" class="font-mono font-bold text-white/90 mt-1 text-lg"></p>
                        </div>

                        <button onclick="closePaymentModal()" class="p-2 bg-white/20 rounded-xl hover:bg-white/30 transition-all">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
                </div>

                <form method="POST" action="{{ route('customer.orders.payment') }}" class="p-6 space-y-4">
                    @csrf

                    <input type="hidden" name="order_id" id="paymentOrderId">

                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Order Information</p>

                        <div class="flex items-center justify-between mt-2">
                            <span class="text-sm text-gray-500">Tracking ID</span>
                            <span id="paymentTrackingText" class="font-mono font-extrabold text-gray-900"></span>
                        </div>

                        <div class="flex items-center justify-between mt-2">
                            <span class="text-sm text-gray-500">Receiver</span>
                            <span id="paymentReceiverName" class="font-bold text-gray-800 text-sm"></span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <span class="text-sm text-gray-500">COD Amount</span>
                        <span id="paymentCodAmount" class="font-extrabold text-green-700 text-base"></span>
                    </div>

                    <div>
                        <p class="text-sm font-extrabold text-gray-900 mb-3">Select Payment Method</p>

                        <label class="block cursor-pointer mb-3">
                            <input type="radio" name="payment_method" value="cod" class="peer hidden" checked>

                            <div class="p-4 rounded-2xl border-2 border-gray-100 peer-checked:border-green-500 peer-checked:bg-green-50 transition-all">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-11 h-11 bg-green-100 rounded-xl flex items-center justify-center">
                                            <i data-lucide="banknote" class="w-6 h-6 text-green-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-extrabold text-gray-900">Cash on Delivery</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Pay cash to the courier upon delivery</p>
                                        </div>
                                    </div>

                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                    COD
                                </span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mt-6">
                        <button type="button"
                                onclick="closePaymentModal()"
                                class="py-3 border-2 border-gray-200 text-gray-600 rounded-2xl font-semibold hover:bg-gray-50 transition-all">
                            Cancel
                        </button>

                        <button type="submit"
                                class="py-3 bg-green-600 text-white rounded-2xl font-bold hover:bg-green-700 transition-all shadow-lg">
                            Confirm
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Copy Toast --}}
    <div id="copyToast" class="fixed bottom-5 left-1/2 -translate-x-1/2 z-50 hidden">
        <div class="flex items-center space-x-2 bg-gray-900 text-white px-5 py-3 rounded-2xl shadow-2xl text-sm font-semibold">
            <i data-lucide="check" class="w-4 h-4 text-green-400"></i>
            <span>Tracking ID copied!</span>
        </div>
    </div>

    {{-- Orders data for JS modal --}}
    <script>
        const ordersData = @json($orders->items());

        const statusConfig = {
            pending:    { label: 'Pending',    badge: 'bg-yellow-100 text-yellow-700', icon: '🕐' },
            assigned:   { label: 'Assigned',   badge: 'bg-blue-100 text-blue-700',     icon: '👤' },
            in_transit: { label: 'In Transit', badge: 'bg-indigo-100 text-indigo-700', icon: '🚚' },
            delivered:  { label: 'Delivered',  badge: 'bg-green-100 text-green-700',   icon: '✅' },
            failed:     { label: 'Failed',     badge: 'bg-red-100 text-red-700',       icon: '❌' },
        };

        function openDetail(id) {
            const order = ordersData.find(o => o.id === id);
            if (!order) return;

            const cfg = statusConfig[order.status] || { label: order.status, badge: 'bg-gray-100 text-gray-700', icon: '📦' };
            const paymentStatusLabel = order.status === 'delivered'
                ? 'Paid'
                : ((order.payment_status || 'unpaid') === 'paid' ? 'Paid' : 'Unpaid');

            const paymentStatusBadge = order.status === 'delivered' || (order.payment_status || 'unpaid') === 'paid'
                ? 'bg-green-100 text-green-700 border-green-200'
                : 'bg-yellow-100 text-yellow-700 border-yellow-200';
            const created = new Date(order.created_at);
            const dateStr = created.toLocaleString('en-US', { day:'2-digit', month:'2-digit', year:'numeric', hour:'2-digit', minute:'2-digit' });

            document.getElementById('modalTrackingId').textContent = order.tracking_id;

            const weight = Number(order.total_weight || 0);
            const shippingFee = Number(order.cod_amount || order.shipping_fee || 0);

            let codAmount = shippingFee;

            if (codAmount <= 0) {
                codAmount = 30000 + (weight * 10000);
            }

            document.getElementById('modalContent').innerHTML = `
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-2xl">
                    <span class="text-sm text-gray-500 font-medium">Status</span>
                    <span class="px-3 py-1.5 rounded-full text-sm font-bold ${cfg.badge}">${cfg.icon} ${cfg.label}</span>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="p-4 bg-primary-50 rounded-2xl border border-primary-100">
                        <p class="text-xs text-primary-500 font-bold uppercase tracking-wider mb-1">Sender</p>
                        <p class="font-bold text-gray-800 text-sm">${order.sender_name}</p>
                        <p class="text-xs text-gray-500 mt-1">${order.sender_address}</p>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mb-1">Receiver</p>
                        <p class="font-bold text-gray-800 text-sm">${order.receiver_name}</p>
                        <p class="text-xs text-gray-500 mt-1">${order.receiver_address}</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="p-4 bg-gray-50 rounded-2xl flex items-center space-x-3">
                        <span class="text-2xl">⚖️</span>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Weight</p>
                            <p class="font-extrabold text-gray-800">${order.total_weight} kg</p>
                        </div>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl flex items-center space-x-3">
                        <span class="text-2xl">📅</span>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Created Date</p>
                            <p class="font-bold text-gray-800 text-sm">${dateStr}</p>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-green-50 rounded-2xl border border-green-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs text-green-600 font-bold uppercase tracking-wider mb-1">
                                COD Payment
                            </p>
                            <p class="text-sm text-gray-500">
                                Amount to pay upon delivery
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-2xl font-extrabold text-green-700">
                                ${codAmount.toLocaleString('vi-VN')} VNĐ
                            </p>
                           <p class="text-xs mt-1 inline-flex px-2 py-1 rounded-full border ${paymentStatusBadge}">
                                 ${paymentStatusLabel}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="p-4 bg-gray-50 rounded-2xl flex items-center justify-between">
                    <span class="text-sm text-gray-500 font-medium">Tracking ID</span>
                    <div class="flex items-center space-x-2">
                        <span class="font-mono font-extrabold text-gray-900">${order.tracking_id}</span>
                        <button onclick="copyTracking('${order.tracking_id}')" class="p-1.5 hover:bg-primary-100 rounded-lg transition-all text-primary-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            `;

            document.getElementById('orderDetailModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            lucide.createIcons();
        }

        function closeDetail() {
            document.getElementById('orderDetailModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function openPaymentModal(id) {
            const order = ordersData.find(o => o.id === id);
            if (!order) return;

            document.getElementById('paymentOrderId').value = order.id;
            document.getElementById('paymentTrackingId').textContent = order.tracking_id;
            document.getElementById('paymentTrackingText').textContent = order.tracking_id;
            document.getElementById('paymentReceiverName').textContent = order.receiver_name;

            document.getElementById('paymentModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            document.getElementById('paymentCodAmount').textContent =
                Number(order.cod_amount || 0).toLocaleString('vi-VN') + ' VNĐ';

            lucide.createIcons();
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
            document.body.style.overflow = '';
        }

        function copyTracking(trackingId) {
            navigator.clipboard.writeText(trackingId).then(() => {
                const toast = document.getElementById('copyToast');
                toast.classList.remove('hidden');
                setTimeout(() => toast.classList.add('hidden'), 2000);
            });
        }

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') {
                closeDetail();
                closePaymentModal();
            }
        });
    </script>
@endsection
