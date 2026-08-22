<?php $__env->startSection('title', 'الملف الشخصي'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 lg:py-12 max-w-3xl">
    <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 rounded-3xl p-8 lg:p-10 text-white relative overflow-hidden mb-8 shadow-2xl shadow-primary-500/25">
        <div class="absolute -top-20 -right-20 w-60 h-60 bg-white/5 rounded-full blur-3xl"></div>
        <div class="relative z-10">
            <h1 class="text-2xl lg:text-3xl font-black flex items-center gap-3 mb-2"><i class="fas fa-user-circle"></i>الملف الشخصي</h1>
            <p class="text-white/80 font-medium">إدارة معلوماتك الشخصية وتحديث البيانات</p>
        </div>
    </div>

    <div class="flex items-start gap-4 p-5 bg-gradient-to-l from-secondary-50 to-secondary-100 border border-secondary-200 rounded-2xl mb-8 shadow-sm">
        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-secondary-500 to-secondary-600 flex items-center justify-center text-white text-lg shrink-0 shadow-lg shadow-secondary-500/20"><i class="fas fa-circle-info"></i></div>
        <div><h4 class="font-bold text-gray-800">معلومات هامة</h4><p class="text-sm text-gray-600 mt-0.5">تأكد من صحة جميع المعلومات قبل حفظ التغييرات.</p></div>
    </div>

    <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 overflow-hidden">
        <div class="p-6 lg:p-8">
            <form method="POST" action="<?php echo e(route('profile.update')); ?>">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2"><span class="w-1 h-6 bg-primary-500 rounded-full inline-block"></span>المعلومات الأساسية</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-user ml-1.5 text-primary-400"></i>الاسم الكامل</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required placeholder="أدخل اسمك الكامل" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-envelope ml-1.5 text-primary-400"></i>البريد الإلكتروني</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required placeholder="example@domain.com" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-id-card ml-1.5 text-primary-400"></i>رقم الهوية</label>
                        <input type="text" value="<?php echo e($user->id_number); ?>" disabled readonly class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-2xl text-gray-500 cursor-not-allowed">
                        <small class="text-xs text-gray-400 mt-1 block">رقم الهوية لا يمكن تعديله</small>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-phone ml-1.5 text-primary-400"></i>رقم الجوال</label>
                        <input type="tel" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" required placeholder="05X XXX XXXX" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-building ml-1.5 text-primary-400"></i>اسم الفرع</label>
                        <input type="text" name="branch_name" value="<?php echo e(old('branch_name', $user->branch_name)); ?>" placeholder="أدخل اسم الفرع" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['branch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['branch_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-circle-check ml-1.5 text-primary-400"></i>حالة الحساب</label>
                        <div class="mt-2"><?php if($user->is_approved): ?><span class="badge bg-secondary-50 text-secondary-700"><i class="fas fa-check ml-1"></i> حساب مفعل</span><?php else: ?><span class="badge bg-amber-50 text-amber-700"><i class="fas fa-clock ml-1"></i> في انتظار الموافقة</span><?php endif; ?></div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-primary-50/50 to-white border border-primary-100 rounded-2xl p-6 lg:p-8 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2"><i class="fas fa-lock text-primary-500"></i>تغيير كلمة المرور</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-key ml-1.5 text-gray-400"></i>كلمة المرور الحالية</label>
                            <input type="password" name="current_password" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-lock ml-1.5 text-gray-400"></i>كلمة المرور الجديدة</label>
                            <input type="password" name="new_password" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-circle-check ml-1.5 text-gray-400"></i>تأكيد كلمة المرور</label>
                            <input type="password" name="new_password_confirmation" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn-primary text-base px-8 py-3.5"><i class="fas fa-floppy-disk ml-2"></i>حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\victus\Desktop\projects\wa3ee\resources\views/profile/show.blade.php ENDPATH**/ ?>