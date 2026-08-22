<?php $__env->startSection('title', 'وصيّ - الرئيسية'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 lg:px-6 py-8 lg:py-12">
    
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary-500 via-primary-600 to-primary-800 text-white p-8 lg:p-16 mb-12 shadow-2xl shadow-primary-500/25">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-secondary-400/10 rounded-full blur-3xl"></div>
        <div class="relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-white/15 rounded-full text-sm font-medium backdrop-blur-sm mb-6 border border-white/10">
                <span class="w-2 h-2 bg-secondary-400 rounded-full animate-pulse"></span>
                نظام إدارة الوصاية الإلكتروني
            </div>
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-black mb-4 tracking-tight">
                <?php if(auth()->guard()->check()): ?>
                مرحباً بك في <span class="text-secondary-300">وصيّ</span>
                <?php else: ?>
                نظام <span class="text-secondary-300">وصيّ</span> لإدارة الوصاية
                <?php endif; ?>
            </h1>
            <p class="text-lg lg:text-xl text-white/80 max-w-2xl mx-auto mb-8 font-medium">
                <?php if(auth()->guard()->check()): ?>
                إدارة طلبات الوصاية الخاصة بك بكل سهولة واحترافية
                <?php else: ?>
                نظام متكامل لإدارة طلبات الوصاية الإلكترونية بكل أمان وسهولة
                <?php endif; ?>
            </p>
            <?php if(auth()->guard()->guest()): ?>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white text-primary-600 font-bold rounded-2xl hover:bg-secondary-50 active:scale-95 transition-all duration-200 shadow-xl shadow-black/10">
                    <i class="fas fa-user-plus"></i> إنشاء حساب جديد
                </a>
                <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white/15 hover:bg-white/25 text-white font-bold rounded-2xl backdrop-blur-sm border border-white/20 active:scale-95 transition-all duration-200">
                    <i class="fas fa-right-to-bracket"></i> تسجيل الدخول
                </a>
            </div>
            <?php endif; ?>
            <?php if(auth()->guard()->check()): ?>
            <div class="flex flex-wrap justify-center gap-3">
                <a href="<?php echo e(route('parcels.create')); ?>" class="inline-flex items-center gap-2 px-8 py-3.5 bg-secondary-500 text-white font-bold rounded-2xl hover:bg-secondary-600 active:scale-95 transition-all duration-200 shadow-xl shadow-black/10">
                    <i class="fas fa-circle-plus"></i> طلب وصاية جديد
                </a>
                <a href="<?php echo e(route('parcels.my')); ?>" class="inline-flex items-center gap-2 px-8 py-3.5 bg-white/15 hover:bg-white/25 text-white font-bold rounded-2xl backdrop-blur-sm border border-white/20 active:scale-95 transition-all duration-200">
                    <i class="fas fa-list"></i> طلباتي
                </a>
            </div>
            <?php endif; ?>
        </div>
        
        <?php if(auth()->guard()->guest()): ?>
        <div class="relative z-10 mt-8 max-w-3xl mx-auto bg-white/10 backdrop-blur-md rounded-2xl p-6 border border-white/10">
            <div class="flex items-center gap-2 justify-center mb-4 text-white/90 text-sm font-bold"><i class="fas fa-list-ol"></i> خطوات البدء السريع</div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3 border border-white/5">
                    <span class="w-8 h-8 bg-white/80 text-primary-600 rounded-full flex items-center justify-center font-black text-sm shrink-0">1</span>
                    <span class="text-sm font-medium text-white/90">إنشاء حساب مجاني</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3 border border-white/5">
                    <span class="w-8 h-8 bg-white/80 text-primary-600 rounded-full flex items-center justify-center font-black text-sm shrink-0">2</span>
                    <span class="text-sm font-medium text-white/90">تقديم طلب الوصاية</span>
                </div>
                <div class="flex items-center gap-3 bg-white/10 rounded-xl px-4 py-3 border border-white/5">
                    <span class="w-8 h-8 bg-white/80 text-primary-600 rounded-full flex items-center justify-center font-black text-sm shrink-0">3</span>
                    <span class="text-sm font-medium text-white/90">متابعة حالة الطلب</span>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>

    
    <?php if(auth()->guard()->check()): ?>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-12">
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 rounded-xl bg-primary-50 text-primary-500 flex items-center justify-center text-xl mx-auto mb-3 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300"><i class="fas fa-file-contract"></i></div>
            <div class="text-3xl font-black text-gray-800 bg-gradient-to-br from-primary-500 to-primary-700 bg-clip-text text-transparent"><?php echo e(auth()->user()->parcels()->count()); ?></div>
            <div class="text-sm font-medium text-gray-500">إجمالي الطلبات</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl mx-auto mb-3 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300"><i class="fas fa-spinner"></i></div>
            <div class="text-3xl font-black text-gray-800 bg-gradient-to-br from-amber-500 to-amber-700 bg-clip-text text-transparent"><?php echo e(auth()->user()->parcels()->where('status', '!=', 'delivered')->count()); ?></div>
            <div class="text-sm font-medium text-gray-500">الطلبات النشطة</div>
        </div>
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
            <div class="w-12 h-12 rounded-xl bg-secondary-50 text-secondary-500 flex items-center justify-center text-xl mx-auto mb-3 group-hover:scale-110 group-hover:rotate-3 transition-all duration-300"><i class="fas fa-circle-check"></i></div>
            <div class="text-3xl font-black text-gray-800 bg-gradient-to-br from-secondary-500 to-secondary-700 bg-clip-text text-transparent"><?php echo e(auth()->user()->parcels()->where('status', 'delivered')->count()); ?></div>
            <div class="text-sm font-medium text-gray-500">المكتملة</div>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-primary-50 to-primary-100 text-primary-500 flex items-center justify-center text-3xl mx-auto mb-5 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-primary-500/5"><i class="fas fa-file-signature"></i></div>
            <h3 class="text-xl font-bold text-gray-800 mb-3">تقديم الطلبات</h3>
            <p class="text-gray-500 leading-relaxed">قدم طلبات الوصاية بكل سهولة عبر نموذج احترافي وآمن</p>
        </div>
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-secondary-50 to-secondary-100 text-secondary-500 flex items-center justify-center text-3xl mx-auto mb-5 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-secondary-500/5"><i class="fas fa-tasks"></i></div>
            <h3 class="text-xl font-bold text-gray-800 mb-3">متابعة الحالة</h3>
            <p class="text-gray-500 leading-relaxed">تابع حالة طلباتك في الوقت الفعلي مع إشعارات فورية</p>
        </div>
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center hover:shadow-xl hover:-translate-y-2 transition-all duration-300 group">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 text-amber-500 flex items-center justify-center text-3xl mx-auto mb-5 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-amber-500/5"><i class="fas fa-shield-halved"></i></div>
            <h3 class="text-xl font-bold text-gray-800 mb-3">أمان عالي</h3>
            <p class="text-gray-500 leading-relaxed">بيانات محمية بأعلى معايير الأمان والتشفير الحديثة</p>
        </div>
    </div>

    
    <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 lg:p-12 border border-gray-100 shadow-sm">
        <div class="max-w-2xl mx-auto">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 text-white flex items-center justify-center text-xl shadow-lg shadow-primary-500/20"><i class="fas fa-list-ol"></i></div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">خطوات البدء السريع</h3>
                    <p class="text-sm text-gray-500">اتبع هذه الخطوات لتبدأ مع وصيّ</p>
                </div>
            </div>
            <div class="space-y-3">
                <div class="flex items-center gap-4 p-4 rounded-xl bg-white border border-gray-100 hover:shadow-md hover:border-primary-100 transition-all duration-200">
                    <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 text-white flex items-center justify-center font-black text-sm shrink-0 shadow-md shadow-primary-500/20">1</span>
                    <span class="font-medium text-gray-700">تسجيل الدخول إلى حسابك في النظام</span>
                </div>
                <div class="flex items-center gap-4 p-4 rounded-xl bg-white border border-gray-100 hover:shadow-md hover:border-primary-100 transition-all duration-200">
                    <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 text-white flex items-center justify-center font-black text-sm shrink-0 shadow-md shadow-primary-500/20">2</span>
                    <span class="font-medium text-gray-700">إضافة بيانات الوصي وبيانات الوصاية</span>
                </div>
                <div class="flex items-center gap-4 p-4 rounded-xl bg-white border border-gray-100 hover:shadow-md hover:border-primary-100 transition-all duration-200">
                    <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 text-white flex items-center justify-center font-black text-sm shrink-0 shadow-md shadow-primary-500/20">3</span>
                    <span class="font-medium text-gray-700">متابعة حالة الطلب حتى إصدار القرار النهائي</span>
                </div>
                <div class="flex items-center gap-4 p-4 rounded-xl bg-gradient-to-l from-primary-50 to-white border border-primary-100 hover:shadow-md transition-all duration-200">
                    <span class="w-10 h-10 rounded-xl bg-gradient-to-br from-secondary-500 to-secondary-600 text-white flex items-center justify-center font-black text-sm shrink-0 shadow-md shadow-secondary-500/20"><i class="fas fa-play text-xs"></i></span>
                    <a href="https://www.youtube.com/watch?v=68x1rkcNH6I" target="_blank" class="font-medium text-primary-600 hover:text-primary-700 transition-colors flex items-center gap-2">
                        فيديو تعليمي لمساعدتك في تقديم طلب الوصاية الخاص بك
                        <i class="fas fa-arrow-left text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\victus\Desktop\projects\wa3ee\resources\views/home.blade.php ENDPATH**/ ?>