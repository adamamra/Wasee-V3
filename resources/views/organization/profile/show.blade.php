@extends('layouts.organization')

@section('title', 'الملف الشخصي للمؤسسة')

@section('content')
<div class="mb-8">
    <div class="flex items-center gap-4 mb-2">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white flex items-center justify-center text-xl shadow-lg shadow-primary-500/20">
            <i class="fas fa-building"></i>
        </div>
        <div>
            <h1 class="text-2xl font-black text-gray-800">الملف الشخصي</h1>
            <p class="text-sm text-gray-500 font-medium">إدارة معلومات المؤسسة وتحديث البيانات</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
    <div class="p-6 lg:p-8">
        <form method="POST" action="{{ route('organization.profile.update') }}">
            @csrf @method('PUT')

            <div class="flex items-center gap-3 mb-8 pb-6 border-b border-gray-100">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 text-white flex items-center justify-center text-sm shadow-lg shadow-primary-500/20">
                    <i class="fas fa-user-edit"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">المعلومات الأساسية</h2>
                    <p class="text-xs text-gray-500">البيانات العامة للمؤسسة</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">اسم المؤسسة</label>
                    <input type="text" name="name" value="{{ old('name', $organization->name) }}" required placeholder="أدخل اسم المؤسسة" class="input-custom @error('name') border-red-400 bg-red-50 @enderror">
                    @error('name')<p class="text-red-500 text-xs font-medium mt-1.5"><i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email', $organization->email) }}" required placeholder="example@domain.com" class="input-custom @error('email') border-red-400 bg-red-50 @enderror">
                    @error('email')<p class="text-red-500 text-xs font-medium mt-1.5"><i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">رقم الجوال</label>
                    <input type="text" name="phone" value="{{ old('phone', $organization->phone) }}" required placeholder="+970 50 123 4567" class="input-custom @error('phone') border-red-400 bg-red-50 @enderror">
                    @error('phone')<p class="text-red-500 text-xs font-medium mt-1.5"><i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">العنوان</label>
                    <input type="text" name="address" value="{{ old('address', $organization->address) }}" required placeholder="أدخل العنوان الكامل" class="input-custom @error('address') border-red-400 bg-red-50 @enderror">
                    @error('address')<p class="text-red-500 text-xs font-medium mt-1.5"><i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-gray-100">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 text-sm shadow-sm">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">تغيير كلمة المرور</h2>
                        <p class="text-xs text-gray-500">اترك الحقول فارغة إذا لم ترد التغيير</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور الحالية</label>
                        <input type="password" name="current_password" placeholder="أدخل كلمة المرور الحالية" class="input-custom @error('current_password') border-red-400 bg-red-50 @enderror">
                        @error('current_password')<p class="text-red-500 text-xs font-medium mt-1.5"><i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">كلمة المرور الجديدة</label>
                        <input type="password" name="new_password" placeholder="أدخل كلمة المرور الجديدة" class="input-custom @error('new_password') border-red-400 bg-red-50 @enderror">
                        @error('new_password')<p class="text-red-500 text-xs font-medium mt-1.5"><i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" name="new_password_confirmation" placeholder="أعد إدخال كلمة المرور الجديدة" class="input-custom">
                    </div>
                </div>
            </div>

            <div class="pt-6 border-t border-gray-100 mt-6 flex justify-left">
                <button type="submit" class="btn-primary px-8">
                    <i class="fas fa-save"></i> حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection