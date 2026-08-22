<?php $__env->startSection('title', 'الجهات - وصيّ'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 lg:py-12">
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-black text-gray-900 mb-2">الجهات المعتمدة</h1>
        <p class="text-gray-500 font-medium">قائمة الجهات المعتمدة في النظام</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <?php $__empty_1 = true; $__currentLoopData = $organizations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $organization): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800"><?php echo e($organization->name); ?></h3>
                            <p class="text-sm text-gray-400 mt-0.5"><?php echo e($organization->city ?? 'N/A'); ?></p>
                        </div>
                        <span class="badge bg-secondary-50 text-secondary-700 text-xs">معتمدة</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-3"><?php echo e($organization->description ?? 'لا توجد وصف متاح'); ?></p>
                    <div class="space-y-2 mb-6 text-sm">
                        <?php if($organization->email): ?><div class="flex items-center gap-2 text-gray-600"><i class="fas fa-envelope text-primary-400 w-4 text-center"></i><span class="break-all"><?php echo e($organization->email); ?></span></div><?php endif; ?>
                        <?php if($organization->phone): ?><div class="flex items-center gap-2 text-gray-600"><i class="fas fa-phone text-primary-400 w-4 text-center"></i><span><?php echo e($organization->phone); ?></span></div><?php endif; ?>
                        <?php if($organization->address): ?><div class="flex items-start gap-2 text-gray-600"><i class="fas fa-map-location-dot text-primary-400 w-4 text-center mt-0.5"></i><span><?php echo e($organization->address); ?></span></div><?php endif; ?>
                    </div>
                    <a href="<?php echo e(route('organizations.show', $organization)); ?>" class="block w-full py-3 text-center bg-primary-50 text-primary-600 font-bold rounded-2xl hover:bg-primary-100 hover:text-primary-700 transition-all duration-200 text-sm border border-primary-100">عرض التفاصيل <i class="fas fa-arrow-left text-xs mr-1"></i></a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-16">
                <div class="text-5xl text-gray-200 mb-4"><i class="fas fa-inbox"></i></div>
                <p class="text-gray-400 font-bold text-lg">لا توجد جهات معتمدة حالياً</p>
            </div>
        <?php endif; ?>
    </div>
    <?php if($organizations->hasPages()): ?>
        <div class="mt-8 flex justify-center"><?php echo e($organizations->links('pagination::bootstrap-5')); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\victus\Desktop\projects\wa3ee\resources\views/organizations/index.blade.php ENDPATH**/ ?>