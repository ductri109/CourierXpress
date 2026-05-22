@extends('agent.layout')

@section('title', 'Quản lý Khách hàng')

@section('content')
    <div class="flex flex-col h-full space-y-5">

        {{-- Header --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-950">Quản lý Khách hàng</h2>
            <p class="text-gray-400 text-sm mt-0.5">Tìm kiếm tức thì — gõ là bảng lọc ngay, không cần bấm nút.</p>
        </div>

        {{-- Search bar realtime --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
            <div class="flex gap-3 items-center">
                <div class="flex-1 relative">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    <input type="text" id="realtime-search" autofocus
                           placeholder="Gõ tên, số điện thoại, email khách hàng..."
                           class="w-full pl-11 pr-10 py-3 text-sm bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-300 focus:border-primary-400 focus:bg-white transition-all font-medium text-gray-700 placeholder-gray-400">
                    <button id="clear-btn"
                            class="hidden absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors p-0.5">
                        <i data-lucide="x-circle" class="w-4 h-4"></i>
                    </button>
                </div>
                <div class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-3 py-2.5 rounded-xl flex-shrink-0 select-none">
                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                    Realtime
                </div>
            </div>
            <p id="search-hint" class="text-xs text-gray-400 mt-2 pl-1 hidden">
                Tìm thấy <span id="match-count" class="font-bold text-gray-800">0</span> kết quả
                cho &ldquo;<span id="match-query" class="font-semibold text-primary-600"></span>&rdquo;
            </p>
        </div>

        {{-- No result banner --}}
        <div id="no-result-banner" class="hidden items-center gap-3 bg-amber-50 border border-amber-200 text-amber-800 px-5 py-4 rounded-2xl">
            <i data-lucide="search-x" class="w-5 h-5 text-amber-500 flex-shrink-0"></i>
            <p class="text-sm font-semibold">Không có khách hàng nào khớp với từ khoá bạn nhập.</p>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex-1">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Danh sách khách hàng giao nhận</h3>
                <span class="text-xs font-bold bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full">
                Tổng: <span id="total-count">{{ $customers->count() }}</span> khách
            </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-6 py-3.5 w-16">ID</th>
                        <th class="px-6 py-3.5">Họ và tên</th>
                        <th class="px-6 py-3.5">Số điện thoại</th>
                        <th class="px-6 py-3.5">Email</th>
                        <th class="px-6 py-3.5">Địa chỉ</th>
                        <th class="px-6 py-3.5 text-center">Đơn đã gửi</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700" id="customers-tbody">
                    @forelse($customers as $user)
                        <tr class="customer-row hover:bg-gray-50/60 transition-colors"
                            data-search="{{ strtolower($user->full_name . ' ' . $user->phone . ' ' . $user->email . ' ' . $user->address) }}">
                            <td class="px-6 py-4 text-xs font-bold text-gray-400">#{{ $user->id }}</td>
                            <td class="px-6 py-4">
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
                            <td class="px-6 py-4">
                            <span class="flex items-center gap-1.5 text-gray-600 font-semibold">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0"></i>
                                {{ $user->phone ?? '—' }}
                            </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $user->email ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @php $addr = $user->address ?: ($user->couriers->first()->sender_address ?? null); @endphp
                                @if($addr)
                                    <span class="flex items-start gap-1.5 text-gray-500 text-xs max-w-[220px]">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400 flex-shrink-0 mt-0.5"></i>
                                    <span class="leading-snug">{{ $addr }}</span>
                                </span>
                                @else
                                    <span class="text-gray-300 text-xs">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                            <span class="bg-primary-50 text-primary-600 font-bold text-xs px-3 py-1.5 rounded-full border border-primary-100">
                                {{ $user->orders_count }} vận đơn
                            </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-14 text-center">
                                <i data-lucide="users" class="w-10 h-10 text-gray-200 mx-auto mb-2"></i>
                                <p class="text-sm text-gray-400 font-medium">Chưa có khách hàng nào.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const input    = document.getElementById('realtime-search');
        const clearBtn = document.getElementById('clear-btn');
        const hint     = document.getElementById('search-hint');
        const matchCnt = document.getElementById('match-count');
        const matchQ   = document.getElementById('match-query');
        const noBanner = document.getElementById('no-result-banner');
        const totalEl  = document.getElementById('total-count');
        const rows     = document.querySelectorAll('.customer-row');

        function filterTable() {
            const q = input.value.trim().toLowerCase();

            clearBtn.classList.toggle('hidden', q === '');

            let visible = 0;
            rows.forEach(row => {
                const match = !q || row.dataset.search.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            totalEl.textContent = visible;

            if (q) {
                hint.classList.remove('hidden');
                matchCnt.textContent = visible;
                matchQ.textContent   = input.value.trim();
            } else {
                hint.classList.add('hidden');
            }

            noBanner.classList.toggle('hidden',  !(q && visible === 0));
            noBanner.classList.toggle('flex',      q && visible === 0);
        }

        input.addEventListener('input', filterTable);

        clearBtn.addEventListener('click', () => {
            input.value = '';
            filterTable();
            input.focus();
        });
    </script>
@endsection
