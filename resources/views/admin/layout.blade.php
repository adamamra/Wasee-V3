<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'لوحة التحكم') - وصيّ</title>
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
        body { font-family: 'Tajawal', sans-serif; background: #f1f5f9; }
        .card { @apply bg-white rounded-2xl shadow-sm border border-gray-100; }
        .btn { @apply inline-flex items-center justify-center gap-2 px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 active:scale-95; }
        .btn-primary { @apply btn bg-primary-500 text-white hover:bg-primary-600 shadow-md shadow-primary-500/20; }
        .btn-sm { @apply px-3 py-1.5 text-xs; }
        .input { @apply w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none; }
        .badge { @apply inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold; }
    </style>
    @stack('styles')
</head>
<body x-data="{ open: false }" :class="open ? 'overflow-hidden lg:overflow-visible' : ''">
    <div class="min-h-screen flex">
        {{-- Mobile sidebar --}}
        <div class="lg:hidden fixed inset-0 z-50" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="absolute inset-0 bg-black/60" @click="open = false"></div>
            <div class="absolute top-0 right-0 h-full w-64 bg-[#0f172a] shadow-2xl" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full" style="display: none;">
                @include('admin.partials.sidebar')
            </div>
        </div>

        {{-- Desktop sidebar --}}
        <aside class="hidden lg:flex flex-col h-screen w-64 shrink-0 sticky top-0 bg-[#0f172a] shadow-2xl">
            @include('admin.partials.sidebar')
        </aside>

        {{-- Main --}}
        <div class="flex-1 flex flex-col min-h-screen min-w-0">
            {{-- Top bar --}}
            <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-gray-200/60">
                <div class="flex items-center justify-between px-4 lg:px-6 h-16">
                    <div class="flex items-center gap-3">
                        <button @click="open = !open" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl text-gray-500 hover:bg-gray-100 transition-all">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-lg font-bold text-gray-800">@yield('page-title', 'لوحة التحكم')</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-sm font-medium text-gray-500">{{ auth()->user()->name }}</span>
                        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center text-primary-600 border-2 border-white shadow-sm">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <main class="flex-1 p-4 lg:p-6">
                @if(session('success'))
                    <div class="mb-6 px-5 py-4 bg-gradient-to-l from-secondary-500 to-secondary-600 text-white rounded-2xl shadow-lg shadow-secondary-500/20 flex items-center gap-3 text-sm font-medium">
                        <i class="fas fa-circle-check text-lg"></i> {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 px-5 py-4 bg-gradient-to-l from-red-500 to-red-600 text-white rounded-2xl shadow-lg shadow-red-500/20 flex items-center gap-3 text-sm font-medium">
                        <i class="fas fa-circle-exclamation text-lg"></i> {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>