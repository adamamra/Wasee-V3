@extends('layouts.app')

@section('title', 'تسجيل دخول المؤسسة')

@section('content')
<div class="min-h-[calc(100vh-12rem)] flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-2xl shadow-gray-200/60 border border-gray-50 overflow-hidden">
            <div class="bg-gradient-to-br from-gray-900 via-slate-800 to-gray-900 p-8 text-center text-white relative overflow-hidden">
                <div class="absolute -top-20 -right-20 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl border border-white/20 shadow-lg"><i class="fas fa-building"></i></div>
                    <h2 class="text-2xl font-black mb-1">تسجيل دخول المؤسسة</h2>
                    <p class="text-white/80 text-sm font-medium">الوصول إلى لوحة تحكم المؤسسة</p>
                </div>
            </div>
            <div class="p-8">
                <form method="POST" action="{{ route('organization.login') }}">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-envelope ml-2 text-gray-400"></i>البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="info@organization.com"
                            class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('email') border-red-300 bg-red-50 @enderror">
                        @error('email')<span class="text-sm text-red-500 font-medium mt-1.5 block">{{ $message }}</span>@enderror
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-bold text-gray-700 mb-2"><i class="fas fa-lock ml-2 text-gray-400"></i>كلمة المرور</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required placeholder="••••••••"
                                class="w-full px-4 py-3 bg-gray-50 border-2 border-gray-200 rounded-2xl text-gray-700 placeholder-gray-400 focus:border-primary-400 focus:bg-white focus:ring-4 focus:ring-primary-100 transition-all duration-200 outline-none @error('password') border-red-300 bg-red-50 @enderror">
                            <button type="button" onclick="togglePassword()" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-primary-500 transition-colors"><i id="pw-icon" class="fas fa-eye"></i></button>
                        </div>
                        @error('password')<span class="text-sm text-red-500 font-medium mt-1.5 block">{{ $message }}</span>@enderror
                    </div>
                    <div class="flex items-center gap-3 mb-6">
                        <input type="checkbox" name="remember" id="remember" class="w-5 h-5 rounded-lg border-gray-300 text-primary-500 focus:ring-primary-200 cursor-pointer" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="text-sm font-medium text-gray-600 cursor-pointer select-none">تذكرني</label>
                    </div>
                    <button type="submit" class="w-full py-3.5 bg-gradient-to-l from-gray-800 to-gray-900 text-white font-bold rounded-2xl hover:shadow-xl hover:shadow-gray-800/30 hover:-translate-y-0.5 active:scale-[0.98] transition-all duration-200 text-base"><i class="fas fa-right-to-bracket ml-2"></i>تسجيل الدخول</button>
                </form>
                <div class="mt-6 text-center">
                    <a href="{{ route('login') }}" class="text-gray-500 hover:text-primary-600 font-medium transition-colors text-sm"><i class="fas fa-arrow-right ml-2"></i>العودة لتسجيل الدخول العادي</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>function togglePassword(){const i=document.getElementById('password'),c=document.getElementById('pw-icon');if(i.type==='password'){i.type='text';c.classList.remove('fa-eye');c.classList.add('fa-eye-slash')}else{i.type='password';c.classList.remove('fa-eye-slash');c.classList.add('fa-eye')}}</script>
@endsection