<?php $__env->startSection('title', $organization->name . ' - وصيّ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 lg:py-12 max-w-4xl">
    <a href="<?php echo e(route('organizations.index')); ?>" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-primary-600 font-medium transition-colors mb-6"><i class="fas fa-chevron-right text-xs"></i>العودة إلى الجهات</a>
    <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 overflow-hidden mb-8">
        <div class="p-8 lg:p-10">
            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-6">
                <div><h1 class="text-3xl lg:text-4xl font-black text-gray-900 mb-2"><?php echo e($organization->name); ?></h1><span class="badge bg-secondary-50 text-secondary-700">معتمدة</span></div>
            </div>
            <?php if($organization->description): ?><p class="text-gray-600 leading-relaxed mb-6"><?php echo e($organization->description); ?></p><?php endif; ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <?php if($organization->email): ?><div><label class="block text-xs font-bold text-gray-400 mb-1.5">البريد الإلكتروني</label><a href="mailto:<?php echo e($organization->email); ?>" class="text-primary-600 hover:text-primary-700 font-medium break-all"><?php echo e($organization->email); ?></a></div><?php endif; ?>
                <?php if($organization->phone): ?><div><label class="block text-xs font-bold text-gray-400 mb-1.5">رقم الهاتف</label><a href="tel:<?php echo e($organization->phone); ?>" class="text-primary-600 hover:text-primary-700 font-medium"><?php echo e($organization->phone); ?></a></div><?php endif; ?>
                <?php if($organization->city): ?><div><label class="block text-xs font-bold text-gray-400 mb-1.5">المدينة</label><p class="text-gray-800 font-medium"><?php echo e($organization->city); ?></p></div><?php endif; ?>
                <?php if($organization->address): ?><div><label class="block text-xs font-bold text-gray-400 mb-1.5">العنوان</label><p class="text-gray-800 font-medium"><?php echo e($organization->address); ?></p></div><?php endif; ?>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">معلومات إضافية</h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center pb-3 border-b border-gray-100"><span class="text-gray-500 text-sm">تاريخ الانضمام</span><span class="font-bold text-gray-800 text-sm"><?php echo e($organization->created_at->format('d/m/Y')); ?></span></div>
                <?php if($organization->is_approved): ?><div class="flex justify-between items-center"><span class="text-gray-500 text-sm">الحالة</span><span class="badge bg-secondary-50 text-secondary-700 text-xs">معتمدة</span></div><?php endif; ?>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">العمليات</h3>
            <div class="space-y-3">
                <a href="<?php echo e(route('organizations.index')); ?>" class="block w-full py-3 text-center bg-gray-50 text-gray-600 font-bold rounded-2xl hover:bg-gray-100 transition-all duration-200 text-sm border border-gray-200"><i class="fas fa-arrow-right ml-2"></i>العودة إلى الجهات</a>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->organization_id === $organization->id): ?>
                        <a href="<?php echo e(route('organization.profile.show')); ?>" class="block w-full py-3 text-center bg-primary-50 text-primary-600 font-bold rounded-2xl hover:bg-primary-100 transition-all duration-200 text-sm border border-primary-100"><i class="fas fa-pen ml-2"></i>تعديل البيانات</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\victus\Desktop\projects\wa3ee\resources\views/organizations/show.blade.php ENDPATH**/ ?>