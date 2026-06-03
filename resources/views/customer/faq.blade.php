@extends('customer.layout') {{-- Matching your file layout.blade.php structure --}}

@section('content')
    <div class="bg-gray-50 min-h-screen pt-32 pb-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Frequently Asked Questions (<span class="text-red-600">FAQ</span>)
                </h1>
                <p class="mt-4 text-lg text-gray-500">
                    CourierXpress is always ready to answer your questions regarding shipping services and waybill management.
                </p>
            </div>

            <div class="space-y-12">
                @forelse($faqs as $category => $items)
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-4 border-l-4 border-red-600 pl-3">
                            Category: {{ $category }}
                        </h2>

                        <div class="space-y-4">
                            @foreach($items as $faq)
                                <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden transition-all duration-200">
                                    <button type="button"
                                            class="faq-toggle w-full text-left px-6 py-4 flex justify-between items-center bg-white hover:bg-gray-50 focus:outline-none"
                                            data-target="faq-answer-{{ $faq->id }}">
                                    <span class="font-semibold text-gray-900 text-base sm:text-lg pr-4">
                                        {{ $faq->question }}
                                    </span>
                                        <svg class="faq-icon h-5 w-5 text-gray-500 transform transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <div id="faq-answer-{{ $faq->id }}" class="faq-content max-h-0 overflow-hidden transition-all duration-300 ease-in-out bg-gray-50">
                                        <div class="px-6 py-4 text-gray-600 leading-relaxed border-t border-gray-100">
                                            {{ $faq->answer }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-lg shadow">
                        <p class="text-gray-500 text-lg">Currently, there are no frequently asked questions available.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggles = document.querySelectorAll('.faq-toggle');
            toggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const content = document.getElementById(targetId);
                    const icon = this.querySelector('.faq-icon');
                    const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';

                    document.querySelectorAll('.faq-content').forEach(c => c.style.maxHeight = '0px');
                    document.querySelectorAll('.faq-icon').forEach(i => i.classList.remove('rotate-180'));

                    if (!isOpen) {
                        content.style.maxHeight = content.scrollHeight + 'px';
                        icon.classList.add('rotate-180');
                    } else {
                        content.style.maxHeight = '0px';
                        icon.classList.remove('rotate-180');
                    }
                });
            });
        });
    </script>
@endsection
