@extends('customer.layout')

@section('title', 'Services - CourierXpress')

@section('content')
    <main class="flex-grow pt-32 pb-20 px-6">
        <div class="max-w-6xl mx-auto space-y-24">

            {{-- Hero --}}
            <div class="text-center space-y-5">
            <span class="inline-block bg-primary-50 text-primary-600 text-xs font-bold uppercase tracking-widest px-4 py-2 rounded-full border border-primary-100">
                Shipping Solutions
            </span>
                <h2 class="text-5xl font-black text-gray-900 tracking-tight leading-tight">
                    <span class="gradient-text">CourierXpress</span> Services
                </h2>
                <p class="text-gray-500 text-xl max-w-2xl mx-auto font-medium leading-relaxed">
                    We offer a wide range of logistics solutions — from express delivery to comprehensive warehousing, catering to all business sizes.
                </p>
            </div>

            {{-- Core Services --}}
            <div class="space-y-6">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                    <span class="w-8 h-1 bg-primary-600 rounded-full"></span>
                    Core Services
                </h3>
                <div class="grid md:grid-cols-2 gap-6">

                    {{-- Standard Shipping --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-primary-50 rounded-2xl flex items-center justify-center text-primary-600 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="package" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Standard Delivery</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Domestic shipping service with delivery times ranging from 2–5 business days. Perfect for general cargo with optimized costs and high reliability.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Nationwide coverage across 63 provinces</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Maximum weight up to 50kg per parcel</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Cargo insurance based on declared value</li>
                        </ul>
                    </div>

                    {{-- Express Shipping --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="zap" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Express Delivery</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Speed-prioritized service — delivering within the same day or within 24 hours. Ideal for urgent documents, seasonal goods, or e-commerce orders.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Same-day delivery for metropolitan areas</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Real-time shipment tracking status</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Instant digital delivery confirmation</li>
                        </ul>
                    </div>

                    {{-- Warehouse & Fulfillment --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="warehouse" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">Warehousing & Fulfillment</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Flexible storage solutions combined with automated order processing. Let businesses focus on sales while we take care of all the backend logistics.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> WMS system for real-time inventory tracking</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Professional packaging and labeling services</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Built-in integration with Shopee, Lazada, TikTok Shop</li>
                        </ul>
                    </div>

                    {{-- API Integration --}}
                    <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 hover:border-primary-200 hover:shadow-md transition-all group">
                        <div class="w-14 h-14 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500 mb-6 group-hover:scale-110 transition-transform">
                            <i data-lucide="code-2" class="w-7 h-7"></i>
                        </div>
                        <h4 class="text-xl font-bold text-gray-900 mb-3">API Integration</h4>
                        <p class="text-gray-500 leading-relaxed mb-5">
                            Connect your native system with the CourierXpress platform via our RESTful API. Automate waybill generation, route lookups, and real-time status updates.
                        </p>
                        <ul class="space-y-2 text-sm text-gray-500">
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Standard RESTful API endpoints with Sandbox environment</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Webhook endpoints for automated order updates</li>
                            <li class="flex items-center gap-2"><i data-lucide="check-circle" class="w-4 h-4 text-green-500 shrink-0"></i> Comprehensive developer technical documentation</li>
                        </ul>
                    </div>

                </div>
            </div>

            {{-- Pricing Matrix --}}
            <div class="space-y-8">
                <div class="text-center space-y-2">
                    <h3 class="text-2xl font-bold text-gray-900">Standard Pricing Rates</h3>
                    <p class="text-gray-500">Rates exclude remote area surcharges and special cargo handling. Contact us for bulk volume quotes.</p>
                </div>
                <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm">
                    <table class="w-full text-sm">
                        <thead>
                        <tr class="bg-gray-50 text-gray-600 font-semibold">
                            <th class="text-left px-6 py-4">Service</th>
                            <th class="text-left px-6 py-4">Coverage</th>
                            <th class="text-left px-6 py-4">Delivery Time</th>
                            <th class="text-left px-6 py-4">Starting From</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Standard Delivery</td>
                            <td class="px-6 py-4 text-gray-500">Nationwide</td>
                            <td class="px-6 py-4 text-gray-500">2–5 Days</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">15,000 VNĐ</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Express Delivery</td>
                            <td class="px-6 py-4 text-gray-500">Metropolitan</td>
                            <td class="px-6 py-4 text-gray-500">Same Day</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">35,000 VNĐ</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Fast Inter-provincial</td>
                            <td class="px-6 py-4 text-gray-500">Nationwide</td>
                            <td class="px-6 py-4 text-gray-500">1–2 Days</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">25,000 VNĐ</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-800">Fulfillment</td>
                            <td class="px-6 py-4 text-gray-500">Nationwide</td>
                            <td class="px-6 py-4 text-gray-500">Based on SLA</td>
                            <td class="px-6 py-4 text-primary-600 font-bold">Contact Us</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Why Choose Us --}}
            <div class="bg-gray-900 rounded-[3rem] p-12 text-white overflow-hidden relative">
                <div class="absolute top-0 right-0 w-80 h-80 bg-primary-600 rounded-full opacity-5 translate-x-24 -translate-y-24"></div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-10 text-center">Why Choose CourierXpress?</h3>
                    <div class="grid md:grid-cols-4 gap-8 text-center">
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-primary-400">
                                <i data-lucide="shield-check" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">Absolute Security</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">100% value cargo insurance, providing rapid compensations whenever exceptions happen.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-orange-400">
                                <i data-lucide="clock" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">On-Time Commitment</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Over 98% on-time delivery success rate — with explicit SLA terms signed for each package model.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-blue-400">
                                <i data-lucide="map-pin" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">Real-time Tracking</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Step-by-step cargo tracking updates integrated with automated SMS and email hooks.</p>
                        </div>
                        <div class="space-y-3">
                            <div class="mx-auto w-14 h-14 bg-white/10 rounded-2xl flex items-center justify-center text-green-400">
                                <i data-lucide="headphones" class="w-7 h-7"></i>
                            </div>
                            <h4 class="font-bold">24/7 Support Desk</h4>
                            <p class="text-gray-400 text-sm leading-relaxed">Our support crew is always ready via dedicated hotlines, live chat, and email tickets anywhere.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CTA --}}
            <div class="text-center space-y-6">
                <h3 class="text-3xl font-bold text-gray-900">Ready to get started?</h3>
                <p class="text-gray-500 max-w-xl mx-auto">Create a free account today and experience the smart delivery management platform of CourierXpress.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('register') }}"
                       class="bg-primary-600 text-white px-8 py-3.5 rounded-xl font-semibold hover:bg-primary-700 transition-all shadow-md hover:shadow-lg">
                        Sign Up For Free
                    </a>
                    <a href="{{ route('contact') }}"
                       class="border border-gray-200 text-gray-700 px-8 py-3.5 rounded-xl font-semibold hover:border-primary-300 hover:text-primary-600 transition-all">
                        Request Consultation
                    </a>
                </div>
            </div>

        </div>
    </main>
@endsection
