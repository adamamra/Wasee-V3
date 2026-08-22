<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'وصيّ - نظام إدارة الوصاية'); ?></title>
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
                        accent: { DEFAULT: '#f59e0b', 50: '#fffbeb', 100: '#fef3c7', 200: '#fde68a', 300: '#fcd34d', 400: '#fbbf24', 500: '#f59e0b', 600: '#d97706', 700: '#b45309', 800: '#92400e', 900: '#78350f' },
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-delayed': 'float 6s ease-in-out 3s infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-12px)' } },
                    }
                },
            },
        }
    </script>
    <style>
        * { scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent; }
        body { font-family: 'Tajawal', sans-serif; }
        .glass { background: rgba(255,255,255,0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .glass-card { background: rgba(255,255,255,0.9); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.3); }
        .nav-link-custom { @apply relative text-gray-600 font-medium transition-all duration-200 hover:text-primary-600; }
        .nav-link-custom::after { content: ''; position: absolute; bottom: -2px; right: 0; width: 0; height: 2px; background: #6366f1; transition: width 0.3s ease; border-radius: 1px; }
        .nav-link-custom:hover::after, .nav-link-custom.active::after { width: 100%; }
        .nav-link-custom.active { @apply text-primary-600; }
        .btn-primary { @apply inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary-500 text-white font-bold rounded-xl hover:bg-primary-600 active:scale-95 transition-all duration-200 shadow-lg shadow-primary-500/20 hover:shadow-xl hover:shadow-primary-500/30; }
        .btn-secondary { @apply inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-gray-700 font-bold rounded-xl border-2 border-gray-200 hover:border-primary-300 hover:text-primary-600 active:scale-95 transition-all duration-200; }
        .input-custom { @apply w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none; }
        .card-custom { @apply bg-white rounded-2xl shadow-lg shadow-gray-200/50 border border-gray-100 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-gray-200/60; }
        .badge { @apply inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="min-h-screen flex flex-col bg-gradient-to-br from-gray-50 via-white to-gray-50 text-gray-800 antialiased">
    <header x-data="{ mobileOpen: false }" class="glass sticky top-0 z-50 border-b border-gray-100/80">
        <div class="container mx-auto px-4 lg:px-6">
            <div class="flex items-center justify-between h-18 lg:h-20">
                <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2.5 group shrink-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white shadow-lg shadow-primary-500/20 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <i class="fas fa-shield-halved text-lg"></i>
                    </div>
                    <span class="text-xl font-black bg-gradient-to-l from-primary-600 to-primary-400 bg-clip-text text-transparent">وصيّ</span>
                </a>
                <nav class="hidden lg:flex items-center gap-1">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link-custom px-3 py-2 <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">الرئيسية</a>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Route::has('organizations.index')): ?>
                            <a href="<?php echo e(route('organizations.index')); ?>" class="nav-link-custom px-3 py-2 <?php echo e(request()->routeIs('organizations.*') ? 'active' : ''); ?>">الجهات</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </nav>
                <div class="flex items-center gap-2 lg:gap-3">
                    <?php if(auth()->guard()->guest()): ?>
                        <a href="<?php echo e(route('login')); ?>" class="hidden lg:inline-flex btn-secondary text-sm px-4 py-2">تسجيل الدخول</a>
                        <a href="<?php echo e(route('register')); ?>" class="btn-primary text-sm px-4 py-2">إنشاء حساب</a>
                    <?php else: ?>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.outside="open = false" class="flex items-center gap-2 bg-white border-2 border-gray-100 hover:border-primary-200 rounded-xl px-3 py-1.5 transition-all duration-200 group">
                                <span class="hidden sm:inline text-sm font-medium text-gray-700 group-hover:text-primary-600"><?php echo e(Auth::user()->name); ?></span>
                                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center text-primary-600 border-2 border-white shadow-sm">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute left-0 mt-2 w-56 rounded-2xl shadow-xl shadow-gray-200/50 bg-white ring-1 ring-black/5 overflow-hidden z-50 border border-gray-50" style="display: none;">
                                <div class="p-2">
                                    <a href="<?php echo e(route('profile.show')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-xl transition-all duration-200"><i class="fas fa-user-circle text-lg text-primary-400 w-5 text-center"></i> الملف الشخصي</a>
                                    <?php if(auth()->user()->isAdmin() && Route::has('admin.dashboard')): ?>
                                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-xl transition-all duration-200"><i class="fas fa-gauge-high text-lg text-primary-400 w-5 text-center"></i> لوحة التحكم</a>
                                    <?php endif; ?>
                                    <hr class="my-1 border-gray-100">
                                    <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 text-sm text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200"><i class="fas fa-right-from-bracket text-lg w-5 text-center"></i> تسجيل الخروج</a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="hidden"><?php echo csrf_field(); ?></form>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden w-10 h-10 flex items-center justify-center rounded-xl text-gray-600 hover:bg-gray-100 transition-all duration-200">
                        <i class="fas fa-bars text-xl" x-show="!mobileOpen"></i>
                        <i class="fas fa-xmark text-xl" x-show="mobileOpen" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-t border-gray-100 glass" style="display: none;">
            <div class="container mx-auto px-4 py-4 space-y-1">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo e(request()->routeIs('home') ? 'bg-primary-50 text-primary-600 font-bold' : 'text-gray-700 hover:bg-gray-50'); ?> transition-all duration-200"><i class="fas fa-house w-5 text-center"></i>الرئيسية</a>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Route::has('organizations.index')): ?>
                        <a href="<?php echo e(route('organizations.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl <?php echo e(request()->routeIs('organizations.*') ? 'bg-primary-50 text-primary-600 font-bold' : 'text-gray-700 hover:bg-gray-50'); ?> transition-all duration-200"><i class="fas fa-building w-5 text-center"></i>الجهات</a>
                    <?php endif; ?>
                    <hr class="my-2 border-gray-100">
                    <?php if(Route::has('parcels.create')): ?>
                        <a href="<?php echo e(route('parcels.create')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-primary-600 hover:bg-primary-50 transition-all duration-200"><i class="fas fa-circle-plus w-5 text-center"></i>طلب جديد</a>
                    <?php endif; ?>
                    <?php if(Route::has('parcels.my')): ?>
                        <a href="<?php echo e(route('parcels.my')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-200"><i class="fas fa-list w-5 text-center"></i>عرض طلباتي</a>
                    <?php endif; ?>
                <?php else: ?>
                    <hr class="my-2 border-gray-100">
                    <a href="<?php echo e(route('login')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-gray-50 transition-all duration-200"><i class="fas fa-right-to-bracket w-5 text-center"></i>تسجيل الدخول</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="flex-1">
        <?php if(session('success')): ?>
            <div class="bg-gradient-to-l from-secondary-500 to-secondary-600 text-white px-4 py-3 text-center text-sm font-medium shadow-lg shadow-secondary-500/20"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-gradient-to-l from-red-500 to-red-600 text-white px-4 py-3 text-center text-sm font-medium shadow-lg shadow-red-500/20"><?php echo e(session('error')); ?></div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <footer class="bg-gray-900 text-gray-400 mt-auto">
        <div class="container mx-auto px-4 lg:px-6 py-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="w-9 h-4 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center text-white shadow-lg"><i class="fas fa-shield-halved"></i></div>
                        <span class="text-lg font-black text-white">وصيّ</span>
                    </div>
                    <p class="text-sm leading-relaxed">نظام متكامل لإدارة الوصاية القانونية، يربط بين المستفيدين والجهات المختصة لضمان حقوق القاصرين.</p>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">روابط سريعة</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="<?php echo e(route('home')); ?>" class="hover:text-white transition-colors">الرئيسية</a></li>
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Route::has('organizations.index')): ?><li><a href="<?php echo e(route('organizations.index')); ?>" class="hover:text-white transition-colors">الجهات</a></li><?php endif; ?>
                        <?php endif; ?>
                        <li><a href="<?php echo e(route('register')); ?>" class="hover:text-white transition-colors">إنشاء حساب</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold mb-4">تواصل معنا</h3>
                    <ul class="space-y-2 text-sm">
                        <li class="flex items-center gap-2"><i class="fas fa-envelope text-primary-400 w-4 text-center"></i> AdamAhmed4757596@gmail.com</li>
                        <li class="flex items-center gap-2"><i class="fas fa-phone text-primary-400 w-4 text-center"></i> 9720599120303</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-4 text-center text-xs">© <?php echo e(date('Y')); ?> وصيّ. جميع الحقوق محفوظة.</div>
        </div>
    </footer>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\victus\Desktop\projects\wa3ee\resources\views/layouts/app.blade.php ENDPATH**/ ?>