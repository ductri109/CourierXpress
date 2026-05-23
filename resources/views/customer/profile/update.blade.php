@extends('customer.layout')

@section('title', 'Cập Nhật Thông Tin Cá Nhân - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Breadcrumb --}}
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
                <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Trang chủ</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <a href="{{ route('customer.profile.index') }}" class="hover:text-primary-600 transition-colors">Tài khoản</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-primary-600 font-medium">Cập nhật thông tin</span>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                {{-- Header Form --}}
                <div class="gradient-bg p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="text-left">
                            <h2 class="text-3xl font-extrabold tracking-tight">Thông Tin Tài Khoản</h2>
                            <p class="text-white/80 mt-2 font-medium">Quản lý và cập nhật thông tin cá nhân của bạn</p>
                        </div>
                        <div class="hidden md:block">
                            <i data-lucide="user" class="w-16 h-16 text-white/20 animate-pulse"></i>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                {{-- THÔNG BÁO (ALERTS) --}}
                <div class="px-8 md:px-12 pt-8 pb-0">
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500 mt-0.5 shrink-0"></i>
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mt-0.5 shrink-0"></i>
                            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

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

                {{-- Tên Route bọc trong nhóm 'customer.' nên gọi là customer.profile.update --}}
                <form action="{{ route('customer.profile.update') }}" method="POST" id="profileForm" class="p-8 md:p-12 space-y-10 pt-4 md:pt-4">
                    @csrf
                    @method('PUT')

                    {{-- Trường ẩn để gộp địa chỉ gửi lên cho trường 'address' trong Controller --}}
                    <input type="hidden" name="address" id="full_address_input">

                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Thông tin cá nhân</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            {{-- Họ tên (name) --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Họ và tên <span class="text-primary-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $customer?->full_name) }}" required
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                            </div>

                            {{-- Số điện thoại (phone) --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Số điện thoại <span class="text-primary-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone', $customer?->phone) }}" required placeholder="Ví dụ: 0912345678"
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                            </div>
                        </div>

                        {{-- Email (email) --}}
                        <div class="grid md:grid-cols-1 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Địa chỉ Email <span class="text-primary-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $customer?->email) }}" required placeholder="name@example.com"
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 mb-6 mt-10">
                            <h3 class="text-xl font-bold text-gray-900">Địa chỉ lấy hàng mặc định</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        {{-- Địa chỉ cố định Hà Nội & Dropdown Phường xã giống Booking --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Thành phố / Tỉnh thành</label>
                                <input type="text" id="province_display" value="Thành phố Hà Nội" readonly
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl bg-gray-100 font-medium text-gray-600 focus:outline-none cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Phường / Xã / Thị trấn <span class="text-primary-500">*</span></label>
                                <select id="user_ward" required
                                        class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all bg-white font-medium text-gray-700">
                                    <option value="">-- Chọn Phường / Xã --</option>
                                </select>
                            </div>
                        </div>

                        {{-- Chi tiết số nhà, tên đường --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Số nhà, ngõ ngách, tên đường <span class="text-primary-500">*</span></label>
                            <input type="text" id="address_detail" value="{{ old('address_detail') }}" placeholder="Ví dụ: Số 5, ngách 12/2 Đội Cấn" required
                                   class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                        </div>
                    </div>

                    {{-- Nút Lưu Thay Đổi --}}
                    <div class="pt-6">
                        <button type="submit"
                                class="w-full gradient-bg text-white py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1.5 flex items-center justify-center space-x-3 group">
                            <span>LƯU THAY ĐỔI</span>
                            <i data-lucide="save" class="w-5 h-5 group-hover:scale-110 transition-transform"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const userWardSelect = document.getElementById('user_ward');
            const addressDetailInput = document.getElementById('address_detail');
            const fullAddressInput = document.getElementById('full_address_input');
            const form = document.getElementById('profileForm');

            // 1. Danh sách Phường / Xã đồng bộ 100% với booking
            const wardsData = [
                "Hoàn Kiếm", "Cửa Nam", "Hồng Hà", "Ba Đình", "Ngọc Hà",
                "Giảng Võ", "Hai Bà Trưng", "Vĩnh Tuy", "Bạch Mai", "Đống Đa", "Kim Liên",
                "Văn Miếu - Quốc Tử Giám", "Láng", "Ô Chợ Dừa", "Hoàng Mai", "Lĩnh Nam", "Vĩnh Hưng",
                "Tương Mai", "Định Công", "Hoàng Liệt", "Yên Sở", "Thanh Xuân", "Khương Đình",
                "Phương Liệt", "Cầu Giấy", "Nghĩa Đô", "Yên Hòa", "Tây Hồ", "Phú Thượng",
                "Tây Tựu", "Phú Diễn", "Xuân Đỉnh", "Đông Ngạc", "Thượng Cát",
                "Từ Liêm", "Xuân Phương", "Tây Mỗ", "Đại Mỗ",
                "Long Biên", "Bồ Đề", "Việt Hưng", "Phúc Lợi", "Hà Đông",
                "Dương Nội", "Yên Nghĩa", "Phú Lương", "Kiến Hưng", "Thanh Liệt",
                "Chương Mỹ", "Sơn Tây", "Tùng Thiện"
            ];

            wardsData.sort((a, b) => a.localeCompare(b, 'vi'));

            // Tách chuỗi từ database $customer->address ngược lại để hiển thị lên form nếu có dữ liệu cũ
            const currentDbAddress = "{{ $customer?->address }}";
            let defaultWard = "{{ old('address_detail') }}";
            let defaultDetail = "";

            if(currentDbAddress && !defaultWard) {
                // Thử bóc tách chuỗi dạng: "Số 5 Đội Cấn, Phường Ngọc Hà, Thành phố Hà Nội"
                const parts = currentDbAddress.split(',');
                if(parts.length >= 3) {
                    defaultDetail = parts[0].trim();
                    defaultWard = parts[1].replace('Phường', '').replace('Xã', '').replace('Thị trấn', '').trim();
                } else {
                    defaultDetail = currentDbAddress;
                }
            }

            // Đổ dữ liệu vào select ward
            wardsData.forEach(wardName => {
                let isSelected = defaultWard === wardName;
                let option = new Option(wardName, wardName, false, isSelected);
                userWardSelect.add(option);
            });

            if(defaultDetail) {
                addressDetailInput.value = defaultDetail;
            }

            // 2. Logic gộp chuỗi địa chỉ thành 1 trường "address" duy nhất trước khi submit lên Controller
            form.addEventListener('submit', function (e) {
                const detail = addressDetailInput.value.trim();
                const ward = userWardSelect.value;
                const province = "Thành phố Hà Nội";

                if (detail && ward) {
                    // Tạo định dạng: "Số nhà... , Phường ... , Thành phố Hà Nội"
                    fullAddressInput.value = `${detail}, Phường ${ward}, ${province}`;
                }
            });

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
