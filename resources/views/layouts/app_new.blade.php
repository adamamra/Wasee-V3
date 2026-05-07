<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'وصيّ - نظام إدارة الوصاية')</title>
    
    <!-- الخطوط -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- الأيقونات -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Tajawal', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            DEFAULT: '#4f46e5',
                            hover: '#4338ca',
                        },
                        secondary: '#6b7280',
                        success: '#10b981',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                        info: '#3b82f6',
                        light: '#f9fafb',
                        dark: '#111827',
                    },
                },
            },
        }
    </script>
    
    <style>
        .btn {
            @apply px-4 py-2 rounded-lg font-medium transition-all duration-200 flex items-center justify-center;
        }
        
        .btn-primary {
            @apply bg-primary text-white hover:bg-primary-hover;
        }
        
        .btn-outline {
            @apply border border-primary text-primary hover:bg-primary/10;
        }
        
        .form-input {
            @apply w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none transition;
        }
        
        .card {
            @apply bg-white rounded-xl shadow-sm overflow-hidden;
        }
        
        .nav-link {
            @apply text-gray-600 hover:text-primary px-3 py-2 rounded-lg transition-colors;
        }
        
        .nav-link.active {
            @apply bg-primary/5 text-primary font-medium;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    <!-- شريط التنقل -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- الشعار -->
                <a href="{{ url('/') }}" class="flex items-center space-x-2 space-x-reverse">
                    <div class="w-9 h-9 bg-primary rounded-lg flex items-center justify-center text-white">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">وصيّ</span>
                </a>

                <!-- القائمة الرئيسية -->
                <nav class="hidden md:flex items-center space-x-1 space-x-reverse">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        الرئيسية
                    </a>
                    <a href="{{ route('parcels.index') }}" class="nav-link {{ request()->routeIs('parcels.*') ? 'active' : '' }}">
                        الطرود
                    </a>
                    <a href="{{ route('organizations.index') }}" class="nav-link {{ request()->routeIs('organizations.*') ? 'active' : '' }}">
                        الجهات
                    </a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                لوحة التحكم
                            </a>
                        @endif
                    @endauth
                </nav>

                <!-- أزرار المستخدم -->
                <div class="flex items-center space-x-3 space-x-reverse">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline hidden md:inline-flex">
                            تسجيل الدخول
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            إنشاء حساب
                        </a>
                    @else
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2 space-x-reverse focus:outline-none">
                                <span class="hidden md:inline text-sm font-medium text-gray-700">
                                    {{ Auth::user()->name }}
                                </span>
                                <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center text-primary border-2 border-gray-200">
                                    <i class="fas fa-user"></i>
                                </div>
                            </button>
                            
                            <!-- القائمة المنسدلة -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute left-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50 divide-y divide-gray-100">
                                <div class="py-1">
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <i class="fas fa-user-circle ml-2"></i> الملف الشخصي
                                    </a>
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 w-full text-right">
                                        <i class="fas fa-sign-out-alt ml-2"></i> تسجيل الخروج
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                    
                    <!-- زر القائمة المنسدلة للهواتف -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 hover:text-gray-900 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- القائمة المتنقلة للهواتف -->
            <div x-show="mobileMenuOpen" class="md:hidden py-2 border-t mt-2">
                <div class="space-y-1">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-100' }}">
                        الرئيسية
                    </a>
                    <a href="{{ route('parcels.index') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('parcels.*') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-100' }}">
                        الطرود
                    </a>
                    <a href="{{ route('organizations.index') }}" class="block px-3 py-2 rounded-lg {{ request()->routeIs('organizations.*') ? 'bg-primary/5 text-primary' : 'text-gray-700 hover:bg-gray-100' }}">
                        الجهات
                    </a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                                لوحة التحكم
                            </a>
                        @endif
                        
                        <div class="pt-2 border-t mt-2">
                            <a href="{{ route('profile.show') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user-circle ml-2"></i> الملف الشخصي
                            </a>
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();"
                               class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt ml-2"></i> تسجيل الخروج
                            </a>
                            <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="flex space-x-3 space-x-reverse pt-2 border-t mt-2">
                            <a href="{{ route('login') }}" class="flex-1 text-center btn btn-outline">
                                تسجيل الدخول
                            </a>
                            <a href="{{ route('register') }}" class="flex-1 text-center btn btn-primary">
                                إنشاء حساب
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- المحتوى الرئيسي -->
    <main class="flex-1">
        @if(session('success'))
            <div class="bg-green-50 border-r-4 border-green-500 p-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-green-500">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-r-4 border-red-500 p-4 mb-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-red-500">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="mr-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{ $slot }}
    </main>

    <!-- تذييل الصفحة -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">عن وصيّ</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        منصة متكاملة لإدارة طلبات الوصاية ومتابعتها بكل سهولة وأمان.
                    </p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-primary transition">الرئيسية</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition">من نحن</a></li>
                        <li><a href="#" class="text-gray-600 hover:text-primary transition">اتصل بنا</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">تواصل معنا</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-phone-alt ml-2 text-primary"></i>
                            <span>+966 12 345 6789</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-envelope ml-2 text-primary"></i>
                            <span>info@wasi.sa</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-200 mt-8 pt-6 text-center text-gray-500 text-sm">
                <p>جميع الحقوق محفوظة &copy; {{ date('Y') }} وصيّ</p>
            </div>
        </div>
    </footer>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- نصوص JavaScript -->
    <script>
        // تفعيل القائمة المنسدلة للهواتف
        document.addEventListener('alpine:init', () => {
            Alpine.data('app', () => ({
                mobileMenuOpen: false,
                toggleMobileMenu() {
                    this.mobileMenuOpen = !this.mobileMenuOpen;
                }
            }));
        });

        // إظهار وإخفاء كلمة المرور
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.querySelector(`[onclick="togglePassword('${inputId}')"] i`);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>

    @stack('scripts')
</body>
</html>
