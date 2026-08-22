@extends('layouts.app')

@section('title', 'طلب وصاية جديد')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-2xl">
        <div class="bg-white rounded-3xl shadow-2xl shadow-gray-200/60 border border-gray-50 overflow-hidden">
            <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 p-8 text-center text-white relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl border border-white/20 shadow-lg"><i class="fas fa-file-circle-plus"></i></div>
                    <h2 class="text-2xl font-black mb-1">طلب وصاية جديد</h2>
                    <p class="text-white/80 text-sm font-medium">قم بتعبئة النموذج لتقديم طلب وصاية جديد</p>
                </div>
            </div>
            <div class="p-8">
                <form method="POST" action="{{ route('parcels.store') }}">
                    @csrf
                    <div class="mb-6">
                        <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-primary-500 rounded-full inline-block"></span>بيانات الطرد</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">رقم الطرد <span class="text-red-500">*</span></label>
                                <input type="text" name="parcel_number" value="{{ old('parcel_number') }}" required placeholder="رقم الطرد" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('parcel_number') border-red-300 bg-red-50 @enderror">
                                @error('parcel_number')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">المؤسسة <span class="text-red-500">*</span></label>
                                <select name="organization_id" required class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('organization_id') border-red-300 bg-red-50 @enderror">
                                    <option value="">اختر المؤسسة</option>
                                    @foreach(\App\Models\Organization::where('is_approved', true)->get() as $org)
                                        <option value="{{ $org->id }}" {{ old('organization_id') == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization_id')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-secondary-500 rounded-full inline-block"></span>معلومات الوصي</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">الاسم <span class="text-red-500">*</span></label>
                                <input type="text" name="agent_name" value="{{ old('agent_name') }}" required placeholder="اسم الوصي" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('agent_name') border-red-300 bg-red-50 @enderror">
                                @error('agent_name')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">الجوال <span class="text-red-500">*</span></label>
                                <input type="tel" name="agent_phone" value="{{ old('agent_phone') }}" required placeholder="05X XXX XXXX" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('agent_phone') border-red-300 bg-red-50 @enderror">
                                @error('agent_phone')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">رقم الهوية <span class="text-red-500">*</span></label>
                                <input type="text" name="agent_id_number" value="{{ old('agent_id_number') }}" required placeholder="رقم الهوية" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('agent_id_number') border-red-300 bg-red-50 @enderror">
                                @error('agent_id_number')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-amber-500 rounded-full inline-block"></span>تفاصيل الوصاية</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">الفرع <span class="text-red-500">*</span></label>
                                <input type="text" name="branch_name" value="{{ old('branch_name') }}" required placeholder="اسم الفرع" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('branch_name') border-red-300 bg-red-50 @enderror">
                                @error('branch_name')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">مدة الوصاية (أيام) <span class="text-red-500">*</span></label>
                                <input type="number" name="custody_days" value="{{ old('custody_days', 30) }}" required min="1" max="365" placeholder="عدد الأيام" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('custody_days') border-red-300 bg-red-50 @enderror">
                                @error('custody_days')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-amber-500 rounded-full inline-block"></span>معلومات المرسل</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">الاسم <span class="text-red-500">*</span></label>
                                <input type="text" name="sender_name" value="{{ old('sender_name') }}" required placeholder="اسم المرسل" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('sender_name') border-red-300 bg-red-50 @enderror">
                                @error('sender_name')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">الجوال <span class="text-red-500">*</span></label>
                                <input type="tel" name="sender_phone" value="{{ old('sender_phone') }}" required placeholder="05X XXX XXXX" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('sender_phone') border-red-300 bg-red-50 @enderror">
                                @error('sender_phone')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">رقم الهوية <span class="text-red-500">*</span></label>
                                <input type="text" name="sender_id_number" value="{{ old('sender_id_number') }}" required placeholder="رقم الهوية" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('sender_id_number') border-red-300 bg-red-50 @enderror">
                                @error('sender_id_number')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">العنوان <span class="text-red-500">*</span></label>
                                <input type="text" name="sender_address" value="{{ old('sender_address') }}" required placeholder="عنوان المرسل" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('sender_address') border-red-300 bg-red-50 @enderror">
                                @error('sender_address')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-red-500 rounded-full inline-block"></span>معلومات المستلم</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">الاسم <span class="text-red-500">*</span></label>
                                <input type="text" name="receiver_name" value="{{ old('receiver_name') }}" required placeholder="اسم المستلم" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('receiver_name') border-red-300 bg-red-50 @enderror">
                                @error('receiver_name')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">الجوال <span class="text-red-500">*</span></label>
                                <input type="tel" name="receiver_phone" value="{{ old('receiver_phone') }}" required placeholder="05X XXX XXXX" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('receiver_phone') border-red-300 bg-red-50 @enderror">
                                @error('receiver_phone')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">رقم الهوية <span class="text-red-500">*</span></label>
                                <input type="text" name="receiver_id_number" value="{{ old('receiver_id_number') }}" required placeholder="رقم الهوية" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('receiver_id_number') border-red-300 bg-red-50 @enderror">
                                @error('receiver_id_number')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1.5">العنوان <span class="text-red-500">*</span></label>
                                <input type="text" name="receiver_address" value="{{ old('receiver_address') }}" required placeholder="عنوان المستلم" class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('receiver_address') border-red-300 bg-red-50 @enderror">
                                @error('receiver_address')<span class="text-sm text-red-500 font-medium mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-3 mt-8">
                        <button type="submit" class="flex-1 py-3.5 bg-gradient-to-l from-primary-500 to-primary-600 text-white font-bold rounded-2xl hover:shadow-xl hover:shadow-primary-500/30 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-200"><i class="fas fa-paper-plane ml-2"></i>إرسال الطلب</button>
                        <a href="{{ route('home') }}" class="px-8 py-3.5 bg-gray-50 text-gray-600 font-bold rounded-2xl border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-100 transition-all duration-200">إلغاء</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection