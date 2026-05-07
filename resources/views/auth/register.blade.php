@extends('layouts.app')

@section('title', 'تسجيل حساب جديد')

@section('content')
<style>
    .user-register-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
    }

    .user-register-card {
        max-width: 580px;
        width: 100%;
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .user-register-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        padding: 32px 32px 24px;
        text-align: center;
        position: relative;
    }

    .user-register-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #f59e0b);
    }

    .user-register-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .user-register-header p {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0;
        font-weight: 500;
    }

    .user-register-body {
        padding: 32px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-bottom: 20px;
    }

    .form-group-user {
        margin-bottom: 20px;
    }

    .form-label-user {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-input-user {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
        background: #f9fafb;
    }

    .form-input-user:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-input-user.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .password-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        font-size: 1.1rem;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #6366f1;
    }

    .terms-wrapper {
        margin-bottom: 24px;
        padding: 16px;
        background: rgba(99, 102, 241, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(99, 102, 241, 0.1);
    }

    .terms-checkbox {
        width: 20px;
        height: 20px;
        accent-color: #6366f1;
        cursor: pointer;
        margin-top: 2px;
    }

    .terms-label {
        color: #374151;
        font-size: 0.95rem;
        line-height: 1.6;
        cursor: pointer;
        user-select: none;
    }

    .terms-link {
        color: #6366f1;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .terms-link:hover {
        color: #4f46e5;
        text-decoration: underline;
    }

    .register-btn {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .register-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .register-btn:hover::before {
        left: 100%;
    }

    .register-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(99, 102, 241, 0.3);
    }

    .error-message {
        display: block;
        margin-top: 8px;
        color: #ef4444;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .login-link {
        display: block;
        text-align: center;
        color: #6366f1;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 24px;
    }

    .login-link:hover {
        color: #4f46e5;
        transform: translateX(4px);
    }

    .org-register-link {
        display: block;
        text-align: center;
        color: #10b981;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-top: 12px;
    }

    .org-register-link:hover {
        color: #059669;
        transform: translateX(4px);
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .user-register-container {
            padding: 20px 16px;
        }

        .user-register-card {
            border-radius: 20px;
        }

        .user-register-header {
            padding: 24px 20px 20px;
        }

        .user-register-header h2 {
            font-size: 1.5rem;
        }

        .user-register-body {
            padding: 24px 20px;
        }
    }
</style>

<div class="user-register-container">
    <div class="user-register-card">
        <div class="user-register-header">
            <h2>
                <i class="fas fa-user-plus"></i>
                إنشاء حساب جديد
            </h2>
            <p>انضم إلينا واستمتع بخدمات الوصاية الآمنة والمتطورة</p>
        </div>

        <div class="user-register-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-row">
                    <div class="form-group-user">
                        <label for="name" class="form-label-user">
                            <i class="fas fa-user me-2"></i>
                            الاسم الكامل
                        </label>
                        <input 
                            id="name" 
                            type="text" 
                            class="form-input-user @error('name') is-invalid @enderror" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            autofocus
                            placeholder="أدخل الاسم الكامل"
                        >
                        @error('name')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-user">
                        <label for="id_number" class="form-label-user">
                            <i class="fas fa-id-card me-2"></i>
                            رقم الهوية
                        </label>
                        <input 
                            id="id_number" 
                            type="text" 
                            class="form-input-user @error('id_number') is-invalid @enderror" 
                            name="id_number" 
                            value="{{ old('id_number') }}" 
                            required
                            placeholder="أدخل رقم الهوية"
                        >
                        @error('id_number')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-user">
                        <label for="email" class="form-label-user">
                            <i class="fas fa-envelope me-2"></i>
                            البريد الإلكتروني
                        </label>
                        <input 
                            id="email" 
                            type="email" 
                            class="form-input-user @error('email') is-invalid @enderror" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required
                            placeholder="example@domain.com"
                        >
                        @error('email')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-user">
                        <label for="phone" class="form-label-user">
                            <i class="fas fa-phone me-2"></i>
                            رقم الجوال
                        </label>
                        <input 
                            id="phone" 
                            type="tel" 
                            class="form-input-user @error('phone') is-invalid @enderror" 
                            name="phone" 
                            value="{{ old('phone') }}" 
                            required
                            placeholder="+970 50 123 4567"
                        >
                        @error('phone')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-user">
                        <label for="password" class="form-label-user">
                            <i class="fas fa-lock me-2"></i>
                            كلمة المرور
                        </label>
                        <div class="password-wrapper">
                            <input 
                                id="password" 
                                type="password" 
                                class="form-input-user @error('password') is-invalid @enderror" 
                                name="password" 
                                required
                                placeholder="••••••••"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="fas fa-eye" id="password-icon"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-user">
                        <label for="password_confirmation" class="form-label-user">
                            <i class="fas fa-lock me-2"></i>
                            تأكيد كلمة المرور
                        </label>
                        <div class="password-wrapper">
                            <input 
                                id="password_confirmation" 
                                type="password" 
                                class="form-input-user @error('password_confirmation') is-invalid @enderror" 
                                name="password_confirmation" 
                                required
                                placeholder="••••••••"
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <i class="fas fa-eye" id="password_confirmation-icon"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="terms-wrapper">
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input type="checkbox" name="terms" id="terms" class="terms-checkbox" required>
                        <span class="terms-label">
                            أوافق على <a href="#" class="terms-link">شروط الخدمة</a> و <a href="#" class="terms-link">سياسة الخصوصية</a>
                        </span>
                    </label>
                </div>

                <button type="submit" class="register-btn">
                    <i class="fas fa-user-plus me-2"></i>
                    إنشاء الحساب
                </button>
            </form>

            <a href="{{ route('login') }}" class="login-link">
                <i class="fas fa-sign-in-alt me-2"></i>
                لديك حساب بالفعل؟ تسجيل الدخول
            </a>

            @if (Route::has('organization.register'))
                <a href="{{ route('organization.register') }}" class="org-register-link">
                    <i class="fas fa-building me-2"></i>
                    هل أنت مؤسسة؟ تسجيل مؤسسة جديدة
                </a>
            @endif
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(inputId + '-icon');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
