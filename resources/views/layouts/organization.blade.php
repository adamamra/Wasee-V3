<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة تحكم المؤسسة - وصيّ')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

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
        body {
            font-family: 'Tajawal', 'Inter', sans-serif;
        }

        .org-nav {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .org-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .org-nav-link {
            position: relative;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
        }

        .org-nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-1px);
        }

        .org-nav-link.active {
            color: white;
            background: rgba(99, 102, 241, 0.2);
        }

        .org-badge {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.125rem 0.5rem;
            border-radius: 9999px;
            margin-right: 0.5rem;
        }

        .org-logout-btn {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .org-logout-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-1px);
        }

        footer {
            display: none !important;
            visibility: hidden !important;
            height: 0 !important;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden !important;
        }

        .org-container {
            min-height: calc(100vh - 80px);
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
        }

        .success-alert {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .error-alert {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border: none;
            border-radius: 0.75rem;
            padding: 1rem 1.5rem;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="org-nav shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="{{ route('organization.dashboard') }}" class="org-brand flex items-center gap-3">
                    <i class="fas fa-building text-2xl"></i>
                    <span>لوحة تحكم المؤسسة</span>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-1 space-x-reverse">
                    <a href="{{ route('organization.dashboard') }}" class="org-nav-link {{ request()->routeIs('organization.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-search ml-2"></i>
                        البحث عن طلب
                    </a>
                    
                    <a href="{{ route('organization.delivered-parcels.index') }}" class="org-nav-link {{ request()->routeIs('organization.delivered-parcels.*') ? 'active' : '' }}">
                        <i class="fas fa-box ml-2"></i>
                        الطلبات المسلّمة
                        @php
                            $deliveredCount = auth('organization')->user()->parcels()->where('status', 'delivered')->count();
                        @endphp
                        @if($deliveredCount > 0)
                            <span class="org-badge">{{ $deliveredCount }}</span>
                        @endif
                    </a>
                    
                    <a href="{{ route('organization.profile.show') }}" class="org-nav-link {{ request()->routeIs('organization.profile.*') ? 'active' : '' }}">
                        <i class="fas fa-user-circle ml-2"></i>
                        الملف الشخصي
                    </a>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('organization.logout') }}">
                    @csrf
                    <button type="submit" class="org-logout-btn">
                        <i class="fas fa-sign-out-alt ml-2"></i>
                        تسجيل خروج
                    </button>
                </form>

                <!-- Mobile Menu Button -->
                <button x-data="{ mobileMenuOpen: false }" @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-white hover:bg-white/10 p-2 rounded-lg transition-colors">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>

            <!-- Mobile Navigation -->
            <div x-data="{ mobileMenuOpen: false }" 
                 x-show="mobileMenuOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="md:hidden py-3 border-t mt-3 bg-gray-800/50 rounded-b-xl">
                <div class="space-y-2">
                    <a href="{{ route('organization.dashboard') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-200">
                        <i class="fas fa-search ml-2"></i>
                        البحث عن طلب
                    </a>
                    <a href="{{ route('organization.delivered-parcels.index') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-200">
                        <i class="fas fa-box ml-2"></i>
                        الطلبات المسلّمة
                        @if($deliveredCount > 0)
                            <span class="org-badge">{{ $deliveredCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('organization.profile.show') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-200">
                        <i class="fas fa-user-circle ml-2"></i>
                        الملف الشخصي
                    </a>
                    <a href="{{ route('organization.parcels.export-pending') }}" class="block px-4 py-2 rounded-lg text-white hover:bg-white/10 transition-all duration-200">
                        <i class="fas fa-file-excel ml-2"></i>
                        تصدير طلبات قيد الانتظار
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="org-container">
        <div class="container mx-auto px-4 py-8">
            @if(session('success'))
                <div class="success-alert mb-6 flex items-center gap-3">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="error-alert mb-6 flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
