@extends('agent.layout')

@section('title', 'Quản lý Khách hàng')

@section('content')

    {{-- Xử lý phân trang trực tiếp trên View (Không cần sửa Controller) --}}
    @php
        use Illuminate\Pagination\LengthAwarePaginator;
        use Illuminate\Pagination\Paginator;

        $perPage = 10;
        $page = Paginator::resolveCurrentPage('page') ?: 1;
        $pageData = $customers->slice(($page - 1) * $perPage, $perPage)->all();

        $customers = new LengthAwarePaginator(
            $pageData,
            $customers->count(),
            $perPage,
            $page,
            [
                'path' => Paginator::resolveCurrentPath(),
                'query' => request()->query()
            ]
        );
    @endphp

    <div class="flex flex-col h-full space-y-5">

        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-950">Quản lý Khách hàng</h2>
                <p class="text-gray-400 text-sm mt-0.5">Tìm kiếm, lọc địa chỉ và quản lý thông tin người gửi/nhận.</p>
            </div>

        </div>

        {{-- Thanh tìm kiếm & lọc --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
            <form method="GET" action="{{ route('agent.customers.index') }}" id="filter-form">
                <div class="flex flex-wrap gap-3 items-end">

                    {{-- Tìm kiếm Tên/SĐT/Email --}}
                    <div class="flex-1 min-w-[180px] relative">
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Khách hàng</label>
                        <div class="relative">
                            <i data-lucide="search" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input type="text" name="search" id="search-input" value="{{ request('search') }}"
                                   placeholder="Tên, SĐT, Email..."
                                   autocomplete="off"
                                   class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition-all">
                        </div>
                    </div>

                    {{-- Lọc Địa chỉ --}}
                    <div class="flex-1 min-w-[180px] relative">
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Địa chỉ</label>
                        <div class="relative">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input type="text" name="address" id="address-input" value="{{ request('address') }}"
                                   placeholder="Quận, huyện, đường..."
                                   autocomplete="off"
                                   class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition-all">
                        </div>
                    </div>

                    {{-- Lọc theo ngày --}}
                    <div>
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Từ ngày</label>
                        <div class="relative">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input type="date" name="date_from" value="{{ request('date_from') }}"
                                   class="pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition-all w-[145px]">
                        </div>
                    </div>
                    <div>
                        <label class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider block mb-1.5">Đến ngày</label>
                        <div class="relative">
                            <i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            <input type="date" name="date_to" value="{{ request('date_to') }}"
                                   class="pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 transition-all w-[145px]">
                        </div>
                    </div>

                    {{-- Nút Lọc --}}
                    <div class="flex gap-2 pb-0.5">
                        <button type="submit"
                                class="px-4 py-2.5 bg-primary-600 text-white text-sm font-bold rounded-xl hover:bg-primary-700 active:scale-95 transition-all flex items-center gap-1.5 shadow-sm">
                            <i data-lucide="filter" class="w-3.5 h-3.5"></i> Lọc
                        </button>
                        @if(request()->hasAny(['search','address','date_from','date_to']))
                            <a href="{{ route('agent.customers.index') }}"
                               class="px-4 py-2.5 bg-gray-100 text-gray-500 text-sm font-bold rounded-xl hover:bg-gray-200 transition-all flex items-center gap-1.5">
                                <i data-lucide="x" class="w-3.5 h-3.5"></i> Xoá
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Shortcut ngày nhanh --}}
                <div class="flex items-center gap-2 mt-3 flex-wrap">
                    <span class="text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">Ngày tham gia:</span>
                    <button type="button" onclick="setDateRange('today')" class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">Hôm nay</button>
                    <button type="button" onclick="setDateRange('yesterday')" class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">Hôm qua</button>
                    <button type="button" onclick="setDateRange('week')" class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">7 ngày qua</button>
                    <button type="button" onclick="setDateRange('month')" class="text-xs px-2.5 py-1 rounded-lg border border-gray-200 text-gray-500 hover:border-primary-400 hover:text-primary-600 transition-all font-medium">Tháng này</button>
                </div>
            </form>
        </div>

        {{-- No result banner --}}
        <div id="no-result-banner" class="hidden items-center gap-3 bg-amber-50 border border-amber-200 text-amber-800 px-5 py-4 rounded-2xl">
            <i data-lucide="search-x" class="w-5 h-5 text-amber-500 flex-shrink-0"></i>
            <p class="text-sm font-semibold">Không có khách hàng nào khớp với bộ lọc hiện tại.</p>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex-1">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-900">Danh sách khách hàng giao nhận</h3>
                    @if(request()->hasAny(['search','address','date_from','date_to']))
                        <span class="text-[0.6rem] font-bold bg-primary-50 text-primary-600 border border-primary-100 px-2 py-0.5 rounded-full uppercase tracking-wider">Đang lọc</span>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <span class="flex items-center gap-1 text-[0.65rem] font-bold text-emerald-600">
                        <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span> Realtime Filter
                    </span>
                    <span class="text-xs font-bold bg-gray-100 text-gray-600 px-3 py-1 rounded-full" id="customer-count">{{ method_exists($customers, 'total') ? $customers->total() : $customers->count() }} khách</span>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                    <tr class="bg-gray-50/80 border-b border-gray-100 text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-5 py-3.5 w-16">ID</th>
                        <th class="px-5 py-3.5">Khách hàng</th>
                        <th class="px-5 py-3.5">Liên hệ</th>
                        <th class="px-5 py-3.5">Địa chỉ</th>
                        <th class="px-5 py-3.5 text-center">Đơn đã gửi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700" id="customers-tbody">
                    @forelse($customers as $user)
                        @php
                            $addr = $user->address ?: ($user->couriers->first()->sender_address ?? '');
                        @endphp
                        <tr class="customer-row hover:bg-gray-50/60 transition-colors"
                            data-search="{{ strtolower($user->full_name . ' ' . $user->phone . ' ' . $user->email) }}"
                            data-address="{{ strtolower($addr) }}">
                            <td class="px-5 py-4 text-xs font-bold text-gray-400">#{{ $user->id }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center flex-shrink-0">
                                        <span class="text-primary-700 font-bold text-xs">{{ strtoupper(substr($user->full_name, 0, 1)) }}</span>
                                    </div>
                                    <a href="{{ route('agent.customers.show', $user->id) }}"
                                       class="font-bold text-gray-900 hover:text-primary-600 transition-colors">
                                        {{ $user->full_name }}
                                    </a>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="flex items-center gap-1.5 text-gray-800 font-semibold text-xs mb-1">
                                    <i data-lucide="phone" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0"></i>
                                    {{ $user->phone ?? '—' }}
                                </span>
                                <span class="flex items-center gap-1.5 text-gray-500 text-xs">
                                    <i data-lucide="mail" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0"></i>
                                    {{ $user->email ?? '—' }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                @if($addr)
                                    <span class="flex items-start gap-1.5 text-gray-500 text-[0.7rem] max-w-[200px]">
                                        <i data-lucide="map-pin" class="w-3 h-3 text-gray-400 flex-shrink-0 mt-0.5"></i>
                                        <span class="leading-snug">{{ $addr }}</span>
                                    </span>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-center">
                                <span class="bg-gray-100 text-gray-700 font-bold text-xs px-3 py-1.5 rounded-lg border border-gray-200">
                                    {{ $user->orders_count ?? 0 }} đơn
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-row">
                            <td colspan="5" class="py-14 text-center">
                                <i data-lucide="users" class="w-10 h-10 text-gray-200 mx-auto mb-2"></i>
                                <p class="text-sm font-medium text-gray-400">Hệ thống chưa có khách hàng nào.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Thanh Phân Trang --}}
            @if(method_exists($customers, 'hasPages') && $customers->hasPages())
                <div class="px-5 py-4 border-t border-gray-100 bg-gray-50/50">
                    {{ $customers->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        // Đồng hồ realtime
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

        // Filter JS
        const searchInput = document.getElementById('search-input');
        const addressInput = document.getElementById('address-input');
        const rows = document.querySelectorAll('.customer-row');
        const noBanner = document.getElementById('no-result-banner');
        const cntEl = document.getElementById('customer-count');

        function clientFilter() {
            const q = (searchInput.value || '').toLowerCase().trim();
            const addr = (addressInput.value || '').toLowerCase().trim();

            let visible = 0;
            let totalRows = rows.length;

            rows.forEach(row => {
                const matchSearch = !q || row.dataset.search.includes(q);
                const matchAddress = !addr || row.dataset.address.includes(addr);
                const show = matchSearch && matchAddress;
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            if (cntEl) {
                if (q !== '' || addr !== '') {
                    cntEl.textContent = visible + ' khách (trang này)';
                } else {
                    cntEl.textContent = '{{ method_exists($customers, "total") ? $customers->total() : $customers->count() }} khách';
                }
            }

            if (totalRows > 0) {
                const isNoResult = visible === 0;
                noBanner.classList.toggle('hidden', !isNoResult);
                noBanner.classList.toggle('flex', isNoResult);
            }
        }

        if (searchInput) searchInput.addEventListener('input', clientFilter);
        if (addressInput) addressInput.addEventListener('input', clientFilter);
        clientFilter();

        // Shortcut lọc ngày
        function fmt(d) { return d.toISOString().split('T')[0]; }
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
