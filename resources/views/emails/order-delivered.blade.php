<!DOCTYPE html>
<html lang="vi" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'media', // Tự động nhận diện Dark Mode
        }
    </script>
</head>
<body class="bg-slate-100 dark:bg-slate-950 font-sans text-slate-800 dark:text-slate-200 antialiased py-8">

<div class="max-w-[620px] mx-auto bg-white dark:bg-slate-900 rounded-2xl overflow-hidden shadow-sm border border-slate-200 dark:border-slate-800">

    <div class="bg-gradient-to-br from-teal-500 to-emerald-700 pt-10 pb-8 px-10 text-center text-white">

        <div class="text-center w-full block mb-4">
            <div class="inline-block w-[64px] h-[64px] bg-white/20 border-2 border-white/40 rounded-full text-center leading-[60px]">
                <span class="text-[32px] inline-block align-middle">🎉</span>
            </div>
        </div>

        <div class="text-[28px] font-black tracking-tight mb-0.5">Courier<span class="text-teal-200">Xpress</span></div>
        <div class="text-[12px] text-white/75 mb-5">Hệ thống vận chuyển thông minh 24/7</div>
        <div class="inline-block bg-black/15 border-[1.5px] border-white/20 rounded-full px-5 py-1.5 text-[13px] font-bold">
            ✅ &nbsp;Giao hàng thành công!
        </div>
    </div>

    <div class="p-9">

        <p class="text-[19px] font-extrabold mb-1.5 dark:text-white">Xin chào, {{ $order->customer->full_name ?? $order->sender_name }}!</p>
        <p class="text-[13.5px] text-slate-500 dark:text-slate-400 mb-7 leading-relaxed">
            Gói hàng của bạn đã được <strong class="text-slate-700 dark:text-slate-200">giao thành công</strong> đến tay người nhận. Cảm ơn bạn đã tin tưởng sử dụng dịch vụ <strong>CourierXpress</strong>!
        </p>

        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-950/40 dark:to-teal-950/40 border-2 border-emerald-500 dark:border-emerald-700 rounded-xl py-6 text-center mb-8">
            <div class="text-[40px] leading-none mb-2">📦</div>
            <div class="text-[20px] font-black text-emerald-800 dark:text-emerald-400 mb-1">Giao hàng thành công!</div>
            <div class="text-[13px] text-emerald-600 dark:text-emerald-500 mb-2.5">Gói hàng đã đến tay người nhận · {{ now()->format('H:i — d/m/Y') }}</div>
            <div class="text-[24px] font-black text-emerald-600 dark:text-emerald-500 tracking-[3px]">{{ $order->tracking_id }}</div>
        </div>

        <p class="text-[10px] uppercase tracking-[1.5px] font-bold text-slate-400 mb-3">Tuyến vận chuyển</p>
        <div class="bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl p-5 mb-8">
            <div class="flex items-start gap-3.5">
                <div class="w-3 h-3 rounded-full mt-1 shrink-0 bg-slate-400 dark:bg-slate-500 ring-[3px] ring-slate-200 dark:ring-slate-700"></div>
                <div>
                    <div class="text-[13.5px] font-bold text-slate-900 dark:text-slate-100">{{ $order->sender_name }}</div>
                    <div class="text-[12px] text-slate-500 dark:text-slate-400 mt-0.5">{{ $order->sender_address }}</div>
                </div>
            </div>
            <div class="w-[2px] h-[22px] bg-slate-200 dark:bg-slate-700 ml-[5px] my-1"></div>
            <div class="flex items-start gap-3.5">
                <div class="w-3 h-3 rounded-full mt-1 shrink-0 bg-emerald-500 ring-[3px] ring-emerald-200 dark:ring-emerald-900/50"></div>
                <div>
                    <div class="text-[13.5px] font-bold text-slate-900 dark:text-slate-100">
                        {{ $order->receiver_name }}
                        <span class="text-emerald-500 text-[12px] font-bold ml-1">✓ Đã nhận hàng</span>
                    </div>
                    <div class="text-[12px] text-slate-500 dark:text-slate-400 mt-0.5">{{ $order->receiver_address }}</div>
                </div>
            </div>
        </div>

        <p class="text-[10px] uppercase tracking-[1.5px] font-bold text-slate-400 mb-3">Hóa đơn vận chuyển</p>
        <table class="w-full text-[13px] mb-8">
            <thead>
            <tr>
                <th class="bg-slate-100 dark:bg-slate-800 text-left px-3 py-2 text-[10px] uppercase tracking-wide text-slate-400 font-bold">Thông tin</th>
                <th class="bg-slate-100 dark:bg-slate-800 text-right px-3 py-2 text-[10px] uppercase tracking-wide text-slate-400 font-bold">Chi tiết</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-slate-600 dark:text-slate-300">Mã vận đơn</td>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-right font-bold text-emerald-600 dark:text-emerald-500">{{ $order->tracking_id }}</td>
            </tr>
            <tr>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-slate-600 dark:text-slate-300">Thời gian giao</td>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-right font-bold text-slate-900 dark:text-slate-100">{{ $order->updated_at->format('H:i — d/m/Y') }}</td>
            </tr>
            <tr>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-slate-600 dark:text-slate-300">Người gửi</td>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-right font-bold text-slate-900 dark:text-slate-100">{{ $order->sender_name }}</td>
            </tr>
            <tr>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-slate-600 dark:text-slate-300">Khối lượng hàng</td>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-right font-bold text-slate-900 dark:text-slate-100">{{ $order->total_weight }} kg</td>
            </tr>
            <tr>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-slate-600 dark:text-slate-300">Phương thức thanh toán</td>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-right font-bold text-slate-900 dark:text-slate-100">{{ strtoupper($order->payment_method) }}</td>
            </tr>
            <tr>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-slate-600 dark:text-slate-300">Trạng thái đơn hàng</td>
                <td class="py-2.5 px-3 border-b border-slate-100 dark:border-slate-800 text-right font-bold text-emerald-500">✓ Giao thành công</td>
            </tr>
            </tbody>
        </table>

        <div class="bg-slate-50 dark:bg-slate-800/50 rounded-xl p-5 mb-8">
            <div class="flex justify-between text-[13px] text-slate-500 dark:text-slate-400 py-1">
                <span>Phí cơ bản</span>
                <span>30.000 ₫</span>
            </div>
            <div class="flex justify-between text-[13px] text-slate-500 dark:text-slate-400 py-1">
                <span>Phí khối lượng ({{ $order->total_weight }} kg × 10.000 ₫)</span>
                <span>{{ number_format($order->total_weight * 10000, 0, ',', '.') }} ₫</span>
            </div>
            <hr class="my-2.5 border-slate-200 dark:border-slate-700">
            <div class="flex justify-between text-[16px] font-black text-emerald-600 dark:text-emerald-500 py-1">
                <span>Tổng đã thanh toán</span>
                <span>{{ number_format($order->shipping_fee, 0, ',', '.') }} ₫</span>
            </div>
        </div>

        <div class="text-center w-full block mb-8">
            <a href="{{ config('app.url') }}/tracking?tracking_id={{ $order->tracking_id }}" class="inline-block bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold text-[14px] py-3.5 px-9 rounded-full no-underline shadow-md shadow-emerald-500/20 transition-colors">
                🔍 &nbsp;Xem chi tiết đơn hàng
            </a>
        </div>

        <p class="text-[12.5px] text-slate-400 dark:text-slate-500 text-center leading-relaxed">
            Cảm ơn bạn đã sử dụng <strong class="text-slate-600 dark:text-slate-300">CourierXpress</strong>!<br>
            Hỗ trợ: <a href="mailto:support@courierxpress.vn" class="text-emerald-600 dark:text-emerald-500 no-underline">support@courierxpress.vn</a>
        </p>
    </div>

    <div class="bg-slate-50 dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 p-6 text-center">
        <p class="text-[12px] text-slate-400 dark:text-slate-500 leading-relaxed">
            © {{ date('Y') }} <strong>CourierXpress</strong>. Tất cả quyền được bảo lưu.<br>
            Hà Nội, Việt Nam &nbsp;·&nbsp;
            <a href="{{ config('app.url') }}" class="text-emerald-600 dark:text-emerald-500 no-underline">courierxpress.vn</a>
        </p>
    </div>

</div>
</body>
</html>
