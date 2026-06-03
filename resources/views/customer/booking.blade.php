@extends('customer.layout')

@section('title', 'Create New Order - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Breadcrumb --}}
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
                <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-primary-600 font-medium">Create new order</span>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                {{-- Header Form --}}
                <div class="gradient-bg p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="text-left">
                            <h2 class="text-3xl font-extrabold tracking-tight">Create New Waybill</h2>
                            <p class="text-white/80 mt-2 font-medium">CourierXpress handles automated orders 24/7</p>
                        </div>
                        <div class="hidden md:block">
                            <i data-lucide="box" class="w-16 h-16 text-white/20 animate-pulse"></i>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                {{-- ALERTS --}}
                <div class="px-8 md:px-12 pt-8 pb-0">
                    {{-- Success Toast Notification --}}
                    @if(session('success'))
                        <div class="bg-green-50 border border-green-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-500 mt-0.5 shrink-0"></i>
                            <p class="text-sm text-green-700 font-medium">{{ session('success') }}</p>
                        </div>
                    @endif

                    {{-- Error Notification --}}
                    @if(session('error'))
                        <div class="bg-red-50 border border-red-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 mt-0.5 shrink-0"></i>
                            <p class="text-sm text-red-700 font-medium">{{ session('error') }}</p>
                        </div>
                    @endif

                    {{-- Form Validation Error Notification --}}
                    @if($errors->any())
                        <div class="bg-red-50 border border-red-200 p-4 rounded-xl flex items-start space-x-3 mb-2">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-500 mt-0.5 shrink-0"></i>
                            <div class="text-sm text-red-700 font-medium">
                                <p class="mb-1">Please review the following information:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>

                <form action="{{ route('booking.post') }}" method="POST" id="bookingForm" class="p-8 md:p-12 space-y-10 pt-4 md:pt-4">
                    @csrf

                    {{-- Hidden input to send the combined address to Controller to save for new User --}}
                    <input type="hidden" name="sender_full_address" id="sender_full_address">

                    {{-- SENDER INFORMATION --}}
                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Sender Information</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Sender Full Name <span class="text-primary-500">*</span></label>
                                <input type="text" name="sender_name" value="{{ old('sender_name', auth('customer')->user()?->full_name) }}" required
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none bg-white font-medium text-gray-700 focus:ring-4 focus:ring-primary-50 transition-all">
                            </div>
                            {{-- Sender Phone Number --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Sender Phone Number <span class="text-primary-500">*</span></label>
                                <input type="tel" name="sender_phone" value="{{ old('sender_phone', auth('customer')->user()?->phone) }}" placeholder="Enter sender's phone number" required
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none bg-white font-medium text-gray-700 focus:ring-4 focus:ring-primary-50 transition-all">
                            </div>
                        </div>

                        {{-- Sender Address --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Sender City</label>
                                <input type="text" name="sender_province" value="Hanoi City" readonly
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl bg-gray-100 font-medium text-gray-600 focus:outline-none cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Sender Ward / Commune / Town <span class="text-primary-500">*</span></label>
                                <select id="sender_ward" name="sender_ward" required
                                        class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all bg-white font-medium text-gray-700">
                                    <option value="">-- Select Ward / Commune --</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Sender house number, alley, street name <span class="text-primary-500">*</span></label>
                            @php
                                $userAddress = auth('customer')->user()?->address;
                                $senderDetail = '';
                                if (!empty($userAddress)) {
                                    $addressParts = explode(',', $userAddress);
                                    $senderDetail = trim($addressParts[0]);
                                }
                            @endphp
                            <input type="text" id="sender_address_detail" name="sender_address_detail" value="{{ old('sender_address_detail', $senderDetail) }}" placeholder="e.g., No. 5, Lane 12/2 Doi Can Street" required
                                   class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                        </div>
                    </div>

                    {{-- RECEIVER INFORMATION --}}
                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Receiver Information</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Receiver Full Name <span class="text-primary-500">*</span></label>
                                <input type="text" name="receiver_name" value="{{ old('receiver_name') }}" placeholder="Enter receiver's name" required
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                            </div>
                            {{-- Receiver Phone Number --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Receiver Phone Number <span class="text-primary-500">*</span></label>
                                <input type="tel" name="receiver_phone" value="{{ old('receiver_phone') }}" placeholder="Enter receiver's phone number" required
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                            </div>
                        </div>

                        {{-- Receiver Address --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Receiver City</label>
                                <input type="text" name="receiver_province" value="Hanoi City" readonly
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl bg-gray-100 font-medium text-gray-600 focus:outline-none cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Receiver Ward / Commune / Town <span class="text-primary-500">*</span></label>
                                <select id="receiver_ward" name="receiver_ward" required
                                        class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all bg-white font-medium text-gray-700">
                                    <option value="">-- Select Ward / Commune --</option>
                                </select>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">Receiver house number, alley, street name <span class="text-primary-500">*</span></label>
                            <input type="text" name="receiver_address_detail" value="{{ old('receiver_address_detail') }}" placeholder="e.g., No. 20, Lane 55 Hoang Hoa Tham Street" required
                                   class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all">
                        </div>
                    </div>

                    {{-- GOODS DETAILS --}}
                    <div class="bg-primary-50/30 p-6 rounded-2xl border border-primary-100 space-y-6">
                        <div class="grid md:grid-cols-2 gap-6 items-start">

                            {{-- Weight Range --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Estimated Weight <span class="text-primary-500">*</span>
                                </label>

                                <select name="weight_range" required
                                        class="w-full px-4 py-3.5 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm bg-white font-medium text-gray-700 focus:ring-4 focus:ring-primary-50 transition-all">
                                    <option value="">-- Select weight range --</option>
                                    <option value="under_0.5" {{ old('weight_range') == 'under_0.5' ? 'selected' : '' }}>Under 0.5 kg</option>
                                    <option value="0.5-1" {{ old('weight_range') == '0.5-1' ? 'selected' : '' }}>From 0.5 kg to 1 kg</option>
                                    <option value="1-2" {{ old('weight_range') == '1-2' ? 'selected' : '' }}>From 1 kg to 2 kg</option>
                                    <option value="2-5" {{ old('weight_range') == '2-5' ? 'selected' : '' }}>From 2 kg to 5 kg</option>
                                    <option value="above_5" {{ old('weight_range') == 'above_5' ? 'selected' : '' }}>Above 5 kg</option>
                                </select>
                            </div>

                            {{-- Goods Type --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Goods Type <span class="text-primary-500">*</span>
                                </label>

                                <select name="goods_type" required
                                        class="w-full px-4 py-3.5 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm bg-white font-medium text-gray-700 focus:ring-4 focus:ring-primary-50 transition-all">
                                    <option value="">-- Select goods type --</option>
                                    <option value="Tài liệu" {{ old('goods_type') == 'Tài liệu' ? 'selected' : '' }}>Documents</option>
                                    <option value="Quần áo" {{ old('goods_type') == 'Quần áo' ? 'selected' : '' }}>Clothes</option>
                                    <option value="Mỹ phẩm" {{ old('goods_type') == 'Mỹ phẩm' ? 'selected' : '' }}>Cosmetics</option>
                                    <option value="Đồ điện tử" {{ old('goods_type') == 'Đồ điện tử' ? 'selected' : '' }}>Electronics</option>
                                    <option value="Thực phẩm khô" {{ old('goods_type') == 'Thực phẩm khô' ? 'selected' : '' }}>Dry Food</option>
                                    <option value="Hàng dễ vỡ" {{ old('goods_type') == 'Hàng dễ vỡ' ? 'selected' : '' }}>Fragile Goods</option>
                                    <option value="Khác" {{ old('goods_type') == 'Khác' ? 'selected' : '' }}>Others</option>
                                </select>

                                @error('goods_type')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Notes --}}
                            <div class="md:col-span-2 space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">
                                    Shipping Notes for Courier
                                </label>

                                <textarea name="shipping_notes" rows="3"
                                          placeholder="e.g., Fragile items, contact before delivery, liquid goods..."
                                          class="w-full px-4 py-3 border-2 border-white rounded-xl focus:border-primary-500 focus:outline-none shadow-sm font-medium resize-none text-gray-700 placeholder-gray-400 focus:ring-4 focus:ring-primary-50 transition-all">{{ old('shipping_notes') }}</textarea>
                            </div>

                        </div>
                    </div>

                    <div class="pt-6">
                        <button type="submit"
                                class="w-full gradient-bg text-white py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1.5 flex items-center justify-center space-x-3 group">
                            <span>CONFIRM BOOKING</span>
                            <i data-lucide="send" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </button>
                        <div class="mt-6 p-4 bg-yellow-50 rounded-xl flex items-start space-x-3 border border-yellow-100">
                            <i data-lucide="info" class="w-5 h-5 text-yellow-600 shrink-0 mt-0.5"></i>
                            <p class="text-yellow-800 text-sm leading-relaxed">
                                <strong>Note:</strong> The shipping fee is provisionally calculated based on the weight range and special item criteria. The courier will perform a physical check upon pickup to update the final precise rate.
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Script initialization for static Ward/Commune list --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const senderWardSelect = document.getElementById('sender_ward');
            const receiverWardSelect = document.getElementById('receiver_ward');
            const bookingForm = document.getElementById('bookingForm');
            const senderAddressDetail = document.getElementById('sender_address_detail');

            // Ward / Commune / Town dataset list block
            const wardsData = [
                "Hoan Kiem", "Cua Nam", "Hong Ha", "Ba Dinh", "Ngoc Ha",
                "Giang Vo", "Hai Ba Trung", "Vinh Tuy", "Bach Mai", "Dong Da", "Kim Lien",
                "Van Mieu - Quoc Tu Giam", "Lang", "O Cho Dua", "Hoang Mai", "Linh Nam", "Vinh Hung",
                "Tuong Mai", "Dinh Cong", "Hoang Liet", "Yen So", "Thanh Xuan", "Khuong Dinh",
                "Phuong Liet", "Cau Giay", "Nghia Do", "Yen Hoa", "Tay Ho", "Phu Thuong",
                "Tay Tuu", "Phu Dien", "Xuan Dinh", "Dong Ngac", "Thuong Cat",
                "Tu Liem", "Xuan Phuong", "Tay Mo", "Dai Mo",
                "Long Bien", "Bo De", "Viet Hung", "Phuc Loi", "Ha Dong",
                "Duong Noi", "Yen Nghia", "Phu Luong", "Kien Hung", "Thanh Liet",
                "Chuong My", "Son Tay", "Tung Thien"
            ];

            // Sort dataset alphabetically from A-Z
            wardsData.sort((a, b) => a.localeCompare(b, 'en'));

            // Safe split string check for existing profile address block mapping data
            const userAddress = "{{ auth('customer')->user()?->address }}";
            let dbSenderWard = "";

            if (userAddress && userAddress.trim() !== "") {
                const parts = userAddress.split(',');
                if (parts.length >= 2) {
                    dbSenderWard = parts[1].replace('Phường', '').replace('Xã', '').replace('Thị trấn', '').replace('Ward', '').replace('Commune', '').trim();
                }
            }

            const oldSenderWard = "{{ old('sender_ward') }}" || dbSenderWard;
            const oldReceiverWard = "{{ old('receiver_ward') }}";

            // Loop populate dropdown elements for both sender and receiver
            wardsData.forEach(wardName => {
                let isSenderSelected = oldSenderWard.toLowerCase() === wardName.toLowerCase();
                let isReceiverSelected = oldReceiverWard.toLowerCase() === wardName.toLowerCase();

                let optionSender = new Option(wardName, wardName, false, isSenderSelected);
                let optionReceiver = new Option(wardName, wardName, false, isReceiverSelected);

                senderWardSelect.add(optionSender);
                receiverWardSelect.add(optionReceiver);
            });

            // AUTOMATED MERGE STRING LOGIC ON SUBMIT FOR DEFAULT ADDRESS STORAGE
            bookingForm.addEventListener('submit', function (e) {
                const detail = senderAddressDetail.value.trim();
                const ward = senderWardSelect.value;
                const province = "Hanoi City";

                if (detail && ward) {
                    // Combine into structured standard string block format separated by comma
                    document.getElementById('sender_full_address').value = `${detail}, ${ward} Ward, ${province}`;
                }
            });

            // Re-render lucide icons if needed
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
