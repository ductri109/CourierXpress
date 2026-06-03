@extends('customer.layout')

@section('title', 'About Us - CourierXpress')
@section('content')
    <main class="flex-grow pt-32 pb-20 px-6">
        <div class="max-w-5xl mx-auto space-y-20">
            <div class="text-center space-y-4">
                <h2 class="text-5xl font-black text-gray-900 tracking-tight">About <span class="gradient-text">CourierXpress</span></h2>
                <p class="text-gray-500 text-xl max-w-2xl mx-auto font-medium">Elevating technology, connecting the future through smart Logistics solutions.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                        <span class="w-8 h-1 bg-primary-600 rounded-full"></span>
                        Our Story
                    </h3>
                    <div class="text-gray-600 leading-relaxed space-y-4">
                        <p>In a fast-growing IT industry era, bridging theory and practice is the key to creating breakthrough values. The CourierXpress project was born from the <strong>eProject model at Aptech</strong> — an interactive learning environment that simulates real-world business challenges.</p>
                        <p>We recognized that the logistics industry faces major hurdles with manual management and a lack of operational transparency. CourierXpress was built to radically solve these issues, delivering seamless optimization for administrators, agents, and customers alike.</p>
                    </div>
                </div>
                <div class="bg-primary-50 rounded-3xl p-8 border border-primary-100 flex items-center justify-center">
                    <i data-lucide="sparkles" class="w-32 h-32 text-primary-600 opacity-20 absolute"></i>
                    <div class="relative text-center">
                        <p class="text-4xl font-black text-primary-600 italic">"From theory to breakthrough practice"</p>
                    </div>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 transition-all group">
                    <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="eye"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Vision</h3>
                    <p class="text-gray-600 leading-relaxed">To become the leading delivery management platform, pioneering the application of modern technology to simplify complex logistics operations.</p>
                </div>
                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 transition-all group">
                    <div class="w-12 h-12 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="target"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Mission</h3>
                    <p class="text-gray-600 leading-relaxed">To automate express delivery activities through a centralized web application, helping businesses gain full control from ordering to detailed analysis reporting.</p>
                </div>
            </div>

            <div class="space-y-10">
                <h3 class="text-2xl font-bold text-gray-900 text-center">Core Values</h3>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center space-y-3">
                        <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="box"></i></div>
                        <h4 class="font-bold text-sm">Practicality</h4>
                    </div>
                    <div class="text-center space-y-3">
                        <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="zap"></i></div>
                        <h4 class="font-bold text-sm">Innovation</h4>
                    </div>
                    <div class="text-center space-y-3">
                        <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="shield-check"></i></div>
                        <h4 class="font-bold text-sm">Security</h4>
                    </div>
                    <div class="text-center space-y-3">
                        <div class="mx-auto w-14 h-14 bg-white shadow-md rounded-full flex items-center justify-center text-primary-600"><i data-lucide="smile"></i></div>
                        <h4 class="font-bold text-sm">Experience</h4>
                    </div>
                </div>
            </div>

            <div class="bg-gray-900 rounded-[3rem] p-12 text-white overflow-hidden relative">
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-10 text-center">Founding Team</h3>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                            <div class="w-20 h-20 bg-primary-600 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">
                                <img src="https://res.cloudinary.com/dpumipugc/image/upload/v1778591374/L%C3%AA_Tu%E1%BA%A5n_Anh_jn31df.jpg" alt="Le Tuan Anh" class="rounded-full">
                            </div>
                            <h4 class="font-bold text-lg">Le Tuan Anh</h4>
                            <p class="text-gray-400 text-xs mt-2">Student1692582</p>
                        </div>
                        <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                            <div class="w-20 h-20 bg-primary-600 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">
                                <img src="https://res.cloudinary.com/dpumipugc/image/upload/v1778591127/photo_2026-05-12_19-48-32_uygxzs.jpg" alt="Trinh Tuan Anh" class="rounded-full">
                            </div>
                            <h4 class="font-bold text-lg">Trinh Tuan Anh</h4>
                            <p class="text-gray-400 text-xs mt-2">Student1701600</p>
                        </div>
                        <div class="text-center p-6 bg-white/5 rounded-2xl border border-white/10 hover:bg-white/10 transition-colors">
                            <div class="w-20 h-20 bg-primary-600 rounded-full mx-auto mb-4 flex items-center justify-center text-2xl font-bold">
                                <img src="https://res.cloudinary.com/dpumipugc/image/upload/v1778591841/WIN_20260512_20_15_04_Pro_fquuzr.jpg" alt="Hoang Nguyen Gia Khang" class="rounded-full">
                            </div>
                            <h4 class="font-bold text-lg">Hoang Nguyen Gia Khang</h4>
                            <p class="text-gray-400 text-xs mt-2">Student1698950</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-900">What We Offer?</h3>
                    <p class="text-gray-500 mt-2">A miniature Logistics ecosystem packed with powerful features</p>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <h4 class="font-bold text-primary-600 mb-3">For Admin</h4>
                        <p class="text-sm text-gray-600">Manage agents, clients, monitor shipments, and track metrics with deep dive analytics reports.</p>
                    </div>
                    <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <h4 class="font-bold text-primary-600 mb-3">For Agents</h4>
                        <p class="text-sm text-gray-600">Handle local branch bookings, auto-assign unique Tracking IDs, and dispatch order statuses seamlessly.</p>
                    </div>
                    <div class="p-6 bg-white rounded-2xl shadow-sm border border-gray-100">
                        <h4 class="font-bold text-primary-600 mb-3">For Customers</h4>
                        <p class="text-sm text-gray-600">Register memberships, request online bookings, and track cargo journeys via real-time waybill search.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
