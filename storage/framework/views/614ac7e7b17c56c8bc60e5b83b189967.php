<?php $__env->startSection('title', 'طلبات الوصاية الخاصة بي'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 lg:py-12">
    <div class="flex items-start justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl lg:text-3xl font-black text-gray-900">طلبات الوصاية الخاصة بي</h1>
            <p class="text-sm text-gray-500 mt-1 font-medium">تتبع طلباتك وحالتها من هنا</p>
        </div>
        <a href="<?php echo e(route('parcels.create')); ?>" class="btn-primary text-sm shrink-0"><i class="fas fa-circle-plus"></i> طلب جديد</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 lg:p-5 mb-6">
        <form method="GET" action="<?php echo e(route('parcels.my')); ?>" class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-bold text-gray-700 mb-1.5">بحث</label>
                <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="رقم الطرد، السيريال، اسم الوصي..." class="input text-sm">
            </div>
            <div class="min-w-[140px]">
                <label class="block text-xs font-bold text-gray-700 mb-1.5">الحالة</label>
                <select name="status" class="input text-sm">
                    <option value="">الكل</option>
                    <option value="pending" <?php echo e(request('status') === 'pending' ? 'selected' : ''); ?>>قيد الانتظار</option>
                    <option value="delivered" <?php echo e(request('status') === 'delivered' ? 'selected' : ''); ?>>تم التسليم</option>
                </select>
            </div>
            <button type="submit" class="btn-primary text-sm px-5 py-2.5"><i class="fas fa-search"></i> بحث</button>
            <?php if(request('q') || request('status')): ?>
                <a href="<?php echo e(route('parcels.my')); ?>" class="btn-secondary text-sm px-5 py-2.5"><i class="fas fa-xmark"></i> إلغاء</a>
            <?php endif; ?>
        </form>
    </div>

    <?php if(($expiringSoonCount ?? 0) > 0): ?>
        <div class="mb-4 px-5 py-4 bg-gradient-to-l from-amber-50 to-amber-100 border border-amber-200 rounded-2xl text-amber-800 flex items-center gap-3 text-sm font-medium shadow-sm"><i class="fas fa-clock text-amber-500 text-lg"></i> لديك <?php echo e($expiringSoonCount); ?> طلب(ات) ستنتهي مدة حفظها خلال يومين.</div>
    <?php endif; ?>
    <?php if(($expiredCount ?? 0) > 0): ?>
        <div class="mb-4 px-5 py-4 bg-gradient-to-l from-red-50 to-red-100 border border-red-200 rounded-2xl text-red-800 flex items-center gap-3 text-sm font-medium shadow-sm"><i class="fas fa-circle-exclamation text-red-500 text-lg"></i> يوجد <?php echo e($expiredCount); ?> طلب(ات) انتهت مدة الوصاية لها ولم تُسلّم بعد.</div>
    <?php endif; ?>

    <?php if($parcels->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
            <?php $__currentLoopData = $parcels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parcel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $isDelivered = $parcel->status === App\Models\Parcel::STATUS_DELIVERED; ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="p-5 lg:p-6 flex-1">
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div>
                                <p class="text-xs text-gray-400 font-medium">رقم الطرد</p>
                                <p class="text-xl font-black text-gray-900 mt-0.5 group-hover:text-primary-600 transition-colors"><?php echo e($parcel->parcel_number); ?></p>
                            </div>
                            <span class="badge text-xs shrink-0 <?php echo e($isDelivered ? 'bg-secondary-50 text-secondary-700' : 'bg-amber-50 text-amber-700'); ?>"><?php echo e($isDelivered ? 'تم التسليم' : 'قيد الانتظار'); ?></span>
                        </div>
                        <div class="space-y-2.5 text-sm border-t border-gray-100 pt-4">
                            <div class="flex items-center gap-2.5 text-gray-700"><i class="fas fa-user text-primary-400 w-4 text-center"></i><span class="font-semibold"><?php echo e($parcel->agent_name); ?></span></div>
                            <div class="flex items-center gap-2.5 text-gray-600"><i class="fas fa-phone text-primary-400 w-4 text-center"></i><span><?php echo e($parcel->agent_phone); ?></span></div>
                            <div class="flex items-center gap-2.5 text-gray-600"><i class="fas fa-id-card text-primary-400 w-4 text-center"></i><span><?php echo e($parcel->agent_id_number); ?></span></div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 gap-2.5 text-sm">
                            <div class="bg-gray-50 rounded-xl p-3">
                                <p class="text-xs text-gray-400">تاريخ الإنشاء</p>
                                <p class="font-semibold text-gray-800 mt-0.5"><?php echo e($parcel->created_at->format('d-m-Y H:i')); ?></p>
                            </div>
                            <?php if($parcel->expires_at): ?>
                                <div class="bg-gray-50 rounded-xl p-3">
                                    <p class="text-xs text-gray-400">انتهاء الوصاية</p>
                                    <p class="font-semibold text-gray-800 mt-0.5"><?php echo e($parcel->expires_at->format('d-m-Y H:i')); ?><?php if(now()->greaterThan($parcel->expires_at) && !$isDelivered): ?><span class="badge bg-red-50 text-red-700 text-xs mr-1.5">منتهية</span><?php endif; ?></p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="px-5 lg:px-6 pb-5 lg:pb-6">
                        <a href="<?php echo e(route('parcels.show', $parcel->serial_number)); ?>" class="block w-full py-3 text-center bg-gray-50 hover:bg-primary-50 text-gray-700 hover:text-primary-600 font-bold rounded-2xl border-2 border-gray-100 hover:border-primary-200 transition-all duration-200 text-sm"><i class="fas fa-eye ml-2"></i>عرض التفاصيل</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-8 flex justify-center"><?php echo e($parcels->links('pagination::bootstrap-5')); ?></div>
    <?php else: ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto text-gray-400 text-2xl"><i class="fas fa-inbox"></i></div>
            <h2 class="mt-4 text-lg font-bold text-gray-800">لا توجد طلبات</h2>
            <p class="mt-1 text-sm text-gray-500 font-medium">لم تقم بإنشاء أي طلبات وصاية حتى الآن</p>
            <a href="<?php echo e(route('parcels.create')); ?>" class="btn-primary mt-6 inline-flex"><i class="fas fa-circle-plus"></i> إنشاء طلب جديد</a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\victus\Desktop\projects\wa3ee\resources\views/parcels/my.blade.php ENDPATH**/ ?>