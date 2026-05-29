@extends('agent.layout')

@section('title', 'Chi tiết ' . $order->tracking_id)

@section('content')
    <div class="space-y-5">

        {{-- ── Header bar ──────────────────────────────────── --}}
        <div class="flex items-center gap-4 flex-wrap">
            <a href="{{ route('agent.orders.index') }}"
               class="w-9 h-9 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-gray-900 hover:shadow-sm transition-all flex-shrink-0">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>

            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2.5 flex-wrap">
                    <h2 class="text-xl font-bold text-gray-950 font-mono tracking-wide">{{ $order->tracking_id }}</h2>
                    @php
                        $statusCfg = [
                            'assigned'   => ['label'=>'Chờ nhận',  'cls'=>'bg-amber-100 text-amber-700 border-amber-200',  'dot'=>'bg-amber-500',  'pulse'=>true],
                            'in_transit' => ['label'=>'Đang giao', 'cls'=>'bg-blue-100 text-blue-700 border-blue-200',      'dot'=>'bg-blue-500',   'pulse'=>true],
                            'delivered'  => ['label'=>'Đã giao',   'cls'=>'bg-emerald-100 text-emerald-700 border-emerald-200','dot'=>'bg-emerald-500','pulse'=>false],
                        ];
                        $sc = $statusCfg[$order->status] ?? ['label'=>$order->status,'cls'=>'bg-gray-100 text-gray-600 border-gray-200','dot'=>'bg-gray-400','pulse'=>false];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border {{ $sc['cls'] }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $sc['dot'] }} {{ $sc['pulse'] ? 'animate-pulse' : '' }}"></span>
                    {{ $sc['label'] }}
                </span>
                </div>
                <p class="text-gray-400 text-xs mt-0.5 flex items-center gap-1">
                    <i data-lucide="clock" class="w-3 h-3"></i>
                    Tạo lúc {{ $order->created_at->format('H:i — d/m/Y') }}
                </p>
            </div>

            {{-- Action buttons --}}
            <div class="flex items-center gap-2 flex-shrink-0">
                @if($order->status == 'assigned')
                    <form action="{{ route('agent.orders.accept', $order->id) }}" method="POST">
                        @csrf
                        <button class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold rounded-xl transition-all active:scale-95 shadow-lg shadow-amber-200">
                            <i data-lucide="check-circle" class="w-4 h-4"></i> Nhận đơn
                        </button>
                    </form>
                @elseif($order->status == 'in_transit')
                    <form action="{{ route('agent.orders.complete', $order->id) }}" method="POST">
                        @csrf
                        <button class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl transition-all active:scale-95 shadow-lg shadow-emerald-200">
                            <i data-lucide="package-check" class="w-4 h-4"></i> Hoàn thành giao hàng
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- ── 3-column grid ────────────────────────────────── --}}
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">

            {{-- ── CỘT TRÁI: Người gửi + Người nhận (chiếm 2/3) ── --}}
            <div class="xl:col-span-2 space-y-4">

                {{-- Người gửi --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-3 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                        <div class="w-6 h-6 bg-gray-200 rounded-md flex items-center justify-center">
                            <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-gray-600"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Người gửi</span>
                    </div>
                    <div class="p-5 grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $order->sender_name }}</p>

                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                <i data-lucide="phone" class="w-3 h-3 text-green-500"></i>
                                {{ $order->sender_phone ?? 'Chưa có SĐT' }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <i data-lucide="map-pin" class="w-3 h-3"></i>
                                {{ $order->sender_address }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Connector --}}
                <div class="flex items-center gap-3 px-2">
                    <div class="flex-1 h-px bg-gradient-to-r from-gray-100 via-primary-200 to-gray-100"></div>
                    <div class="flex items-center gap-1.5 px-3 py-1.5 bg-primary-600 text-white rounded-full text-[0.6rem] font-bold uppercase tracking-wider shadow-md shadow-primary-200 flex-shrink-0">
                        <i data-lucide="arrow-down" class="w-3 h-3"></i> Giao đến
                    </div>
                    <div class="flex-1 h-px bg-gradient-to-l from-gray-100 via-primary-200 to-gray-100"></div>
                </div>

                {{-- Người nhận --}}
                <div class="bg-white rounded-2xl border border-primary-200 shadow-sm overflow-hidden ring-1 ring-primary-100">
                    <div class="px-5 py-3 bg-gradient-to-r from-primary-50 to-white border-b border-primary-100 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 bg-primary-600 rounded-md flex items-center justify-center">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-white"></i>
                            </div>
                            <span class="text-xs font-bold text-primary-600 uppercase tracking-wider">Người nhận</span>
                        </div>
                        <span class="text-[0.6rem] font-bold text-primary-400 bg-primary-50 border border-primary-100 px-2 py-0.5 rounded-full uppercase tracking-wider">Điểm đến</span>
                    </div>
                    <div class="p-5 grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $order->receiver_name }}</p>

                            <p class="text-xs text-gray-500 mt-1 flex items-center gap-1">
                                <i data-lucide="phone" class="w-3 h-3 text-red-500"></i>
                                {{ $order->receiver_phone ?? 'Chưa có SĐT' }}
                            </p>

                            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1">
                                <i data-lucide="map-pin" class="w-3 h-3"></i>
                                {{ $order->receiver_address }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── CỘT PHẢI: Thông số + Timeline ── --}}
            <div class="space-y-4">

                {{-- Thông số kiện hàng --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-3 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                        <div class="w-6 h-6 bg-gray-200 rounded-md flex items-center justify-center">
                            <i data-lucide="package" class="w-3.5 h-3.5 text-gray-600"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Thông số kiện hàng</span>
                    </div>
                    <div class="divide-y divide-gray-50">
                        <div class="flex items-center justify-between px-5 py-3 text-sm">
                        <span class="text-gray-400 font-medium flex items-center gap-1.5">
                            <i data-lucide="scan-barcode" class="w-3.5 h-3.5"></i> Mã vận đơn
                        </span>
                            <span class="font-bold text-gray-900 font-mono text-xs bg-gray-50 px-2 py-1 rounded-lg border border-gray-200">{{ $order->tracking_id }}</span>
                        </div>
                        <div class="flex items-center justify-between px-5 py-3 text-sm">
                        <span class="text-gray-400 font-medium flex items-center gap-1.5">
                            <i data-lucide="scale" class="w-3.5 h-3.5"></i> Khối lượng
                        </span>
                            <span class="font-bold text-gray-900">{{ $order->total_weight }} kg</span>
                        </div>
                        <div class="flex items-center justify-between px-5 py-3 text-sm">
                        <span class="text-gray-400 font-medium flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i> Ngày tạo
                        </span>
                            <span class="font-semibold text-gray-700 text-xs">{{ $order->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between px-5 py-3 text-sm">
                        <span class="text-gray-400 font-medium flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-3.5 h-3.5"></i> Giờ tạo
                        </span>
                            <span class="font-semibold text-gray-700 text-xs">{{ $order->created_at->format('H:i:s') }}</span>
                        </div>
                        <div class="flex items-center justify-between px-5 py-3 text-sm">
                        <span class="text-gray-400 font-medium flex items-center gap-1.5">
                            <i data-lucide="user-circle" class="w-3.5 h-3.5"></i> Tài khoản
                        </span>
                            @if($order->customer)
                                <a href="{{ route('agent.customers.show', $order->customer->id) }}"
                                   class="font-bold text-primary-600 hover:underline text-xs flex items-center gap-1">
                                    {{ $order->customer->full_name }}
                                    <i data-lucide="external-link" class="w-3 h-3"></i>
                                </a>
                            @else
                                <span class="text-gray-400 text-xs">N/A</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Hành trình đơn hàng --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-3 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                        <div class="w-6 h-6 bg-gray-200 rounded-md flex items-center justify-center">
                            <i data-lucide="route" class="w-3.5 h-3.5 text-gray-600"></i>
                        </div>
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-wider">Hành trình đơn hàng</span>
                    </div>
                    <div class="p-5">
                        @php
                            $stages = [
                                ['key'=>'assigned',   'label'=>'Đã phân công', 'sub'=>'Đơn được bàn giao cho bưu cục', 'icon'=>'clipboard-check',
                                 'done'=> in_array($order->status,['assigned','in_transit','delivered'])],
                                ['key'=>'in_transit', 'label'=>'Đang vận chuyển','sub'=>'Shipper đã nhận và đang giao','icon'=>'truck',
                                 'done'=> in_array($order->status,['in_transit','delivered'])],
                                ['key'=>'delivered',  'label'=>'Giao thành công','sub'=>'Người nhận đã nhận hàng',    'icon'=>'package-check',
                                 'done'=> $order->status=='delivered'],
                            ];
                        @endphp
                        <div class="space-y-1">
                            @foreach($stages as $i => $stage)
                                <div class="flex gap-3 {{ !$loop->last ? 'pb-1' : '' }}">
                                    {{-- Icon + line --}}
                                    <div class="flex flex-col items-center flex-shrink-0">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                                        {{ $stage['done'] ? 'bg-primary-600 shadow-md shadow-primary-200' : 'bg-gray-100' }}">
                                            <i data-lucide="{{ $stage['icon'] }}" class="w-3.5 h-3.5 {{ $stage['done'] ? 'text-white' : 'text-gray-400' }}"></i>
                                        </div>
                                        @if(!$loop->last)
                                            <div class="w-px flex-1 mt-1 mb-1 min-h-[16px] {{ $stage['done'] ? 'bg-primary-200' : 'bg-gray-100' }}"></div>
                                        @endif
                                    </div>
                                    {{-- Text --}}
                                    <div class="pt-1 pb-3 min-w-0">
                                        <p class="text-sm font-bold {{ $stage['done'] ? 'text-gray-900' : 'text-gray-400' }}">{{ $stage['label'] }}</p>
                                        <p class="text-xs {{ $stage['done'] ? 'text-gray-500' : 'text-gray-300' }} mt-0.5">{{ $stage['sub'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
