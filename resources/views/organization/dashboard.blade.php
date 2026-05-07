@extends('layouts.organization')

@section('title', 'لوحة تحكم المؤسسة')

@section('content')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 50%, #8b5cf6 100%);
        color: white;
        padding: 40px;
        border-radius: 20px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 24px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 16px;
    }

    .stat-icon.total {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
    }

    .stat-icon.pending {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .stat-icon.delivered {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .stat-label {
        font-size: 1rem;
        color: #64748b;
        font-weight: 500;
    }

    .search-card {
        background: white;
        border-radius: 20px;
        padding: 32px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        margin-bottom: 32px;
    }

    .search-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .search-input {
        width: 100%;
        padding: 16px 20px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        outline: none;
        background: #f9fafb;
    }

    .search-input:focus {
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .search-btn {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        border: none;
        padding: 16px 24px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(99, 102, 241, 0.3);
    }

    .parcel-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .parcel-header {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        padding: 24px 32px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .parcel-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .parcel-body {
        padding: 32px;
    }

    .status-badge {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .status-badge.pending {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        color: #92400e;
    }

    .status-badge.delivered {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
    }

    .progress-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 24px 0;
        position: relative;
    }

    .progress-bar::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: #e5e7eb;
        z-index: 1;
    }

    .progress-step {
        position: relative;
        z-index: 2;
        text-align: center;
    }

    .progress-dot {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        margin: 0 auto 8px;
        transition: all 0.3s ease;
    }

    .progress-dot.active {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.2);
    }

    .progress-dot.inactive {
        background: #e5e7eb;
        border: 2px solid #f9fafb;
    }

    .progress-text {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
    }

    .info-section {
        margin-bottom: 32px;
    }

    .info-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #374151;
        min-width: 140px;
    }

    .info-value {
        color: #1e293b;
        text-align: left;
        flex: 1;
    }

    .delivery-form {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(99, 102, 241, 0.02));
        border: 1px solid rgba(99, 102, 241, 0.1);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
    }

    .delivery-input {
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        outline: none;
        background: white;
    }

    .delivery-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .action-buttons {
        display: flex;
        gap: 16px;
        align-items: center;
        justify-content: space-between;
        padding: 24px 32px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
    }

    .back-btn {
        background: transparent;
        color: #6b7280;
        border: 2px solid #e5e7eb;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background: #f9fafb;
        border-color: #d1d5db;
        color: #4b5563;
        transform: translateY(-2px);
    }

    .confirm-btn {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .confirm-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .dashboard-header {
            padding: 24px;
        }

        .search-card {
            padding: 20px;
        }

        .parcel-body {
            padding: 20px;
        }

        .action-buttons {
            flex-direction: column;
            gap: 12px;
        }

        .delivery-form {
            padding: 16px;
        }
    }
</style>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <h1 class="text-3xl font-bold mb-2">
        <i class="fas fa-tachometer-alt ml-3"></i>
        لوحة تحكم المؤسسة
    </h1>
    <p class="text-lg opacity-90">مرحباً بك في لوحة تحكم المؤسسة</p>
</div>

<!-- Statistics Cards -->
@if(isset($stats))
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon total">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['total']) }}</div>
            <div class="stat-label">إجمالي الطلبات</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['pending']) }}</div>
            <div class="stat-label">قيد الانتظار</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon delivered">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-value">{{ number_format($stats['delivered']) }}</div>
            <div class="stat-label">تم التسليم</div>
        </div>
    </div>
@endif

<!-- Search Section -->
<div class="search-card">
    <h2 class="search-title">
        <i class="fas fa-search"></i>
        بحث عن طلب وصاية
    </h2>
    
    <form method="GET" action="{{ route('organization.parcels.search') }}">
        @csrf
        <div class="flex gap-3">
            <input type="text" 
                   name="serial_number" 
                   class="search-input" 
                   placeholder="أدخل رقم السيريال للبحث"
                   value="{{ request('serial_number', '') }}"
                   required>
            <button type="submit" class="search-btn">
                <i class="fas fa-search"></i>
                بحث
            </button>
        </div>
        @error('serial_number')
            <div class="mt-2 text-red-600 text-sm font-medium">
                <i class="fas fa-exclamation-circle ml-1"></i>
                {{ $message }}
            </div>
        @enderror
    </form>
</div>

<!-- Parcel Details -->
@if(isset($parcel) && $searched)
    <div class="parcel-card">
        <div class="parcel-header">
            <h3 class="parcel-title">
                <i class="fas fa-box-open"></i>
                تفاصيل طلب الوصاية
            </h3>
        </div>

        <div class="parcel-body">
            <!-- Status Section -->
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="font-bold text-lg">حالة الطلب الحالية</span>
                    <span class="status-badge {{ $parcel->status == 'delivered' ? 'delivered' : 'pending' }}">
                        {{ $parcel->status == 'delivered' ? 'تم التسليم' : 'قيد الانتظار' }}
                    </span>
                </div>

                <div class="progress-bar">
                    <div class="progress-step">
                        <div class="progress-dot active"></div>
                        <div class="progress-text">تم إنشاء الطلب</div>
                    </div>
                    <div class="progress-step">
                        <div class="progress-dot {{ $parcel->status == 'delivered' ? 'active' : 'inactive' }}"></div>
                        <div class="progress-text">تم التسليم</div>
                    </div>
                </div>
            </div>

            <!-- Basic Info -->
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">رقم السيريال:</span>
                    <span class="info-value">{{ $parcel->serial_number }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">حالة الطلب:</span>
                    <span class="info-value">
                        <span class="status-badge {{ $parcel->status == 'delivered' ? 'delivered' : 'pending' }}">
                            {{ $parcel->status == 'delivered' ? 'تم التسليم' : 'قيد الانتظار' }}
                        </span>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">تاريخ الإنشاء:</span>
                    <span class="info-value">{{ $parcel->created_at->format('Y-m-d') }}</span>
                </div>
            </div>

            <!-- Agent Info -->
            <div class="info-section">
                <h4 class="info-title">
                    <i class="fas fa-user-shield"></i>
                    معلومات الوصي
                </h4>
                <div class="info-row">
                    <span class="info-label">اسم الوصي:</span>
                    <span class="info-value">{{ $parcel->agent_name ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">رقم الجوال:</span>
                    <span class="info-value">{{ $parcel->agent_phone ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">رقم الهوية:</span>
                    <span class="info-value">{{ $parcel->agent_id_number ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">اسم المؤسسة / الفرع:</span>
                    <span class="info-value">{{ $parcel->branch_name ?? 'غير محدد' }}</span>
                </div>
            </div>

            <!-- Sender Info -->
            <div class="info-section">
                <h4 class="info-title">
                    <i class="fas fa-user"></i>
                    معلومات مرسل طلب الوصاية
                </h4>
                <div class="info-row">
                    <span class="info-label">الاسم:</span>
                    <span class="info-value">{{ $parcel->sender_name ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">رقم الهاتف:</span>
                    <span class="info-value">{{ $parcel->sender_phone ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">رقم الهوية:</span>
                    <span class="info-value">{{ $parcel->sender_id_number ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">العنوان:</span>
                    <span class="info-value">{{ $parcel->sender_address ?? 'غير محدد' }}</span>
                </div>
            </div>

            <!-- Receiver Info -->
            <div class="info-section">
                <h4 class="info-title">
                    <i class="fas fa-user"></i>
                    معلومات المستلم
                </h4>
                <div class="info-row">
                    <span class="info-label">الاسم:</span>
                    <span class="info-value">{{ $parcel->receiver_name ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">رقم الهاتف:</span>
                    <span class="info-value">{{ $parcel->receiver_phone ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">رقم الهوية:</span>
                    <span class="info-value">{{ $parcel->receiver_id_number ?? 'غير محدد' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">العنوان:</span>
                    <span class="info-value">{{ $parcel->receiver_address ?? 'غير محدد' }}</span>
                </div>
            </div>

            <!-- Notes -->
            @if($parcel->notes)
                <div class="info-section">
                    <h4 class="info-title">
                        <i class="fas fa-sticky-note"></i>
                        ملاحظات إضافية
                    </h4>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-700">{{ $parcel->notes }}</p>
                    </div>
                </div>
            @endif
        </div>

        @if($parcel->status != \App\Models\Parcel::STATUS_DELIVERED)
            <div class="action-buttons">
                <a href="{{ route('organization.dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-right"></i>
                    رجوع
                </a>

                <form action="{{ route('organization.parcels.update-status', $parcel) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="delivery-form">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <input type="text" name="receiver_name" class="delivery-input" placeholder="اسم المستلم" value="{{ old('receiver_name', $parcel->receiver_name) }}">
                            <input type="text" name="receiver_phone" class="delivery-input" placeholder="جوال المستلم" value="{{ old('receiver_phone', $parcel->receiver_phone) }}">
                            <input type="text" name="receiver_id_number" class="delivery-input" placeholder="هوية المستلم" value="{{ old('receiver_id_number', $parcel->receiver_id_number) }}">
                            <input type="text" name="receiver_address" class="delivery-input" placeholder="عنوان المستلم" value="{{ old('receiver_address', $parcel->receiver_address) }}">
                        </div>

                        <input type="hidden" name="status" value="{{ \App\Models\Parcel::STATUS_DELIVERED }}">
                        <button type="submit" class="confirm-btn">
                            <i class="fas fa-check"></i>
                            تأكيد التسليم
                        </button>
                    </div>
                </form>
            </div>
        @else
            <div class="action-buttons">
                <a href="{{ route('organization.dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-right"></i>
                    رجوع
                </a>
            </div>
        @endif
    </div>
@endif
@endsection
