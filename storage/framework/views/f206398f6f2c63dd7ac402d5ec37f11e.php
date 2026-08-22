<?php $__env->startSection('title', 'تسجيل الدخول'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-2xl shadow-gray-200/60 border border-gray-50 overflow-hidden">
            <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 p-8 text-center text-white relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-20 -left-20 w-48 h-48 bg-secondary-400/10 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl border border-white/20 shadow-lg"><i class="fas fa-user"></i></div>
                    <h2 class="text-2xl font-black mb-1">تسجيل الدخول</h2>
                    <p class="text-white/80 text-sm font-medium">قم بتسجيل الدخول للوصول إلى حسابك الشخصي</p>
                </div>
            </div>
            <div class="p-8">
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-envelope ml-2 text-primary-400"></i>البريد الإلكتروني أو رقم الهوية</label>
                        <input type="text" name="login" value="<?php echo e(old('login')); ?>" required autofocus placeholder="example@domain.com أو رقم الهوية"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['login'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1.5 block"><i class="fas fa-circle-exclamation ml-1"></i><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-lock ml-2 text-primary-400"></i>كلمة المرور</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-300 bg-red-50 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                            <button type="button" onclick="togglePassword()" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-500 transition-colors"><i id="pw-icon" class="fas fa-eye"></i></button>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-sm text-red-500 font-medium mt-1.5 block"><i class="fas fa-circle-exclamation ml-1"></i><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="flex items-center gap-3 mb-6">
                        <input type="checkbox" name="remember" id="remember" class="w-5 h-5 rounded-lg border-gray-300 text-primary-500 focus:ring-primary-200 cursor-pointer" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                        <label for="remember" class="text-sm font-medium text-gray-600 cursor-pointer select-none">تذكرني</label>
                    </div>
                    <button type="submit" class="w-full py-3.5 bg-gradient-to-l from-primary-500 to-primary-600 text-white font-bold rounded-2xl hover:shadow-xl hover:shadow-primary-500/30 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-200 text-base"><i class="fas fa-right-to-bracket ml-2"></i>تسجيل الدخول</button>
                </form>
                <div class="mt-6 text-center space-y-3">
                    <?php if(Route::has('organization.login')): ?>
                        <a href="<?php echo e(route('organization.login')); ?>" class="block w-full py-3 text-primary-600 border-2 border-primary-200 hover:border-primary-400 hover:bg-primary-50 rounded-2xl font-bold transition-all duration-200 text-sm"><i class="fas fa-building ml-2"></i>تسجيل دخول المؤسسة</a>
                    <?php endif; ?>
                    <div class="relative my-6"><div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div><div class="relative flex justify-center"><span class="bg-white px-4 text-sm text-gray-400 font-medium">أو</span></div></div>
                    <a href="<?php echo e(route('register')); ?>" class="block text-primary-600 hover:text-primary-700 font-bold transition-all duration-200 text-sm"><i class="fas fa-user-plus ml-2"></i>إنشاء حساب جديد</a>
                    <?php if(Route::has('organization.register')): ?>
                        <a href="<?php echo e(route('organization.register')); ?>" class="block text-secondary-600 hover:text-secondary-700 font-bold transition-all duration-200 text-sm"><i class="fas fa-building ml-2"></i>تسجيل مؤسسة جديدة</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>function togglePassword(){const i=document.getElementById('password'),c=document.getElementById('pw-icon');if(i.type==='password'){i.type='text';c.classList.remove('fa-eye');c.classList.add('fa-eye-slash')}else{i.type='password';c.classList.remove('fa-eye-slash');c.classList.add('fa-eye')}}</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\victus\Desktop\projects\wa3ee\resources\views/auth/login.blade.php ENDPATH**/ ?>