@extends('layouts.app')

@section('title', 'طلب وصاية جديد')

@section('content')
<style>
    .request-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
    }

    .request-card {
        max-width: 680px;
        width: 100%;
        background: white;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .request-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        padding: 32px 32px 24px;
        text-align: center;
        position: relative;
    }

    .request-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #10b981, #f59e0b);
    }

    .request-header h2 {
        font-size: 1.8rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }

    .request-header p {
        font-size: 1rem;
        opacity: 0.9;
        margin: 0;
        font-weight: 500;
    }

    .request-body {
        padding: 32px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .form-group-request {
        margin-bottom: 24px;
    }

    .form-label-request {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-input-request {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
        background: #f9fafb;
    }

    .form-input-request:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-input-request.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-select-request {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        outline: none;
        background: #f9fafb;
        cursor: pointer;
    }

    .form-select-request:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .form-select-request.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .error-message {
        display: block;
        margin-top: 8px;
        color: #ef4444;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .submit-btn {
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

    .submit-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .submit-btn:hover::before {
        left: 100%;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 24px rgba(99, 102, 241, 0.3);
    }

    .cancel-btn {
        width: 100%;
        padding: 16px;
        background: transparent;
        color: #6b7280;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .cancel-btn:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        color: #4b5563;
        transform: translateY(-2px);
    }

    .button-row {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 16px;
        margin-top: 32px;
    }

    .info-box {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(99, 102, 241, 0.02));
        border: 1px solid rgba(99, 102, 241, 0.1);
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
        background: linear-gradient(135deg, #6366f1, #4f46e5);
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

        .button-row {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .request-container {
            padding: 20px 16px;
        }

        .request-card {
            border-radius: 20px;
        }

        .request-header {
            padding: 24px 20px 20px;
        }

        .request-header h2 {
            font-size: 1.5rem;
        }

        .request-body {
            padding: 24px 20px;
        }

        .info-box {
            flex-direction: column;
            text-align: center;
            gap: 12px;
        }
    }
</style>

<div class="request-container">
    <div class="request-card">
        <div class="request-header">
            <h2>
                <i class="fas fa-file-signature"></i>
                طلب وصاية جديد
            </h2>
            <p>أكمل النموذج أدناه لتقديم طلب وصاية جديد</p>
        </div>

        <div class="request-body">
            <div class="info-box">
                <div class="info-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div class="info-content">
                    <h4>معلومات هامة</h4>
                    <p>تأكد من صحة جميع المعلومات قبل تقديم الطلب. سيتم مراجعة طلبك من قبل الجهة المختصة.</p>
                </div>
            </div>

            <form action="{{ route('parcels.store') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group-request">
                        <label for="organization_id" class="form-label-request">
                            <i class="fas fa-building me-2"></i>
                            المؤسسة
                        </label>
                        <select class="form-select-request @error('organization_id') is-invalid @enderror" id="organization_id" name="organization_id" required>
                            <option value="">اختر المؤسسة</option>
                            @foreach(($organizations ?? []) as $org)
                                <option value="{{ $org->id }}" {{ old('organization_id') == $org->id ? 'selected' : '' }}>{{ $org->name }}</option>
                            @endforeach
                        </select>
                        @error('organization_id')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-request">
                        <label for="parcel_number" class="form-label-request">
                            <i class="fas fa-barcode me-2"></i>
                            رقم الطرد
                        </label>
                        <input type="text" class="form-input-request @error('parcel_number') is-invalid @enderror" 
                               id="parcel_number" name="parcel_number" value="{{ old('parcel_number') }}" required
                               placeholder="أدخل رقم الطرد">
                        @error('parcel_number')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-request">
                        <label for="agent_name" class="form-label-request">
                            <i class="fas fa-user me-2"></i>
                            اسم الوصي
                        </label>
                        <input type="text" class="form-input-request @error('agent_name') is-invalid @enderror" 
                               id="agent_name" name="agent_name" value="{{ old('agent_name') }}" required
                               placeholder="أدخل اسم الوصي بالكامل">
                        @error('agent_name')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-request">
                        <label for="agent_phone" class="form-label-request">
                            <i class="fas fa-phone me-2"></i>
                            رقم الجوال
                        </label>
                        <input type="tel" class="form-input-request @error('agent_phone') is-invalid @enderror" 
                               id="agent_phone" name="agent_phone" value="{{ old('agent_phone') }}" required
                               placeholder="+970 50 123 4567">
                        @error('agent_phone')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group-request">
                        <label for="agent_id_number" class="form-label-request">
                            <i class="fas fa-id-card me-2"></i>
                            رقم الهوية
                        </label>
                        <input type="text" class="form-input-request @error('agent_id_number') is-invalid @enderror" 
                               id="agent_id_number" name="agent_id_number" value="{{ old('agent_id_number') }}" required
                               placeholder="أدخل رقم الهوية">
                        @error('agent_id_number')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group-request">
                        <label for="branch_name" class="form-label-request">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            اسم الفرع
                        </label>
                        <input type="text" class="form-input-request @error('branch_name') is-invalid @enderror" 
                               id="branch_name" name="branch_name" value="{{ old('branch_name') }}" required
                               placeholder="أدخل اسم المؤسسة / الفرع">
                        @error('branch_name')
                            <span class="error-message">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group-request">
                    <label for="custody_days" class="form-label-request">
                        <i class="fas fa-calendar me-2"></i>
                        مدة الوصاية (بالأيام)
                    </label>
                    <input type="number" class="form-input-request @error('custody_days') is-invalid @enderror" 
                           id="custody_days" name="custody_days" min="1" max="365" 
                           value="{{ old('custody_days', 1) }}" required
                           placeholder="أدخل عدد الأيام">
                    @error('custody_days')
                        <span class="error-message">
                            <i class="fas fa-exclamation-circle me-1"></i>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="button-row">
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-check me-2"></i>
                        حفظ الطلب
                    </button>
                    <a href="{{ route('parcels.my') }}" class="cancel-btn">
                        <i class="fas fa-times me-2"></i>
                        إلغاء
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
