@extends('customer.layout')

@section('title', 'Liên hệ với chúng tôi - CourierXpress')

@section('content')

<main class="flex-grow pt-32 pb-20 px-6">
    <div class="max-w-6xl mx-auto">
        <div class="grid md:grid-cols-2 gap-12 mb-16">
            <div class="space-y-8">
                <h2 class="text-4xl font-black text-gray-900 leading-tight">Liên hệ với <br><span class="text-primary-600">chúng tôi</span></h2>
                <p class="text-gray-500">Chúng tôi luôn sẵn sàng hỗ trợ giải đáp thắc mắc của bạn 24/7.</p>
                <div class="space-y-4">
                    <div class="flex items-center space-x-4 text-gray-600">
                        <div class="bg-red-50 p-3 rounded-lg text-primary-600"><i data-lucide="mail"></i></div>
                        <span>support@courierxpress.vn</span>
                    </div>
                    <div class="flex items-center space-x-4 text-gray-600">
                        <div class="bg-red-50 p-3 rounded-lg text-primary-600"><i data-lucide="phone"></i></div>
                        <span>1900 123 456</span>
                    </div>
                    <div class="flex items-center space-x-4 text-gray-600">
                        <div class="bg-red-50 p-3 rounded-lg text-primary-600"><i data-lucide="map-pin"></i></div>
                        <span>13 Phan Tây Nhạc, Xuân Phương, Hà Nội</span>
                    </div>
                </div>
            </div>
            <form class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 space-y-4">
                <input type="text" placeholder="Họ và tên" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
                <input type="email" placeholder="Email" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50">
                <textarea placeholder="Tin nhắn của bạn" rows="4" class="w-full px-4 py-3 rounded-xl border border-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 bg-gray-50"></textarea>
                <button class="w-full bg-primary-600 text-white py-3 rounded-xl font-bold hover:bg-primary-700 transition-all">Gửi yêu cầu</button>
            </form>
        </div>

        <!-- BẢN ĐỒ SECTION -->
        <div class="w-full h-[450px] rounded-3xl overflow-hidden shadow-inner border border-gray-200">
            <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.7982501103975!2d105.73387907750313!3d21.04075703739847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3134548b31b14f55%3A0x7a4256e5f1aa0c84!2zMTMgUGhhbiBUw6J5IE5o4bqhYywgWHXDom4gUGjGsMahbmcsIEjDoCBO4buZaSwgVmlldG5hbQ!5e0!3m2!1sen!2sus!4v1778093006430!5m2!1sen!2sus"
                    width="100%"
                    height="100%"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</main>
@endsection