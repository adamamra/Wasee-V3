@extends('layouts.organization')

@section('title', 'الملف الشخصي للمؤسسة')

@section('content')
<style>
    .profile-header {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #8b5cf6 100%);
        color: white;
        padding: 40px;
        border-radius: 20px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .profile-title {
        font-size: 2rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
        font-weight: 500;
    }

    .profile-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .form-container {
        padding: 40px;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-divider {
        height: 2px;
        background: linear-gradient(90deg, #e5e7eb, #f3f4f6);
        margin: 32px 0;
        border-radius: 1px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    .form-group {
        position: relative;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-input {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
        background: #f9fafb;
    }

    .form-input:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-input.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .password-section {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(99, 102, 241, 0.02));
        border: 1px solid rgba(99, 102, 241, 0.1);
        border-radius: 16px;
        padding: 32px;
        margin-top: 32px;
    }

    .password-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .error-message {
        display: block;
        margin-top: 8px;
        color: #ef4444;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .save-btn {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .save-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .save-btn:hover::before {
        left: 100%;
    }

    .save-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(99, 102, 241, 0.3);
    }

    .info-box {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(16, 185, 129, 0.02));
        border: 1px solid rgba(16, 185, 129, 0.1);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .info-content h4 {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 4px 0;
    }

    .info-content p {
        font-size: 0.95rem;
        color: #64748b;
        margin: 0;
        line-height: 1.5;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .password-row {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .profile-header {
            padding: 24px;
        }

        .profile-title {
            font-size: 1.5rem;
        }

        .form-container {
            padding: 24px;
        }

        .password-section {
            padding: 20px;
        }

        .save-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<!-- Profile Header -->
<div class="profile-header">
    <h1 class="profile-title">
        <i class="fas fa-building"></i>
        الملف الشخصي للمؤسسة
    </h1>
    <p class="profile-subtitle">إدارة معلومات المؤسسة وتحديث البيانات</p>
</div>

<!-- Info Box -->
<div class="info-box">
    <div class="info-icon">
        <i class="fas fa-info-circle"></i>
    </div>
    <div class="info-content">
        <h4>معلومات هامة</h4>
        <p>تأكد من صحة جميع المعلومات قبل حفظ التغييرات. سيتم تحديث بيانات المؤسسة فوراً بعد الحفظ.</p>
    </div>
</div>

<!-- Profile Form -->
<div class="profile-card">
    <div class="form-container">
        <form method="POST" action="{{ route('organization.profile.update') }}">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <h2 class="section-title">
                <i class="fas fa-user-edit"></i>
                المعلومات الأساسية
            </h2>

            <div class="form-row">
                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="fas fa-building"></i>
                        اسم المؤسسة
                    </label>
                    <input 
                        type="text" 
                        id="name"
                        name="name" 
                        class="form-input @error('name') is-invalid @enderror" 
                        value="{{ old('name', $organization->name) }}" 
                        required
                        placeholder="أدخل اسم المؤسسة"
                    >
                    @error('name')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        البريد الإلكتروني
                    </label>
                    <input 
                        type="email" 
                        id="email"
                        name="email" 
                        class="form-input @error('email') is-invalid @enderror" 
                        value="{{ old('email', $organization->email) }}" 
                        required
                        placeholder="example@domain.com"
                    >
                    @error('email')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone" class="form-label">
                        <i class="fas fa-phone"></i>
                        رقم الجوال
                    </label>
                    <input 
                        type="text" 
                        id="phone"
                        name="phone" 
                        class="form-input @error('phone') is-invalid @enderror" 
                        value="{{ old('phone', $organization->phone) }}" 
                        required
                        placeholder="+970 50 123 4567"
                    >
                    @error('phone')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">
                        <i class="fas fa-map-marker-alt"></i>
                        العنوان
                    </label>
                    <input 
                        type="text" 
                        id="address"
                        name="address" 
                        class="form-input @error('address') is-invalid @enderror" 
                        value="{{ old('address', $organization->address) }}" 
                        required
                        placeholder="أدخل العنوان الكامل"
                    >
                    @error('address')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle ml-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Password Section -->
            <div class="password-section">
                <h2 class="section-title">
                    <i class="fas fa-lock"></i>
                    تغيير كلمة المرور
                </h2>

                <div class="password-row">
                    <div class="form-group">
                        <label for="current_password" class="form-label">
                            <i class="fas fa-key"></i>
                            كلمة المرور الحالية
                        </label>
                        <input 
                            type="password" 
                            id="current_password"
                            name="current_password" 
                            class="form-input @error('current_password') is-invalid @enderror"
                            placeholder="أدخل كلمة المرور الحالية"
                        >
                        @error('current_password')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle ml-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password" class="form-label">
                            <i class="fas fa-lock"></i>
                            كلمة المرور الجديدة
                        </label>
                        <input 
                            type="password" 
                            id="new_password"
                            name="new_password" 
                            class="form-input @error('new_password') is-invalid @enderror"
                            placeholder="أدخل كلمة المرور الجديدة"
                        >
                        @error('new_password')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle ml-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="new_password_confirmation" class="form-label">
                            <i class="fas fa-check-circle"></i>
                            تأكيد كلمة المرور الجديدة
                        </label>
                        <input 
                            type="password" 
                            id="new_password_confirmation"
                            name="new_password_confirmation" 
                            class="form-input"
                            placeholder="أعد إدخال كلمة المرور الجديدة"
                        >
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-left mt-8">
                <button type="submit" class="save-btn">
                    <i class="fas fa-save"></i>
                    حفظ التغييرات
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
