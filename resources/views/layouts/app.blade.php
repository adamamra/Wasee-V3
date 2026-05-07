<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'وصيّ - نظام إدارة الوصاية')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons & Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
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
                            DEFAULT: '#6366f1',
                            hover: '#4f46e5',
                        },
                        secondary: '#10b981',
                        accent: '#f59e0b',
                        danger: '#ef4444',
                        warning: '#f59e0b',
                        info: '#3b82f6',
                        light: '#f8fafc',
                        dark: '#1e293b',
                    },
                },
            },
        }
    </script>
    
    <style>
        .btn {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background: #334155;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1f2937;
        }

        .btn-outline {
            border: 1px solid #334155;
            color: #334155;
            background: transparent;
        }

        .btn-outline:hover {
            background: rgba(51, 65, 85, 0.08);
        }

        .form-input {
            width: 100%;
            padding: 0.5rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            outline: none;
            transition: box-shadow 0.2s, border-color 0.2s;
        }

        .form-input:focus {
            border-color: rgba(51, 65, 85, 1);
            box-shadow: 0 0 0 4px rgba(51, 65, 85, 0.15);
        }

        .card {
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .nav-link {
            color: #4b5563;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            transition: color 0.2s, background-color 0.2s;
        }

        .nav-link:hover {
            color: rgba(51, 65, 85, 1);
        }

        .nav-link.active {
            background: rgba(51, 65, 85, 0.06);
            color: rgba(51, 65, 85, 1);
            font-weight: 600;
        }

        /* Hide footer completely */
        footer {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen flex flex-col bg-gray-50">
    <!-- شريط التنقل -->
    <header x-data="{ mobileMenuOpen: false }" class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- الشعار -->
                <a href="{{ url('/') }}" class="flex items-center space-x-2 space-x-reverse group">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary to-primary-hover rounded-xl flex items-center justify-center text-white transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <i class="fas fa-shield-alt text-lg"></i>
                    </div>
                    <span class="text-xl font-bold bg-gradient-to-r from-primary to-primary-hover bg-clip-text text-transparent">وصيّ</span>
                </a>

                <!-- القائمة الرئيسية -->
                <nav class="hidden md:flex items-center space-x-1 space-x-reverse">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        الرئيسية
                    </a>
                    @auth
                        @if (Route::has('organizations.index'))
                            <a href="{{ route('organizations.index') }}" class="nav-link {{ request()->routeIs('organizations.*') ? 'active' : '' }}">
                                الجهات
                            </a>
                        @endif
                    @endauth
                </nav>

                @auth
                    <div class="hidden md:flex items-center gap-3">
                        @if (Route::has('parcels.create'))
                            <a href="{{ route('parcels.create') }}" class="btn btn-primary transform hover:scale-105 transition-all duration-200">
                                <i class="fas fa-plus-circle"></i>
                                <span>طلب جديد</span>
                            </a>
                        @endif
                        @if (Route::has('parcels.my'))
                            <a href="{{ route('parcels.my') }}" class="btn btn-outline transform hover:scale-105 transition-all duration-200">
                                <i class="fas fa-list"></i>
                                <span>عرض طلباتي</span>
                            </a>
                        @endif
                    </div>
                @endauth

                <!-- أزرار المستخدم -->
                <div class="flex items-center space-x-3 space-x-reverse">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-outline hidden md:inline-flex transform hover:scale-105 transition-all duration-200">
                            تسجيل الدخول
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-primary transform hover:scale-105 transition-all duration-200">
                            إنشاء حساب
                        </a>
                    @else
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2 space-x-reverse focus:outline-none group">
                                <span class="hidden md:inline text-sm font-medium text-gray-700 group-hover:text-primary transition-colors">
                                    {{ Auth::user()->name }}
                                </span>
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-primary border-2 border-primary/20 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                                    <i class="fas fa-user"></i>
                                </div>
                            </button>
                            
                            <!-- القائمة المنسدلة -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute left-0 mt-3 w-56 rounded-xl shadow-2xl bg-white ring-1 ring-black ring-opacity-5 z-50 divide-y divide-gray-100 overflow-hidden">
                                <div class="py-2">
                                    <a href="{{ route('profile.show') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-all duration-200">
                                        <i class="fas fa-user-circle ml-3"></i> الملف الشخصي
                                    </a>
                                    @if(auth()->user()->isAdmin() && Route::has('admin.dashboard'))
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-primary/5 hover:text-primary transition-all duration-200">
                                            <i class="fas fa-gauge-high ml-3"></i> لوحة التحكم
                                        </a>
                                    @endif
                                    <a href="{{ route('logout') }}" 
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 transition-all duration-200 w-full text-right">
                                        <i class="fas fa-sign-out-alt ml-3"></i> تسجيل الخروج
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endguest
                    
                    <!-- زر القائمة المنسدلة للهواتف -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-600 hover:text-primary focus:outline-none transform hover:scale-110 transition-all duration-200">
                        <i x-show="!mobileMenuOpen" class="fas fa-bars text-xl"></i>
                        <i x-show="mobileMenuOpen" class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- القائمة المتنقلة للهواتف -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="md:hidden py-3 border-t mt-3 bg-gray-50/50 rounded-b-xl">
                <div class="space-y-2">
                    <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('home') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                        <i class="fas fa-home ml-3"></i>
                        الرئيسية
                    </a>
                    @auth
                        @if (Route::has('organizations.index'))
                            <a href="{{ route('organizations.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('organizations.*') ? 'bg-primary/10 text-primary font-medium' : 'text-gray-700 hover:bg-gray-100' }} transition-all duration-200">
                                <i class="fas fa-building ml-3"></i>
                                الجهات
                            </a>
                        @endif
                    @endauth
                    
                    @auth
                        @if (Route::has('parcels.create'))
                            <a href="{{ route('parcels.create') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                <i class="fas fa-plus-circle ml-3"></i> طلب جديد
                            </a>
                        @endif
                        @if (Route::has('parcels.my'))
                            <a href="{{ route('parcels.my') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                <i class="fas fa-list ml-3"></i> عرض طلباتي
                            </a>
                        @endif
                        <div class="pt-3 border-t border-gray-200 mt-3">
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                <i class="fas fa-user-circle ml-3"></i> الملف الشخصي
                            </a>
                            @if(auth()->user()->isAdmin() && Route::has('admin.dashboard'))
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-all duration-200">
                                    <i class="fas fa-gauge-high ml-3"></i> لوحة التحكم
                                </a>
                            @endif
                            <a href="{{ route('logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('mobile-logout-form').submit();"
                               class="block px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 transition-all duration-200">
                                <i class="fas fa-sign-out-alt ml-3"></i> تسجيل الخروج
                            </a>
                            <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="flex space-x-3 space-x-reverse pt-3 border-t border-gray-200 mt-3">
                            <a href="{{ route('login') }}" class="flex-1 text-center btn btn-outline transform hover:scale-105 transition-all duration-200">
                                تسجيل الدخول
                            </a>
                            <a href="{{ route('register') }}" class="flex-1 text-center btn btn-primary transform hover:scale-105 transition-all duration-200">
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

        @yield('content')
    </main>

    
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