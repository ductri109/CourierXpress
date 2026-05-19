@extends('customer.layout')

@section('title', 'Tạo Đơn Hàng Mới - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Breadcrumb --}}
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
                <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Trang chủ</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-primary-600 font-medium">Tạo đơn hàng mới</span>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                {{-- Header Form --}}
                <div class="gradient-bg p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="text-left">
                            <h2 class="text-3xl font-extrabold tracking-tight">Tạo Vận Đơn Mới</h2>
                            <p class="text-white/80 mt-2 font-medium">Hệ thống CourierXpress xử lý đơn hàng tự động 24/7</p>
                        </div>
                        <div class="hidden md:block">
                            <i data-lucide="box" class="w-16 h-16 text-white/20 animate-pulse"></i>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                {{-- THÔNG BÁO (ALERTS) --}}
                <div class="px-8 md:px-12 pt-8 pb-0">
                    {{-- Thông báo thành công --}}
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500 mt-0.5 shrink-0"></i>
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- Thông báo lỗi chung --}}
                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mt-0.5 shrink-0"></i>
                            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

                    {{-- Thông báo lỗi Validate Form --}}
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500 mt-0.5 shrink-0"></i>
                            <div class="text-sm text-red-700 font-medium">
                                <p class="mb-1">Vui lòng kiểm tra lại các thông tin sau:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <form action="{{ route('booking.post') }}" method="POST" class="p-8 md:p-12 space-y-10 pt-4 md:pt-4">
                    @csrf

                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Thông tin người gửi</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700">Họ tên người gửi</label>
                                <input type="text" name="sender_name" value="{{ old('sender_name', auth('customer')->user()?->full_name) }}"
                                       class="w-full pl-4 pr-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none bg-gray-50 font-medium text-gray-600">
                            </div>
                        </div>

                        {{-- Địa chỉ người gửi (Cố định Hà Nội & Thả danh sách Phường chỉ định) --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Thành phố người gửi</label>
                                <input type="text" name="sender_province" value="Thành phố Hà Nội" readonly
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl bg-gray-100 font-medium text-gray-600 focus:outline-none cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Phường / Xã / Thị trấn gửi <span class="text-primary-500">*</span></label>
                                <select id="sender_ward" name="sender_ward" required
                                        class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all bg-white font-medium text-gray-700">
                                    <option value="">-- Chọn Phường / Xã --</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Số nhà, ngõ ngách, tên đường người gửi <span class="text-primary-500">*</span></label>
                            <input type="text" name="sender_address_detail" value="{{ old('sender_address_detail') }}" placeholder="Ví dụ: Số 5, ngách 12/2 Đội Cấn" required
                                   class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                        </div>
                    </div>

                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Thông tin người nhận</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2 md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700">Họ tên người nhận <span class="text-primary-500">*</span></label>
                                <input type="text" name="receiver_name" value="{{ old('receiver_name') }}" placeholder="Nhập tên người nhận" required
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                            </div>
                        </div>

                        {{-- Địa chỉ người nhận (Cố định Hà Nội & Thả danh sách Phường chỉ định) --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Thành phố người nhận</label>
                                <input type="text" name="receiver_province" value="Thành phố Hà Nội" readonly
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl bg-gray-100 font-medium text-gray-600 focus:outline-none cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Phường / Xã / Thị trấn nhận <span class="text-primary-500">*</span></label>
                                <select id="receiver_ward" name="receiver_ward" required
                                        class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all bg-white font-medium text-gray-700">
                                    <option value="">-- Chọn Phường / Xã --</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Số nhà, ngõ ngách, tên đường người nhận <span class="text-primary-500">*</span></label>
                            <input type="text" name="receiver_address_detail" value="{{ old('receiver_address_detail') }}" placeholder="Ví dụ: Số 20, ngõ 55 Hoàng Hoa Thám" required
                                   class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                        </div>
                    </div>

                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Chi tiết hàng hóa</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        <div class="bg-primary-50/30 p-6 rounded-2xl border border-primary-100 space-y-6">
                            <div class="grid md:grid-cols-3 gap-6 items-start">
                                {{-- Dropdown phân loại Khối lượng --}}
                                <div class="space-y-2 md:col-span-1">
                                    <label class="block text-sm font-semibold text-gray-700">Khối lượng ước tính <span class="text-primary-500">*</span></label>
                                    <select name="weight_range" required
                                            class="w-full px-4 py-3.5 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm bg-white font-medium text-gray-700">
                                        <option value="">-- Chọn mức cân nặng --</option>
                                        <option value="under_0.5" {{ old('weight_range') == 'under_0.5' ? 'selected' : '' }}>Dưới 0.5 kg</option>
                                        <option value="0.5-1" {{ old('weight_range') == '0.5-1' ? 'selected' : '' }}>Từ 0.5 kg đến 1 kg</option>
                                        <option value="1-2" {{ old('weight_range') == '1-2' ? 'selected' : '' }}>Từ 1 kg đến 2 kg</option>
                                        <option value="2-5" {{ old('weight_range') == '2-5' ? 'selected' : '' }}>Từ 2 kg đến 5 kg</option>
                                        <option value="above_5" {{ old('weight_range') == 'above_5' ? 'selected' : '' }}>Trên 5 kg</option>
                                    </select>
                                </div>

                                {{-- Ô nhập Textarea ghi chú cho người giao hàng --}}
                                <div class="md:col-span-2 space-y-2">
                                    <label class="block text-sm font-semibold text-gray-700">Ghi chú cho người giao hàng</label>
                                    <textarea name="shipping_notes" rows="2" placeholder="Ví dụ: Hàng dễ vỡ, liên hệ trước khi giao, hàng chất lỏng..."
                                              class="w-full px-4 py-3 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm font-medium resize-none text-gray-700 placeholder-gray-400">{{ old('shipping_notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit"
                                class="w-full gradient-bg text-white py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1.5 flex items-center justify-center space-x-3 group">
                            <span>XÁC NHẬN ĐẶT ĐƠN</span>
                            <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        <div class="mt-6 p-4 bg-yellow-50 rounded-xl flex items-start space-x-3 border border-yellow-100">
                            <i data-lucide="info" class="w-5 h-5 text-yellow-600 shrink-0 mt-0.5"></i>
                            <p class="text-yellow-800 text-sm leading-relaxed">
                                <strong>Lưu ý:</strong> Phí vận chuyển tạm tính dựa trên phân mức khối lượng và ghi chú đặc thù hàng hóa. Nhân viên bưu tá sẽ kiểm tra thực tế khi lấy hàng để cập nhật giá cước chính xác nhất.
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script khởi tạo danh sách Phường/Xã cố định --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const senderWardSelect = document.getElementById('sender_ward');
            const receiverWardSelect = document.getElementById('receiver_ward');

            // Danh sách Phường / Xã / Thị trấn
            const wardsData = [
                "Hoàn Kiếm", "Cửa Nam", "Ba Đình", "Ngọc Hà", "Giảng Võ", "Hai Bà Trưng",
                "Vĩnh Tuy", "Bạch Mai", "Đống Đa", "Kim Liên", "Văn Miếu - Quốc Tử Giám",
                "Láng", "Ô Chợ Dừa", "Hồng Hà", "Lĩnh Nam", "Hoàng Mai", "Vĩnh Hưng",
                "Tương Mai", "Định Công", "Hoàng Liệt", "Yên Sở", "Thanh Xuân", "Khương Đình",
                "Phương Liệt", "Cầu Giấy", "Nghĩa Đô", "Yên Hòa", "Tây Hồ", "Phú Thượng",
                "Tây Tựu", "Phú Diễn", "Xuân Đỉnh", "Đông Ngạc", "Thượng Cát", "Từ Liêm",
                "Xuân Phương", "Tây Mỗ", "Đại Mỗ", "Long Biên", "Bồ Đề", "Việt Hưng",
                "Phục Lợi", "Hà Đông", "Dương Nội", "Yên Nghĩa", "Phú Lương", "Kiến Hưng",
                "Thanh Liệt", "Chương Mỹ", "Sơn Tây", "Tùng Thiện"
            ];

            // Sắp xếp danh sách theo bảng chữ cái A-Z
            wardsData.sort((a, b) => a.localeCompare(b, 'vi'));

            const oldSenderWard = "{{ old('sender_ward') }}";
            const oldReceiverWard = "{{ old('receiver_ward') }}";

            // Đổ dữ liệu đồng thời vào cả dropdown người gửi và người nhận
            wardsData.forEach(wardName => {
                let isSenderSelected = oldSenderWard === wardName;
                let isReceiverSelected = oldReceiverWard === wardName;

                let optionSender = new Option(wardName, wardName, false, isSenderSelected);
                let optionReceiver = new Option(wardName, wardName, false, isReceiverSelected);

                senderWardSelect.add(optionSender);
                receiverWardSelect.add(optionReceiver);
            });

            // Re-render lucide icons if needed
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
