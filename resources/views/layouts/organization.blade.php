<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة تحكم المؤسسة - وصيّ')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Tajawal', 'sans-serif'] },
                    colors: {
                        primary: { DEFAULT: '#6366f1', 50: '#eef2ff', 100: '#e0e7ff', 200: '#c7d2fe', 300: '#a5b4fc', 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81' },
                        secondary: { DEFAULT: '#10b981', 50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0', 300: '#6ee7b7', 400: '#34d399', 500: '#10b981', 600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b' },
                    },
                },
            },
        }
    </script>
    <style>
        * { scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
        body { font-family: 'Tajawal', sans-serif; background: #f8fafc; }
        .org-container { @apply bg-gradient-to-br from-gray-50 via-white to-gray-50; }
        .card { @apply bg-white rounded-2xl shadow-sm border border-gray-100; }
        .btn-primary { @apply inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 active:scale-95 transition-all duration-200 shadow-lg shadow-primary-500/20 hover:shadow-xl hover:shadow-primary-500/30; }
        .btn-secondary { @apply inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-gray-700 font-bold rounded-xl border-2 border-gray-200 hover:border-primary-300 hover:text-primary-600 active:scale-95 transition-all duration-200; }
        .input-custom { @apply w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none; }
        .badge { @apply inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold; }
    </style>
</head>
<body class="bg-gray-50">
    <header class="bg-[#0f172a] border-b border-white/10">
        <div class="container mx-auto px-4 sm:px-6">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('organization.dashboard') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white shadow-lg shadow-primary-500/30 text-sm"><i class="fas fa-building"></i></div>
                    <span class="text-base font-black text-white">وصيّ</span>
                    <span class="hidden sm:inline text-xs text-gray-500 font-medium mr-1">| بوابة المؤسسات</span>
                </a>

                <div class="flex items-center gap-1">
                    <a href="{{ route('organization.dashboard') }}" class="flex items-center gap-2.5 px-4 py-2 rounded-lg text-sm font-bold text-white hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('organization.dashboard') ? 'bg-primary-500/20 text-primary-200' : '' }}">
                        <i class="fas fa-search text-xs"></i>
                        <span>بحث</span>
                    </a>
                    <a href="{{ route('organization.delivered-parcels.index') }}" class="flex items-center gap-2.5 px-4 py-2 rounded-lg text-sm font-bold text-white hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('organization.delivered-parcels.*') ? 'bg-primary-500/20 text-primary-200' : '' }}">
                        <i class="fas fa-box text-xs"></i>
                        <span>مسلّم</span>
                        @php $deliveredCount = auth('organization')->user()->parcels()->where('status', 'delivered')->count(); @endphp
                        @if($deliveredCount > 0)
                            <span class="px-1.5 py-0.5 bg-red-500 text-white text-[10px] rounded-full font-bold leading-none">{{ $deliveredCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('organization.profile.show') }}" class="flex items-center gap-2.5 px-4 py-2 rounded-lg text-sm font-bold text-white hover:bg-white/10 transition-all duration-200 {{ request()->routeIs('organization.profile.*') ? 'bg-primary-500/20 text-primary-200' : '' }}">
                        <i class="fas fa-user-circle text-xs"></i>
                        <span>الملف</span>
                    </a>
                   
                    <div class="h-6 w-px bg-white/10 mx-2"></div>

                    <form method="POST" action="{{ route('organization.logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-bold text-gray-400 hover:bg-red-500/15 hover:text-red-400 transition-all duration-200">
                            <i class="fas fa-right-from-bracket text-xs"></i>
                            <span class="hidden sm:inline">خروج</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <div class="org-container">
        <div class="container mx-auto px-4 py-8">
            @if(session('success'))
                <div class="mb-6 px-5 py-4 bg-gradient-to-l from-secondary-500 to-secondary-600 text-white rounded-2xl shadow-lg shadow-secondary-500/20 flex items-center gap-3 text-sm font-medium"><i class="fas fa-circle-check text-lg"></i> {{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-6 px-5 py-4 bg-gradient-to-l from-red-500 to-red-600 text-white rounded-2xl shadow-lg shadow-red-500/20 flex items-center gap-3 text-sm font-medium"><i class="fas fa-circle-exclamation text-lg"></i> {{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>
</body>
</html>