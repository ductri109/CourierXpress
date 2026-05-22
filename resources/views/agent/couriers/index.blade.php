@extends('agent.layout')

@section('title', 'Tra cứu Vận đơn')

@section('content')
    <div class="flex flex-col h-full space-y-5">

        {{-- Header --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-950">Tra cứu Vận đơn</h2>
            <p class="text-gray-400 text-sm mt-0.5">Tìm kiếm tức thì.</p>
        </div>

        {{-- Search bar realtime --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
            <div class="flex gap-3 items-center">
                <div class="flex-1 relative">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" id="search-icon"></i>
                    <input type="text" id="realtime-search" autofocus
                           placeholder="Gõ mã vận đơn, tên người gửi, người nhận..."
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
            <p class="text-sm font-semibold">Không có vận đơn nào khớp với từ khoá bạn nhập.</p>
        </div>

        {{-- Table --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex-1">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-900">Tất cả hồ sơ bưu cục</h3>
                <span class="text-xs font-bold bg-gray-100 text-gray-600 px-3 py-1.5 rounded-full">
                Tổng: <span id="total-count">{{ $orders->count() }}</span> đơn
            </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                    <tr class="bg-gray-50 border-b border-gray-100 text-[0.65rem] font-bold text-gray-400 uppercase tracking-wider">
                        <th class="px-6 py-3.5 w-16">ID</th>
                        <th class="px-6 py-3.5">Mã Vận Đơn</th>
                        <th class="px-6 py-3.5">Tuyến đi – nhận</th>
                        <th class="px-6 py-3.5">Khách hàng đặt</th>
                        <th class="px-6 py-3.5 text-center">Khối lượng</th>
                        <th class="px-6 py-3.5 text-center">Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm text-gray-700" id="orders-tbody">
                    @php
                        $statusMap = [
                            'assigned'   => ['label'=>'Chờ nhận',  'bg'=>'bg-amber-100',   'text'=>'text-amber-700',   'dot'=>'bg-amber-500',   'pulse'=>true],
                            'in_transit' => ['label'=>'Đang giao', 'bg'=>'bg-blue-100',    'text'=>'text-blue-700',    'dot'=>'bg-blue-500',    'pulse'=>true],
                            'delivered'  => ['label'=>'Đã giao',   'bg'=>'bg-emerald-100', 'text'=>'text-emerald-700', 'dot'=>'bg-emerald-500', 'pulse'=>false],
                        ];
                    @endphp
                    @forelse($orders as $item)
                        @php $sm = $statusMap[$item->status] ?? ['label'=>$item->status,'bg'=>'bg-gray-100','text'=>'text-gray-600','dot'=>'bg-gray-400','pulse'=>false]; @endphp
                        <tr class="order-row hover:bg-gray-50/60 transition-colors"
                            data-search="{{ strtolower($item->tracking_id . ' ' . $item->sender_name . ' ' . $item->receiver_name . ' ' . ($item->customer->full_name ?? '')) }}">
                            <td class="px-6 py-4 text-xs font-bold text-gray-400">#{{ $item->id }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-gray-900 font-mono tracking-wide">{{ $item->tracking_id }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-1 text-xs">
                                <span class="flex items-center gap-1.5 text-gray-600">
                                    <span class="w-4 h-4 rounded-full bg-gray-100 flex items-center justify-center text-[0.5rem] font-bold text-gray-500 flex-shrink-0">T</span>
                                    {{ $item->sender_name }}
                                </span>
                                    <span class="flex items-center gap-1.5 text-gray-600">
                                    <span class="w-4 h-4 rounded-full bg-primary-100 flex items-center justify-center text-[0.5rem] font-bold text-primary-600 flex-shrink-0">Đ</span>
                                    {{ $item->receiver_name }}
                                </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-600 font-medium">{{ $item->customer->full_name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-center font-semibold text-gray-800">{{ $item->total_weight }} kg</td>
                            <td class="px-6 py-4 text-center">
                            <span class="inline-flex items-center justify-center gap-1.5 px-3 py-1 rounded-full text-[0.65rem] font-bold uppercase tracking-wider {{ $sm['bg'] }} {{ $sm['text'] }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $sm['dot'] }} {{ $sm['pulse'] ? 'animate-pulse' : '' }}"></span>
                                {{ $sm['label'] }}
                            </span>
                            </td>
                        </tr>
                    @empty
                        <tr id="empty-row">
                            <td colspan="6" class="py-14 text-center">
                                <i data-lucide="inbox" class="w-10 h-10 text-gray-200 mx-auto mb-2"></i>
                                <p class="text-sm text-gray-400 font-medium">Chưa có hồ sơ nào.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        const input     = document.getElementById('realtime-search');
        const clearBtn  = document.getElementById('clear-btn');
        const hint      = document.getElementById('search-hint');
        const matchCnt  = document.getElementById('match-count');
        const matchQ    = document.getElementById('match-query');
        const noBanner  = document.getElementById('no-result-banner');
        const totalEl   = document.getElementById('total-count');
        const rows      = document.querySelectorAll('.order-row');

        function filterTable() {
            const q = input.value.trim().toLowerCase();

            // Xử lý nút xoá
            clearBtn.classList.toggle('hidden', q === '');

            let visible = 0;
            rows.forEach(row => {
                const match = !q || row.dataset.search.includes(q);
                row.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            // Counter + hint
            totalEl.textContent = visible;
            if (q) {
                hint.classList.remove('hidden');
                matchCnt.textContent = visible;
                matchQ.textContent   = input.value.trim();
            } else {
                hint.classList.add('hidden');
            }

            // No-result banner
            noBanner.classList.toggle('hidden', !(q && visible === 0));
            noBanner.classList.toggle('flex',     q && visible === 0);
        }

        input.addEventListener('input', filterTable);

        clearBtn.addEventListener('click', () => {
            input.value = '';
            filterTable();
            input.focus();
        });
    </script>
@endsection
