@extends('customer.layout')

@section('title', 'Điều khoản sử dụng - CourierXpress')

@section('content')
<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-4xl mx-auto space-y-8">
        <div class="space-y-2">
            <h2 class="text-3xl font-black text-gray-900 border-l-4 border-primary-600 pl-4 uppercase">Điều khoản sử dụng</h2>
            <p class="text-gray-500 text-sm pl-5 italic">Cập nhật lần cuối: Năm 2026</p>
        </div>

        <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100 text-gray-600 space-y-10 leading-relaxed text-justify">

            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">01</span>
                    <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Chấp thuận điều khoản</h3>
                </div>
                <p>Bằng việc truy cập hoặc sử dụng hệ thống web <strong>CourierXpress</strong>, bạn đồng ý bị ràng buộc bởi các điều khoản này, bao gồm cả các chính sách bổ sung được dẫn chiếu tại đây. Nếu bạn không đồng ý với bất kỳ phần nào của điều khoản, vui lòng ngừng sử dụng dịch vụ ngay lập tức.</p>
            </section>

            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">02</span>
                    <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Quyền sở hữu trí tuệ</h3>
                </div>
                <p>Tất cả nội dung trên hệ thống CourierXpress, bao gồm nhưng không giới hạn ở văn bản, đồ họa, logo, hình ảnh, mã nguồn và giao diện người dùng, đều thuộc quyền sở hữu của <strong>CourierXpress Logistics</strong> và được bảo vệ bởi luật bản quyền. Nghiêm cấm mọi hành vi sao chép, sửa đổi hoặc sử dụng lại cho mục đích thương mại khi chưa có sự đồng ý bằng văn bản.</p>
            </section>

            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">03</span>
                    <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Trách nhiệm người dùng</h3>
                </div>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Người dùng phải cung cấp chính xác thông tin hàng hóa, địa chỉ người gửi/nhận và trọng lượng để hệ thống tính phí tự động chính xác.</li>
                    <li>Chịu trách nhiệm bảo mật thông tin đăng nhập và mật khẩu cá nhân.</li>
                    <li>Tuyệt đối không đăng tải nội dung đồi trụy, bất hợp pháp, thư rác (spam) hoặc thực hiện các hành vi cố gắng hack, phá hoại hệ thống.</li>
                </ul>
            </section>

            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">04</span>
                    <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Giới hạn trách nhiệm</h3>
                </div>
                <p>CourierXpress nỗ lực đảm bảo hệ thống hoạt động ổn định 24/7. Tuy nhiên, chúng tôi không chịu trách nhiệm cho bất kỳ thiệt hại trực tiếp hoặc gián tiếp nào phát sinh từ việc sử dụng dịch vụ, bao gồm lỗi do đường truyền mạng, sự cố phần cứng hoặc thông tin sai lệch do người dùng cung cấp.</p>
            </section>

            <section class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">05</span>
                    <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Chấm dứt tài khoản</h3>
                </div>
                <p>Chúng tôi có quyền khóa hoặc chấm dứt tài khoản của bạn ngay lập tức mà không cần thông báo trước nếu bạn vi phạm bất kỳ điều khoản nào nêu trên hoặc có hành vi gây hại đến uy tín và vận hành của hệ thống.</p>
            </section>

        </div>
    </div>
</main>
@endsection
