@extends('agent.layout')

@section('title', 'Đơn hàng bưu cục')

@section('content')
    <div class="space-y-5">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-950">Đơn hàng của tôi</h2>
                <p class="text-gray-400 text-sm mt-0.5">Quản lý và xử lý vận đơn được bàn giao từ tổng kho.</p>
            </div>
            <span id="live-clock" class="hidden sm:flex items-center gap-1.5 text-xs font-semibold text-gray-500 bg-white border border-gray-200 px-3 py-2 rounded-xl shadow-sm">
            <i data-lucide="clock" class="w-3.5 h-3.5 text-primary-500"></i>
            <span id="clock-time">--:--:--</span>
        </span>
        </div>

        {{-- Thanh tìm kiếm & lọc --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
            <form method="GET" action="{{ route('agent.orders.index') }}" id="filter-form">
                <div class="flex flex-wrap gap-3 items-end">

                    {{-- Tìm mã vận đơn (realtime) --}}
                    <div class="flex-1 min-w-[180px] relative">
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Mã vận đơn</label>
                        <div class="relative">
                            <i data-lucide="search" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input type="text" name="search" id="search-input" value="{{ request('search') }}"
                                   placeholder="Nhập mã vận đơn..."
                                   autocomplete="off"
                                   class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition-all">
                        </div>
                    </div>

                    {{-- Lọc trạng thái --}}
                    <div class="min-w-[150px]">
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Trạng thái</label>
                        <div class="relative">
                            <i data-lucide="layers" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <select name="status" id="status-select"
                                    class="pl-9 pr-8 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 appearance-none bg-white w-full transition-all">
                                <option value="">Tất cả</option>
                                <option value="assigned"   {{ request('status')=='assigned'   ?'selected':'' }}>⏳ Chờ nhận</option>
                                <option value="in_transit" {{ request('status')=='in_transit' ?'selected':'' }}>🚚 Đang giao</option>
                                <option value="delivered"  {{ request('status')=='delivered'  ?'selected':'' }}>✅ Đã giao</option>
                            </select>
                        </div>
                    </div>

                    {{-- Lọc theo ngày --}}
                    <div>
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Từ ngày</label>
                        <div class="relative">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input type="date" name="date_from" value="{{ request('date_from') }}"
                                   class="pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition-all w-[155px]">
                        </div>
                    </div>
                    <div>
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Đến ngày</label>
                        <div class="relative">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input type="date" name="date_to" value="{{ request('date_to') }}"
                                   class="pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition-all w-[155px]">
                        </div>
                    </div>

                    {{-- Nút --}}
                    <div class="flex gap-2 pb-0.5">
                        <button type="submit"
                                class="px-4 py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 active:scale-95 transition-all flex items-center gap-1.5 shadow-sm">
                            <i data-lucide="search" class="w-3.5 h-3.5"></i> Lọc
                        </button>
                        @if(request()->hasAny(['search','status','date_from','date_to']))
                            <a href="{{ route('agent.orders.index') }}"
                               class="px-4 py-2.5 bg-gray-100 text-gray-500 text-sm font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center gap-1.5">
                                <i data-lucide="x" class="w-3.5 h-3.5"></i> Xoá
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Shortcut ngày nhanh --}}
                <div class="flex items-center gap-2 mt-3 flex-wrap">
                    <span class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">Nhanh:</span>
                    <button type="button" onclick="setDateRange('today')"
                            class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">Hôm nay</button>
                    <button type="button" onclick="setDateRange('yesterday')"
                            class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">Hôm qua</button>
                    <button type="button" onclick="setDateRange('week')"
                            class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">7 ngày qua</button>
                    <button type="button" onclick="setDateRange('month')"
                            class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">Tháng này</button>
                </div>
            </form>
        </div>

        {{-- Bảng đơn hàng --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-900">Danh sách vận đơn</h3>
                    @if(request()->hasAny(['search','status','date_from','date_to']))
                        <span class="text-[0.6rem] font-bold bg-primary-50 text-primary-600 border border-primary-100 px-2 py-0.5 rounded-full uppercase tracking-wider">Đang lọc</span>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                <span id="realtime-badge" class="flex items-center gap-1 text-[0.65rem] font-bold text-emerald-600">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Realtime
                </span>
                    <span class="text-xs font-bold bg-gray-100 text-gray-600 px-3 py-1 rounded-full" id="order-count">{{ $orders->count() }} đơn</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left" id="orders-table">
                    <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100 text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-5 py-3.5">Vận đơn</th>
                        <th class="px-5 py-3.5">Người gửi</th>
                        <th class="px-5 py-3.5">Người nhận</th>
                        <th class="px-5 py-3.5">Ngày tạo</th>
                        <th class="px-5 py-3.5">Trạng thái</th>
                        <th class="px-5 py-3.5 text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700" id="orders-tbody">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-50/60 transition-colors order-row"
                            data-tracking="{{ strtolower($order->tracking_id) }}"
                            data-status="{{ $order->status }}">
                            <td class="px-5 py-4">
                                <span class="font-bold text-gray-900 text-sm font-mono tracking-wide">{{ $order->tracking_id }}</span>
                                <div class="text-[0.65rem] text-gray-400 mt-0.5 font-medium">ID #{{ $order->id }}</div>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-gray-800 text-sm">{{ $order->sender_name }}</p>
                                <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                    <i data-lucide="phone" class="w-2.5 h-2.5 flex-shrink-0"></i>{{ $order->sender_phone ?? '—' }}
                                </p>
                                <p class="text-[0.65rem] text-gray-400 mt-0.5 max-w-[160px] truncate flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-2.5 h-2.5 flex-shrink-0"></i>{{ $order->sender_address }}
                                </p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-semibold text-gray-900 text-sm">{{ $order->receiver_name }}</p>
                                <p class="text-xs text-primary-500 font-semibold mt-0.5 flex items-center gap-1">
                                    <i data-lucide="phone" class="w-2.5 h-2.5 flex-shrink-0"></i>{{ $order->receiver_phone ?? '—' }}
                                </p>
                                <p class="text-[0.65rem] text-gray-400 mt-0.5 max-w-[160px] truncate flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-2.5 h-2.5 flex-shrink-0"></i>{{ $order->receiver_address }}
                                </p>
                            </td>
                            <td class="px-5 py-4 whitespace-nowrap">
                                <p class="text-sm font-semibold text-gray-700">{{ $order->created_at->format('d/m/Y') }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ $order->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-5 py-4">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wide
                                @if($order->status=='assigned')   bg-amber-50  text-amber-700  border border-amber-200
                                @elseif($order->status=='in_transit') bg-blue-50   text-blue-700   border border-blue-200
                                @elseif($order->status=='delivered')  bg-emerald-50 text-emerald-700 border border-emerald-200
                                @else bg-gray-50 text-gray-500 border border-gray-200 @endif">
                                @if($order->status=='assigned')   <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span> Chờ nhận
                                @elseif($order->status=='in_transit') <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span> Đang giao
                                @elseif($order->status=='delivered')  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Đã giao
                                @else {{ $order->status }} @endif
                            </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('agent.orders.show', $order->id) }}"
                                       class="inline-flex items-center gap-1 text-xs font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-2.5 py-1.5 rounded-lg transition-all">
                                        <i data-lucide="eye" class="w-3 h-3"></i> Chi tiết
                                    </a>
                                    @if($order->status=='assigned')
                                        <form action="{{ route('agent.orders.accept', $order->id) }}" method="POST">
                                            @csrf
                                            <button class="inline-flex items-center gap-1 text-xs font-bold text-white bg-amber-500 hover:bg-amber-600 px-2.5 py-1.5 rounded-lg transition-all shadow-sm">
                                                <i data-lucide="check" class="w-3 h-3"></i> Nhận
                                            </button>
                                        </form>
                                    @elseif($order->status=='in_transit')
                                        <form action="{{ route('agent.orders.complete', $order->id) }}" method="POST">
                                            @csrf
                                            <button class="inline-flex items-center gap-1 text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 px-2.5 py-1.5 rounded-lg transition-all shadow-sm">
                                                <i data-lucide="check-check" class="w-3 h-3"></i> Xong
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-row">
                            <td colspan="6" class="py-14 text-center">
                                <i data-lucide="package-x" class="w-10 h-10 text-gray-200 mx-auto mb-2"></i>
                                <p class="text-sm font-medium text-gray-400">Không có đơn hàng nào.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // ── Đồng hồ realtime ──────────────────────────────────────────
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2,'0');
            const m = String(now.getMinutes()).padStart(2,'0');
            const s = String(now.getSeconds()).padStart(2,'0');
            const el = document.getElementById('clock-time');
            if (el) el.textContent = `${h}:${m}:${s}`;
        }
        updateClock();
        setInterval(updateClock, 1000);

        // ── Realtime filter (client-side khi server đã load xong) ─────
        const searchInput = document.getElementById('search-input');
        const statusSelect = document.getElementById('status-select');

        function clientFilter() {
            const q = (searchInput.value || '').toLowerCase().trim();
            const st = statusSelect.value;
            const rows = document.querySelectorAll('.order-row');
            let visible = 0;
            rows.forEach(row => {
                const matchSearch = !q || row.dataset.tracking.includes(q);
                const matchStatus = !st || row.dataset.status === st;
                const show = matchSearch && matchStatus;
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            const cnt = document.getElementById('order-count');
            if (cnt) cnt.textContent = visible + ' đơn';
        }

        if (searchInput) searchInput.addEventListener('input', clientFilter);
        if (statusSelect) statusSelect.addEventListener('change', clientFilter);

        // ── Shortcut ngày nhanh ───────────────────────────────────────
        function fmt(d) {
            return d.toISOString().split('T')[0];
        }
        function setDateRange(range) {
            const now = new Date();
            const from = document.querySelector('[name="date_from"]');
            const to   = document.querySelector('[name="date_to"]');
            if (range === 'today') {
                from.value = to.value = fmt(now);
            } else if (range === 'yesterday') {
                const y = new Date(now); y.setDate(y.getDate() - 1);
                from.value = to.value = fmt(y);
            } else if (range === 'week') {
                const w = new Date(now); w.setDate(w.getDate() - 6);
                from.value = fmt(w); to.value = fmt(now);
            } else if (range === 'month') {
                from.value = fmt(new Date(now.getFullYear(), now.getMonth(), 1));
                to.value   = fmt(now);
            }
            document.getElementById('filter-form').submit();
        }
    </script>
@endsection
