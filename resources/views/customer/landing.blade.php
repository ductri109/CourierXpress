@extends('customer.layout')

@section('title', 'CourierXpress - Comprehensive Logistics Solutions')

@section('content')

    <section class="gradient-hero min-h-screen pt-32 pb-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-white space-y-8 scroll-reveal">
                    <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                        <span class="text-sm font-medium">System is operating normally</span>
                    </div>

                    <h1 class="text-5xl lg:text-7xl font-bold leading-tight">
                        Comprehensive <br><span class="text-yellow-300">Logistics</span> Solutions
                    </h1>

                    <p class="text-xl text-white/90 max-w-xl leading-relaxed">
                        Welcome to CourierXpress system. Managing waybills, tracking routes, and updating real-time statuses are easier than ever.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        <a href="{{ route('booking') }}" class="bg-yellow-400 text-primary-900 px-8 py-3.5 rounded-xl font-bold hover:bg-yellow-300 transition-all shadow-lg text-center flex items-center justify-center space-x-2">
                            <i data-lucide="plus-circle" class="w-5 h-5"></i>
                            <span>Create New Order</span>
                        </a>

                        <a href="{{ route('tracking') }}" class="bg-white/20 text-white backdrop-blur-md border border-white/30 px-8 py-3.5 rounded-xl font-bold hover:bg-white/30 transition-all shadow-lg text-center flex items-center justify-center space-x-2">
                            <i data-lucide="search" class="w-5 h-5"></i>
                            <span>Track Waybill</span>
                        </a>
                    </div>

                    <div class="flex space-x-8 pt-6 border-t border-white/20 mt-8">
                        <div>
                            <p class="text-3xl font-bold">63</p>
                            <p class="text-white/70 text-sm">Provinces</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">24/7</p>
                            <p class="text-white/70 text-sm">Real-time Updates</p>
                        </div>
                        <div>
                            <p class="text-3xl font-bold">99.8%</p>
                            <p class="text-white/70 text-sm">On Time Delivery</p>
                        </div>
                    </div>
                </div>

                <div class="relative scroll-reveal">
                    <div class="relative floating">
                        <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80" alt="Logistics Banner Smart Supply Chain"
                             class="rounded-3xl shadow-2xl w-full border-4 border-white/10 object-cover h-[431px]">

                        <div class="absolute -left-8 top-1/4 bg-white p-4 rounded-2xl shadow-xl animate-bounce" style="animation-duration: 3s;">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                    <i data-lucide="check-circle" class="w-6 h-6 text-green-600"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">Delivered Successfully</p>
                                    <p class="text-sm text-gray-500">Order #CX892341</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -right-4 bottom-1/4 bg-white p-4 rounded-2xl shadow-xl animate-bounce" style="animation-duration: 4s;">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                                    <i data-lucide="map-pin" class="w-6 h-6 text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800">In Transit</p>
                                    <p class="text-sm text-gray-500">Updated 1 min ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Key Features</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3">Everything you need for waybill management</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Experience modern logistics technology packed with smart components from CourierXpress</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="map" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Real-time Tracking</h3>
                    <p class="text-gray-600 leading-relaxed">Check your shipment location live, continuously updated with high precision.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="bell" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Smart Notifications</h3>
                    <p class="text-gray-600 leading-relaxed">Receive instant alerts via SMS, Zalo, and Email whenever order statuses shift.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="package-plus" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Instant Booking</h3>
                    <p class="text-gray-600 leading-relaxed">System allows bulk order creation and management, maximizing processing speeds.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="shield-check" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">100% Insurance</h3>
                    <p class="text-gray-600 leading-relaxed">Every item is covered by cargo value protection. Full refund given if issues occur within 24H.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="bar-chart-3" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Visual Statistics</h3>
                    <p class="text-gray-600 leading-relaxed">Monitor delivery efficiency and shipping costs with a clean, transparent data reporting panel.</p>
                </div>

                <div class="group p-8 rounded-3xl gradient-card hover:shadow-2xl transition-all duration-300 scroll-reveal">
                    <div class="w-16 h-16 bg-primary-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <i data-lucide="headphones" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">Our support crew is always ready to handle complaints and lookup issues at any time.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="pricing" class="py-24 px-4 sm:px-6 lg:px-8 bg-primary-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Pricing Guide</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3">Optimize Shipping Expenses</h2>
                <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Transparent freight pricing with appealing discounts for long-term partners on CourierXpress.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all scroll-reveal">
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold text-gray-900">Standard</h3>
                        <p class="text-gray-500 text-sm mt-2">For individual individual senders</p>
                        <div class="mt-6">
                            <span class="text-5xl font-bold text-gray-900">25K</span>
                            <span class="text-gray-500">/order</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Local city delivery in 24H</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Doorstep courier pickup</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Basic compensation tier</span>
                        </li>
                        <li class="flex items-center space-x-3 opacity-50">
                            <i data-lucide="x" class="w-5 h-5 text-gray-400"></i>
                            <span class="text-gray-400">Scheduled hour delivery</span>
                        </li>
                    </ul>
                    <button class="w-full py-4 border-2 border-primary-600 text-primary-600 rounded-xl font-bold hover:bg-primary-600 hover:text-white transition-all">
                        Book Order Now
                    </button>
                </div>

                <div class="bg-primary-600 rounded-3xl p-8 shadow-2xl transform md:scale-105 relative scroll-reveal">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-yellow-400 text-primary-900 px-4 py-1 rounded-full text-sm font-bold whitespace-nowrap">
                        Recommended
                    </div>
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold text-white">Express</h3>
                        <p class="text-primary-200 text-sm mt-2">Tailored for online shops</p>
                        <div class="mt-6">
                            <span class="text-5xl font-bold text-white">35K</span>
                            <span class="text-primary-200">/order</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Local city delivery in 2H-4H</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Real-time route tracking</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Free COD cash collection</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Full insurance policy cover</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-yellow-300"></i>
                            <span class="text-white">Priority exception handling</span>
                        </li>
                    </ul>
                    <button class="w-full py-4 bg-white text-primary-600 rounded-xl font-bold hover:bg-yellow-400 hover:text-primary-900 transition-all">
                        Book Order Now
                    </button>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all scroll-reveal">
                    <div class="text-center mb-8">
                        <h3 class="text-xl font-bold text-gray-900">Enterprise</h3>
                        <p class="text-gray-500 text-sm mt-2">Volume >500 orders/month</p>
                        <div class="mt-6">
                            <span class="text-5xl font-bold text-gray-900">Contact Us</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Custom dedicated price rates</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">API endpoints for ERP systems</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Warehousing & Fulfillment</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Flexible reconciliation flows</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                            <span class="text-gray-600">Dedicated account executive</span>
                        </li>
                    </ul>
                    <button class="w-full py-4 border-2 border-primary-600 text-primary-600 rounded-xl font-bold hover:bg-primary-600 hover:text-white transition-all">
                        Request Consultation
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="py-24 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 scroll-reveal">
                <span class="text-primary-600 font-semibold text-sm uppercase tracking-wider">Reviews</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-3">What partners say about CourierXpress</h2>
                <p class="text-gray-600 mt-4">Thousands of store owners trust our integrated logistics solution</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-3xl p-8 scroll-reveal">
                    <div class="flex items-center space-x-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Incredibly fast delivery, friendly couriers. The waybill tracking app is highly functional, showing exactly when parcels will land. Highly recommend CourierXpress!"</p>
                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&w=150&h=150&q=80"
                             alt="Nguyen Thi Huong" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-gray-900">Nguyen Thi Huong</p>
                            <p class="text-sm text-gray-500">Fashion Store Owner</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 scroll-reveal">
                    <div class="flex items-center space-x-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Since onboarding with CourierXpress, our successful completion delivery rates spiked by 30%. Senders give very positive feedback on speed and rider attitude."</p>
                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=150&h=150&q=80" alt="Tran Minh Tuan" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-gray-900">Tran Minh Tuan</p>
                            <p class="text-sm text-gray-500">Distribution Agent</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 rounded-3xl p-8 scroll-reveal">
                    <div class="flex items-center space-x-1 mb-4">
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                        <i data-lucide="star" class="w-5 h-5 text-yellow-400 fill-yellow-400"></i>
                    </div>
                    <p class="text-gray-700 mb-6 leading-relaxed">"Intuitive UI panel, rapid order creation. I absolute love the transparent COD cash reconciliation system—payouts hit the bank account on schedule every week."</p>
                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=150&h=150&q=80" alt="Le Thi Mai" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-gray-900">Le Thi Mai</p>
                            <p class="text-sm text-gray-500">E-commerce Retailer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
