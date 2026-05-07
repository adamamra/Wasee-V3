@extends('layouts.app')

@section('title', 'تسجيل مؤسسة جديدة')

@section('content')
<style>
    .org-register-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
    }

    .org-register-card {
        max-width: 520px;
        width: 100%;
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .org-register-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        padding: 32px 32px 24px;
        text-align: center;
        position: relative;
    }

    .org-register-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #f59e0b);
    }

    .org-register-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .org-register-header p {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0;
        font-weight: 500;
    }

    .org-register-body {
        padding: 32px;
    }

    .form-group-org {
        margin-bottom: 20px;
    }

    .form-label-org {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-input-org {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
        background: #f9fafb;
    }

    .form-input-org:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-input-org.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-textarea-org {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
        background: #f9fafb;
        resize: vertical;
        min-height: 80px;
    }

    .form-textarea-org:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-textarea-org.is-invalid {
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
        margin-top: 8px;
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

    .back-link {
        display: block;
        text-align: center;
        margin-top: 24px;
        color: #6b7280;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .back-link:hover {
        color: #6366f1;
    }

    .login-link {
        display: block;
        text-align: center;
        margin-top: 16px;
        color: #6366f1;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .login-link:hover {
        color: #4f46e5;
    }

    @media (max-width: 640px) {
        .org-register-container {
            padding: 20px 16px;
        }

        .org-register-card {
            border-radius: 20px;
        }

        .org-register-header {
            padding: 24px 20px 20px;
        }

        .org-register-header h2 {
            font-size: 1.5rem;
        }

        .org-register-body {
            padding: 24px 20px;
        }
    }
</style>

<div class="org-register-container">
    <div class="org-register-card">
        <div class="org-register-header">
            <h2>
                <i class="fas fa-building"></i>
                تسجيل مؤسسة جديدة
            </h2>
            <p>أنشئ حساب مؤسسة جديد للاستخدام خدمات نظام وصيّ</p>
        </div>

        <div class="org-register-body">
            <form method="POST" action="{{ route('organization.register') }}">
                @csrf

                <div class="form-group-org">
                    <label for="name" class="form-label-org">
                        <i class="fas fa-building me-2"></i>
                        اسم المؤسسة
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        class="form-input-org @error('name') is-invalid @enderror" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus
                        placeholder="مثال: شركة النجاح للمقاولات"
                    >
                    @error('name')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group-org">
                    <label for="email" class="form-label-org">
                        <i class="fas fa-envelope me-2"></i>
                        البريد الإلكتروني
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-input-org @error('email') is-invalid @enderror" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required
                        placeholder="info@organization.com"
                    >
                    @error('email')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group-org">
                    <label for="phone" class="form-label-org">
                        <i class="fas fa-phone me-2"></i>
                        رقم الهاتف
                    </label>
                    <input 
                        id="phone" 
                        type="tel" 
                        class="form-input-org @error('phone') is-invalid @enderror" 
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

                <div class="form-group-org">
                    <label for="address" class="form-label-org">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        العنوان
                    </label>
                    <textarea 
                        id="address" 
                        name="address" 
                        class="form-textarea-org @error('address') is-invalid @enderror" 
                        rows="3" 
                        required
                        placeholder=""
                    >{{ old('address') }}</textarea>
                    @error('address')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group-org">
                    <label for="password" class="form-label-org">
                        <i class="fas fa-lock me-2"></i>
                        كلمة المرور
                    </label>
                    <div class="password-wrapper">
                        <input 
                            id="password" 
                            type="password" 
                            class="form-input-org @error('password') is-invalid @enderror" 
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

                <div class="form-group-org">
                    <label for="password-confirm" class="form-label-org">
                        <i class="fas fa-lock me-2"></i>
                        تأكيد كلمة المرور
                    </label>
                    <div class="password-wrapper">
                        <input 
                            id="password-confirm" 
                            type="password" 
                            class="form-input-org @error('password_confirmation') is-invalid @enderror" 
                            name="password_confirmation" 
                            required
                            placeholder="••••••••"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                            <i class="fas fa-eye" id="password-confirm-icon"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <button type="submit" class="register-btn">
                    <i class="fas fa-user-plus me-2"></i>
                    إنشاء حساب المؤسسة
                </button>
            </form>

            <a href="{{ route('organization.login') }}" class="login-link">
                <i class="fas fa-sign-in-alt me-2"></i>
                لديك حساب بالفعل؟ تسجيل الدخول
            </a>

            <a href="{{ route('register') }}" class="back-link">
                <i class="fas fa-arrow-right me-2"></i>
                التسجيل كفرد
            </a>
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
