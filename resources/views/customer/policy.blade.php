@extends('customer.layout')

@section('title', 'Policy - CourierXpress')

@section('content')

    <main class="flex-grow pt-32 pb-20 px-6">
        <div class="max-w-4xl mx-auto space-y-10">
            <div class="text-center space-y-3">
                <h2 class="text-3xl font-black text-gray-900 uppercase tracking-tight">Terms & <span class="text-primary-600">Policy</span></h2>
                <p class="text-gray-500 text-sm font-medium italic">Last Updated: May, 2026</p>
                <div class="h-1 w-16 bg-primary-600 mx-auto rounded-full"></div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="border-l-8 border-primary-600 p-8 md:p-12">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
                        <i data-lucide="shield-check" class="text-primary-600 w-7 h-7"></i>
                        A. Privacy Policy
                    </h3>
                    <div class="space-y-8 text-gray-600 leading-relaxed">
                        <section>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">1. Data Collection</h4>
                            <p class="text-sm">We collect basic information including your name, email address, and phone number when you register an account or use services on the CourierXpress system.</p>
                        </section>

                        <section>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">2. Data Usage</h4>
                            <p class="text-sm">The collected data is used to process orders, optimize delivery routes, improve customer service, and send important updates or promotional messages.</p>
                        </section>

                        <section>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">3. Data Security</h4>
                            <p class="text-sm">We apply the most advanced technical measures, including 256-bit SSL (Secure Sockets Layer) encryption, to protect your personal information and transaction data from unauthorized access.</p>
                        </section>

                        <section>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">4. Data Sharing</h4>
                            <p class="text-sm">CourierXpress strictly commits never to sell, rent, or share your personal information with any third party for commercial purposes.</p>
                        </section>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="border-l-8 border-gray-900 p-8 md:p-12">
                    <h3 class="text-2xl font-extrabold text-gray-900 mb-8 flex items-center gap-3">
                        <i data-lucide="truck" class="text-gray-900 w-7 h-7"></i>
                        B. Shipping & Return Policy
                    </h3>
                    <div class="space-y-8 text-gray-600 leading-relaxed">
                        <section>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">1. Service Warranty Period</h4>
                            <p class="text-sm">Our shipping service comes with a cargo safety guarantee. All products shipped through the system are protected throughout the journey until successfully signed for upon receipt.</p>
                        </section>

                        <section>
                            <h4 class="text-lg font-bold text-gray-900 mb-2">2. Returns & Claims Conditions</h4>
                            <ul class="list-disc ml-5 space-y-2 text-sm">
                                <li>Goods must have the original CourierXpress security seal intact at the time of the claim.</li>
                                <li>The product must be unused and accompanied by its electronic shipping invoice (E-receipt).</li>
                                <li>Claims regarding damage must be made within 24 hours of receiving the goods.</li>
                            </ul>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
