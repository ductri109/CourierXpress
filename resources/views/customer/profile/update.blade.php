@extends('customer.layout')

@section('title', 'Update Personal Information - CourierXpress')

@section('content')
    <div class="pt-24 pb-20 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Breadcrumb --}}
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-6 ml-2">
                <a href="{{ route('landing') }}" class="hover:text-primary-600 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <a href="{{ route('customer.profile.index') }}" class="hover:text-primary-600 transition-colors">Account</a>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                <span class="text-primary-600 font-medium">Update Information</span>
            </div>

            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                {{-- Header Form --}}
                <div class="gradient-bg p-10 text-white relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="text-left">
                            <h2 class="text-3xl font-extrabold tracking-tight">Account Information</h2>
                            <p class="text-white/80 mt-2 font-medium">Manage and update your personal profile</p>
                        </div>
                        <div class="hidden md:block">
                            <i data-lucide="user" class="w-16 h-16 text-white/20 animate-pulse"></i>
                        </div>
                    </div>
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                </div>

                {{-- ALERTS --}}
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

                {{-- Route wrapped inside 'customer.' group, calling customer.profile.update --}}
                <form action="{{ route('customer.profile.update') }}" method="POST" id="profileForm" class="p-8 md:p-12 space-y-10 pt-4 md:pt-4">
                    @csrf
                    @method('PUT')

                    {{-- Hidden input to combine full address for the 'address' field in Controller --}}
                    <input type="hidden" name="address" id="full_address_input">

                    <div class="relative">
                        <div class="flex items-center space-x-3 mb-6">
                            <h3 class="text-xl font-bold text-gray-900">Personal Information</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            {{-- Full name --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Full Name <span class="text-primary-500">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $customer?->full_name) }}" required
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                            </div>

                            {{-- Phone number --}}
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Phone Number <span class="text-primary-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone', $customer?->phone) }}" required placeholder="e.g., 0912345678"
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                            </div>
                        </div>

                        {{-- Email address --}}
                        <div class="grid md:grid-cols-1 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Email Address <span class="text-primary-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email', $customer?->email) }}" required placeholder="name@example.com"
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 mb-6 mt-10">
                            <h3 class="text-xl font-bold text-gray-900">Default Pickup Address</h3>
                            <div class="flex-1 h-px bg-gray-100 ml-2"></div>
                        </div>

                        {{-- Hanoi Province and Ward Dropdown sync --}}
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">City / Province</label>
                                <input type="text" id="province_display" value="Hanoi City" readonly
                                       class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl bg-gray-100 font-medium text-gray-600 focus:outline-none cursor-not-allowed">
                            </div>

                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-gray-700">Ward / Commune / Town <span class="text-primary-500">*</span></label>
                                <select id="user_ward" required
                                        class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all bg-white font-medium text-gray-700">
                                    <option value="">-- Select Ward / Commune --</option>
                                </select>
                            </div>
                        </div>

                        {{-- Street address, house number detail --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">House number, alley, street name <span class="text-primary-500">*</span></label>
                            <input type="text" id="address_detail" value="{{ old('address_detail') }}" placeholder="e.g., No. 5, Lane 12/2 Doi Can Street" required
                                   class="w-full px-4 py-3.5 border-2 border-gray-100 rounded-xl focus:border-primary-500 focus:outline-none focus:ring-4 focus:ring-primary-50 transition-all font-medium text-gray-700">
                        </div>
                    </div>

                    {{-- Save Changes Button --}}
                    <div class="pt-6">
                        <button type="submit"
                                class="w-full gradient-bg text-white py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transition-all transform hover:-translate-y-1.5 flex items-center justify-center space-x-3 group">
                            <span>SAVE CHANGES</span>
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

            // 1. Ward / Commune list sorted and matching 100% with booking system
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

            wardsData.sort((a, b) => a.localeCompare(b, 'en'));

            // Parse string from database $customer->address to reverse populate form if old data exists
            const currentDbAddress = "{{ $customer?->address }}";
            let defaultWard = "{{ old('address_detail') }}";
            let defaultDetail = "";

            if(currentDbAddress && !defaultWard) {
                // Expected format pattern: "No. 5 Doi Can Street, Ngọc Hà Ward, Hanoi City" hoặc tương đương tiếng Việt
                const parts = currentDbAddress.split(',');
                if(parts.length >= 3) {
                    defaultDetail = parts[0].trim();
                    defaultWard = parts[1].replace('Phường', '').replace('Xã', '').replace('Thị trấn', '').replace('Ward', '').replace('Commune', '').trim();
                } else {
                    defaultDetail = currentDbAddress;
                }
            }

            // Populate ward options select element
            wardsData.forEach(wardName => {
                // Check match dynamically ignoring casing differences if any
                let isSelected = defaultWard.toLowerCase() === wardName.toLowerCase();
                let option = new Option(wardName, wardName, false, isSelected);
                userWardSelect.add(option);
            });

            if(defaultDetail) {
                addressDetailInput.value = defaultDetail;
            }

            // 2. Combine inputs into a single "address" standard string block on submit
            form.addEventListener('submit', function (e) {
                const detail = addressDetailInput.value.trim();
                const ward = userWardSelect.value;
                const province = "Hanoi City";

                if (detail && ward) {
                    // Format structure pattern: "House details... , [Name] Ward, Hanoi City"
                    fullAddressInput.value = `${detail}, ${ward} Ward, ${province}`;
                }
            });

            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
@endsection
