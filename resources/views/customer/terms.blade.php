@extends('customer.layout')

@section('title', 'Terms of Service - CourierXpress')

@section('content')
    <main class="flex-grow pt-32 pb-20 px-6">
        <div class="max-w-4xl mx-auto space-y-8">
            <div class="space-y-2">
                <h2 class="text-3xl font-black text-gray-900 border-l-4 border-primary-600 pl-4 uppercase">Terms of Service</h2>
                <p class="text-gray-500 text-sm pl-5 italic">Last Updated: 2026</p>
            </div>

            <div class="bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100 text-gray-600 space-y-10 leading-relaxed text-justify">

                <section class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">01</span>
                        <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Acceptance of Terms</h3>
                    </div>
                    <p>By accessing or using the <strong>CourierXpress</strong> web system, you agree to be bound by these terms, including any additional policies referenced herein. If you do not agree with any part of these terms, please stop using the service immediately.</p>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">02</span>
                        <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Intellectual Property Rights</h3>
                    </div>
                    <p>All content on the CourierXpress system, including but not limited to text, graphics, logos, images, source code, and user interfaces, is the property of <strong>CourierXpress Logistics</strong> and is protected by copyright laws. Any duplication, modification, or reuse for commercial purposes without prior written consent is strictly prohibited.</p>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">03</span>
                        <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">User Responsibilities</h3>
                    </div>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Users must provide accurate information regarding goods, sender/receiver addresses, and package weight for precise automated fee calculation.</li>
                        <li>Users are responsible for maintaining the confidentiality of their personal login credentials and passwords.</li>
                        <li>Users must absolutely not post any obscene, illegal content, spam, or perform actions attempting to hack or disrupt the system.</li>
                    </ul>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">04</span>
                        <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Limitation of Liability</h3>
                    </div>
                    <p>CourierXpress makes every effort to ensure the system operates stably 24/7. However, we are not liable for any direct or indirect damages arising from the use of the service, including network transmission errors, hardware failures, or misleading information provided by users.</p>
                </section>

                <section class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="bg-primary-50 text-primary-600 w-8 h-8 rounded-full flex items-center justify-center font-bold">05</span>
                        <h3 class="text-xl font-bold text-gray-800 uppercase tracking-tight">Account Termination</h3>
                    </div>
                    <p>We reserve the right to lock or terminate your account immediately without prior notice if you violate any of the aforementioned terms or engage in behavior harmful to the reputation and operation of the system.</p>
                </section>

            </div>
        </div>
    </main>
@endsection
