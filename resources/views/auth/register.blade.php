@extends('layouts.app')

@section('title', 'تسجيل حساب جديد')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-lg">
        <div class="bg-white rounded-3xl shadow-2xl shadow-gray-200/60 border border-gray-50 overflow-hidden">
            <div class="bg-gradient-to-br from-primary-500 via-primary-600 to-primary-700 p-8 text-center text-white relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl border border-white/20 shadow-lg"><i class="fas fa-user-plus"></i></div>
                    <h2 class="text-2xl font-black mb-1">إنشاء حساب جديد</h2>
                    <p class="text-white/80 text-sm font-medium">انضم إلينا لاستخدام خدمات الوصاية الإلكترونية</p>
                </div>
            </div>
            <div class="p-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-user ml-1.5 text-primary-400"></i>الاسم الكامل</label>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="الاسم الكامل"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('name') border-red-300 bg-red-50 @enderror">
                            @error('name')<span class="text-sm text-red-500 font-medium mt-1"><i class="fas fa-circle-exclamation ml-1"></i>{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-id-card ml-1.5 text-primary-400"></i>رقم الهوية</label>
                            <input type="text" name="id_number" value="{{ old('id_number') }}" required placeholder="رقم الهوية"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('id_number') border-red-300 bg-red-50 @enderror">
                            @error('id_number')<span class="text-sm text-red-500 font-medium mt-1"><i class="fas fa-circle-exclamation ml-1"></i>{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-envelope ml-1.5 text-primary-400"></i>البريد الإلكتروني</label>
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="example@domain.com"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('email') border-red-300 bg-red-50 @enderror">
                            @error('email')<span class="text-sm text-red-500 font-medium mt-1"><i class="fas fa-circle-exclamation ml-1"></i>{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-phone ml-1.5 text-primary-400"></i>رقم الجوال</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="05X XXX XXXX"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('phone') border-red-300 bg-red-50 @enderror">
                            @error('phone')<span class="text-sm text-red-500 font-medium mt-1"><i class="fas fa-circle-exclamation ml-1"></i>{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-lock ml-1.5 text-primary-400"></i>كلمة المرور</label>
                            <div class="relative">
                                <input id="password" type="password" name="password" required placeholder="••••••••"
                                    class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('password') border-red-300 bg-red-50 @enderror">
                                <button type="button" onclick="togglePassword('password','pw-icon')" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-500 transition-colors"><i id="pw-icon" class="fas fa-eye"></i></button>
                            </div>
                            @error('password')<span class="text-sm text-red-500 font-medium mt-1"><i class="fas fa-circle-exclamation ml-1"></i>{{ $message }}</span>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-lock ml-1.5 text-primary-400"></i>تأكيد كلمة المرور</label>
                            <div class="relative">
                                <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="••••••••"
                                    class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none">
                                <button type="button" onclick="togglePassword('password_confirmation','pw-icon2')" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-500 transition-colors"><i id="pw-icon2" class="fas fa-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-6 p-4 bg-primary-50/50 rounded-2xl border border-primary-100">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="terms" id="terms" required class="w-5 h-5 mt-0.5 rounded-lg border-gray-300 text-primary-500 focus:ring-primary-200 cursor-pointer shrink-0">
                            <span class="text-sm text-gray-600 leading-relaxed">أوافق على <a href="#" class="text-primary-600 font-bold hover:text-primary-700">شروط الخدمة</a> و <a href="#" class="text-primary-600 font-bold hover:text-primary-700">سياسة الخصوصية</a></span>
                        </label>
                    </div>
                    <button type="submit" class="w-full py-3.5 bg-gradient-to-l from-primary-500 to-primary-600 text-white font-bold rounded-2xl hover:shadow-xl hover:shadow-primary-500/30 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-200 text-base"><i class="fas fa-user-plus ml-2"></i>إنشاء الحساب</button>
                </form>
                <div class="mt-6 text-center space-y-3">
                    <a href="{{ route('login') }}" class="block text-primary-600 hover:text-primary-700 font-bold transition-all duration-200 text-sm"><i class="fas fa-right-to-bracket ml-2"></i>لديك حساب بالفعل؟ تسجيل الدخول</a>
                    @if (Route::has('organization.register'))
                        <a href="{{ route('organization.register') }}" class="block text-secondary-600 hover:text-secondary-700 font-bold transition-all duration-200 text-sm"><i class="fas fa-building ml-2"></i>هل أنت مؤسسة؟ تسجيل مؤسسة جديدة</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>function togglePassword(i,c){const p=document.getElementById(i),n=document.getElementById(c);if(p.type==='password'){p.type='text';n.classList.remove('fa-eye');n.classList.add('fa-eye-slash')}else{p.type='password';n.classList.remove('fa-eye-slash');n.classList.add('fa-eye')}}</script>
@endsection