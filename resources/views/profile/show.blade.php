@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
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
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf @method('PUT')
                <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2"><span class="w-1 h-6 bg-primary-500 rounded-full inline-block"></span>المعلومات الأساسية</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-user ml-1.5 text-primary-400"></i>الاسم الكامل</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="أدخل اسمك الكامل" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('name') border-red-300 bg-red-50 @enderror">
                        @error('name')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-envelope ml-1.5 text-primary-400"></i>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="example@domain.com" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('email') border-red-300 bg-red-50 @enderror">
                        @error('email')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-id-card ml-1.5 text-primary-400"></i>رقم الهوية</label>
                        <input type="text" value="{{ $user->id_number }}" disabled readonly class="w-full px-4 py-3 bg-gray-100 border-2 border-gray-200 rounded-2xl text-gray-500 cursor-not-allowed">
                        <small class="text-xs text-gray-400 mt-1 block">رقم الهوية لا يمكن تعديله</small>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-phone ml-1.5 text-primary-400"></i>رقم الجوال</label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" required placeholder="05X XXX XXXX" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('phone') border-red-300 bg-red-50 @enderror">
                        @error('phone')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-building ml-1.5 text-primary-400"></i>اسم الفرع</label>
                        <input type="text" name="branch_name" value="{{ old('branch_name', $user->branch_name) }}" placeholder="أدخل اسم الفرع" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('branch_name') border-red-300 bg-red-50 @enderror">
                        @error('branch_name')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-circle-check ml-1.5 text-primary-400"></i>حالة الحساب</label>
                        <div class="mt-2">@if($user->is_approved)<span class="badge bg-secondary-50 text-secondary-700"><i class="fas fa-check ml-1"></i> حساب مفعل</span>@else<span class="badge bg-amber-50 text-amber-700"><i class="fas fa-clock ml-1"></i> في انتظار الموافقة</span>@endif</div>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-primary-50/50 to-white border border-primary-100 rounded-2xl p-6 lg:p-8 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2"><i class="fas fa-lock text-primary-500"></i>تغيير كلمة المرور</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-key ml-1.5 text-gray-400"></i>كلمة المرور الحالية</label>
                            <input type="password" name="current_password" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('current_password') border-red-300 bg-red-50 @enderror">
                            @error('current_password')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1.5"><i class="fas fa-lock ml-1.5 text-gray-400"></i>كلمة المرور الجديدة</label>
                            <input type="password" name="new_password" placeholder="••••••••" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('new_password') border-red-300 bg-red-50 @enderror">
                            @error('new_password')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
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
@endsection