@extends('agent.layout')

@section('title', 'Hồ sơ khách hàng #' . $customer->id)

@section('content')
    <div class="space-y-5">
        {{-- Header --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('agent.customers.index') }}"
               class="w-9 h-9 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-gray-900 hover:shadow-sm transition-all flex-shrink-0">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-950">Hồ sơ khách hàng: {{ $customer->full_name }}</h2>
                <p class="text-gray-400 text-sm mt-0.5">Xem lịch sử vận đơn bưu cục liên kết chi tiết.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Card khách hàng --}}
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden h-fit">
                {{-- Top --}}
                <div class="flex flex-col items-center text-center px-6 pt-7 pb-5">
                    <div class="w-16 h-16 rounded-2xl bg-primary-100 text-primary-700 flex items-center justify-center font-extrabold text-2xl shadow-inner mb-3">
                        {{ strtoupper(substr($customer->full_name ?? 'C', 0, 1)) }}
                    </div>
                    <span class="text-[0.65rem] font-bold text-primary-600 bg-primary-50 border border-primary-100 px-2.5 py-0.5 rounded-full mb-1.5">Mã đối tác: #{{ $customer->id }}</span>
                    <h4 class="text-lg font-bold text-gray-900">{{ $customer->full_name }}</h4>
                </div>

                {{-- Thông tin liên hệ --}}
                @php $addr = $customer->address ?: ($orders->first()->sender_address ?? null); @endphp
                <div class="border-t border-gray-100 px-5 py-4 space-y-3">
                    <div class="flex items-center gap-3 text-sm">
                        <div class="w-7 h-7 bg-gray-50 border border-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-lucide="phone" class="w-3.5 h-3.5 text-gray-500"></i>
                        </div>
                        <span class="text-gray-700 font-semibold">{{ $customer->phone ?? '—' }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm">
                        <div class="w-7 h-7 bg-gray-50 border border-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-gray-500"></i>
                        </div>
                        <span class="text-gray-600 text-xs truncate">{{ $customer->email ?? '—' }}</span>
                    </div>
                    <div class="flex items-start gap-3 text-sm">
                        <div class="w-7 h-7 bg-gray-50 border border-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-500"></i>
                        </div>
                        <span class="text-gray-600 text-xs leading-snug">{{ $addr ?? '—' }}</span>
                    </div>
                </div>

                {{-- Tổng đơn --}}
                <div class="border-t border-gray-100 px-5 py-3">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-400 font-medium">Tổng vận đơn</span>
                        <span class="font-bold text-primary-600 bg-primary-50 border border-primary-100 px-2.5 py-0.5 rounded-full text-xs">{{ $orders->count() }} đơn</span>
                    </div>
                </div>
            </div>

            {{-- Lịch sử vận đơn --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                    <div class="w-6 h-6 bg-gray-100 rounded-md flex items-center justify-center">
                        <i data-lucide="history" class="w-3.5 h-3.5 text-gray-500"></i>
                    </div>
                    <h4 class="font-bold text-gray-900">Lịch sử vận đơn bưu cục</h4>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">
                            <th class="px-5 py-3.5">Mã vận đơn</th>
                            <th class="px-5 py-3.5">Người nhận</th>
                            <th class="px-5 py-3.5 text-center">Trọng lượng</th>
                            <th class="px-5 py-3.5 text-center">Trạng thái</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                        @forelse($orders as $order)
                            @php
                                $sm = [
                                    'assigned'   => ['label'=>'Chờ nhận',  'bg'=>'bg-amber-100',   'text'=>'text-amber-700',   'dot'=>'bg-amber-500',   'pulse'=>true],
                                    'in_transit' => ['label'=>'Đang giao', 'bg'=>'bg-blue-100',    'text'=>'text-blue-700',    'dot'=>'bg-blue-500',    'pulse'=>true],
                                    'delivered'  => ['label'=>'Đã giao',   'bg'=>'bg-emerald-100', 'text'=>'text-emerald-700', 'dot'=>'bg-emerald-500', 'pulse'=>false],
                                ][$order->status] ?? ['label'=>$order->status,'bg'=>'bg-gray-100','text'=>'text-gray-600','dot'=>'bg-gray-400','pulse'=>false];
                            @endphp
                            <tr class="hover:bg-gray-50/60 transition-colors">
                                <td class="px-5 py-3.5">
                                    <span class="font-bold text-gray-900 font-mono tracking-wide">{{ $order->tracking_id }}</span>
                                </td>
                                <td class="px-5 py-3.5 text-gray-600">{{ $order->receiver_name }}</td>
                                <td class="px-5 py-3.5 text-center text-gray-600">{{ $order->total_weight }} kg</td>
                                <td class="px-5 py-3.5 text-center">
                                    <span class="inline-flex items-center justify-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider {{ $sm['bg'] }} {{ $sm['text'] }}">
                                        <span class="w-1.5 h-1.5 rounded-full {{ $sm['dot'] }} {{ $sm['pulse'] ? 'animate-pulse' : '' }}"></span>
                                        {{ $sm['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-14 text-center">
                                    <i data-lucide="package-x" class="w-10 h-10 text-gray-200 mx-auto mb-2"></i>
                                    <p class="text-sm text-gray-400 font-medium">Chưa phát sinh đơn hàng nào.</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
