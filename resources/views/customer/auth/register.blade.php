<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CourierXpress Logistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 50%, #7f1d1d 100%);
        }
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .input-focus:focus {
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.2);
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-gray-50 min-h-screen">
<div class="min-h-screen flex">
    <div class="hidden lg:flex lg:w-1/2 gradient-bg relative overflow-hidden items-center justify-center">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="relative z-10 text-white px-12 max-w-lg">
            <a href="{{ route('landing') }}" class="flex items-center space-x-3 mb-12 hover:opacity-90 transition-opacity">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                    <i data-lucide="package" class="w-8 h-8 text-white"></i>
                </div>
                <div>
                    <h1 class="text-3xl font-bold">CourierXpress</h1>
                    <p class="text-sm text-white/80 font-medium">LOGISTICS</p>
                </div>
            </a>

            <h2 class="text-4xl font-bold mb-6 leading-tight">
                Start your journey<br>
                <span class="text-yellow-300">of express delivery</span>
            </h2>

            <p class="text-xl text-white/90 mb-8 leading-relaxed">
                Join 50,000+ customers using CourierXpress Logistics to optimize their logistics.
            </p>

            <div class="space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-white/90">First 10 shipments free</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-white/90">Real-time order tracking</span>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-white/90">Dedicated 24/7 support</span>
                </div>
            </div>

            <div class="mt-12 floating">
                <img src="data:image/jpeg;base64,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" alt="Delivery" class="rounded-2xl shadow-2xl w-full">
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/2 flex items-center justify-center px-4 sm:px-6 lg:px-8 py-12">
        <div class="w-full max-w-md">
            <a href="{{ route('landing') }}" class="lg:hidden flex items-center justify-center space-x-3 mb-8 hover:opacity-90 transition-opacity">
                <div class="w-12 h-12 bg-primary-600 rounded-xl flex items-center justify-center">
                    <i data-lucide="package" class="w-7 h-7 text-white"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-primary-700">FastDelivery</h1>
                    <p class="text-xs text-primary-500 font-medium">PRO</p>
                </div>
            </a>

            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Create a new account</h2>
                <p class="text-gray-600 mt-2">Enter your details to get started</p>
            </div>

            <form class="space-y-5" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="user" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="text" name="full_name" value="{{ old('full_name') }}" placeholder="John Doe"
                               class="w-full pl-12 pr-4 py-3 bg-white border-2 @error('full_name') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                    </div>
                    @error('full_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="phone" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+1 234 567 890"
                               class="w-full pl-12 pr-4 py-3 bg-white border-2 @error('phone') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                    </div>
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="mail" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
                               class="w-full pl-12 pr-4 py-3 bg-white border-2 @error('email') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                    </div>
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••"
                               class="w-full pl-12 pr-12 py-3 bg-white border-2 @error('password') border-red-500 @else border-gray-200 @enderror rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                        <button type="button" onclick="togglePassword('password', this)"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i data-lucide="lock" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="password" id="confirmPassword" name="password_confirmation" placeholder="••••••••"
                               class="w-full pl-12 pr-12 py-3 bg-white border-2 border-gray-200 rounded-xl focus:border-primary-500 focus:outline-none input-focus transition-all">
                        <button type="button" onclick="togglePassword('confirmPassword', this)"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="flex items-start space-x-3">
                    <input type="checkbox" id="terms" class="w-5 h-5 rounded border-2 border-gray-300 text-primary-600 focus:ring-primary-500 mt-0.5" required>
                    <label for="terms" class="text-sm text-gray-600">
                        I agree to the <a href="{{ route('terms') }}" class="text-primary-600 hover:text-primary-700 font-medium">Terms of Service</a> and
                        <a href="{{ route('policy') }}" class="text-primary-600 hover:text-primary-700 font-medium">Privacy Policy</a> of CourierXpress Logistics
                    </label>
                </div>

                <button type="submit"
                        class="w-full bg-primary-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-primary-700 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center space-x-2">
                    <span>Register Now</span>
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-primary-600 font-semibold hover:text-primary-700">Login</a>
                </p>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('landing') }}" class="inline-flex items-center space-x-2 text-gray-500 hover:text-primary-600 transition-colors">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Back to Homepage</span>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/lucide@latest"></script>
<script>
    // Initialize Lucide icons
    lucide.createIcons();

    // Toggle password visibility
    function togglePassword(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.setAttribute('data-lucide', 'eye-off');
        } else {
            input.type = 'password';
            icon.setAttribute('data-lucide', 'eye');
        }
        lucide.createIcons();
    }
</script>
</body>
</html>
