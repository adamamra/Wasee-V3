@extends('layouts.app')

@section('title', 'وصيّ -  الرئيسية')

@section('content')
<style>
    .dashboard-header {
        background: linear-gradient(135deg, #6366f1 0%, #4f46e5 25%, #7c3aed 50%, #4f46e5 75%, #6366f1 100%);
        color: white;
        padding: 60px 40px;
        border-radius: 24px;
        margin-bottom: 48px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.2);
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        top: -40%;
        right: -15%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 12s ease-in-out infinite;
    }

    .dashboard-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -15%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 10s ease-in-out infinite reverse;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) translateX(0) rotate(0deg); }
        25% { transform: translateY(-20px) translateX(15px) rotate(90deg); }
        50% { transform: translateY(40px) translateX(-10px) rotate(180deg); }
        75% { transform: translateY(-15px) translateX(-20px) rotate(270deg); }
    }

    .dashboard-header h1 {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 900;
        margin-bottom: 16px;
        position: relative;
        z-index: 10;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .dashboard-header p {
        font-size: 1.2rem;
        opacity: 0.95;
        position: relative;
        z-index: 10;
        font-weight: 500;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-top: 32px;
        position: relative;
        z-index: 10;
    }

    .quick-start-guide {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        padding: 24px;
        margin-top: 32px;
        position: relative;
        z-index: 10;
    }

    .guide-header {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        font-weight: 700;
        color: white;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .guide-steps {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }

    .guide-step {
        display: flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.15);
        padding: 12px 20px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }

    .guide-step:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .step-num {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.7));
        color: #6366f1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .step-text {
        color: white;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .action-btn {
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 16px 28px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.4s ease;
        display: inline-flex;
        align-items: center;
        gap: 12px;
        backdrop-filter: blur(10px);
        position: relative;
        overflow: hidden;
    }

    .action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .action-btn:hover::before {
        left: 100%;
    }

    .action-btn:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: white;
        transform: translateY(-4px) scale(1.05);
        color: white;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 16px;
        margin-bottom: 32px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 20px 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        text-align: center;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #6366f1, #10b981);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin: 0 auto 16px;
        transition: all 0.3s ease;
        position: relative;
    }

    .stat-icon::after {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border-radius: 12px;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.2s ease;
    }

    .stat-card:hover .stat-icon::after {
        opacity: 1;
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.05);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 8px;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 48px;
    }

    .feature-box {
        background: white;
        border-radius: 20px;
        padding: 40px 32px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        text-align: center;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    }

    .feature-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #10b981);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .feature-box:hover::before {
        transform: scaleX(1);
    }

    .feature-box:hover {
        transform: translateY(-16px);
        box-shadow: 0 24px 48px rgba(0, 0, 0, 0.15);
    }

    .feature-icon-box {
        width: 80px;
        height: 80px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        margin: 0 auto 24px;
        transition: all 0.4s ease;
        position: relative;
    }

    .feature-icon-box::after {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        border-radius: 16px;
        background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .feature-box:hover .feature-icon-box::after {
        opacity: 1;
    }

    .feature-box:hover .feature-icon-box {
        transform: scale(1.15) rotate(8deg);
    }

    .feature-title {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 16px;
        color: #1e293b;
    }

    .feature-desc {
        color: #64748b;
        font-size: 1.05rem;
        line-height: 1.7;
    }

    /* Simple Steps Section */
    .bottom-steps-section {
        padding: 60px 20px;
        background: #f8fafc;
        margin-top: 48px;
    }

    .steps-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .steps-header {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .steps-header i {
        font-size: 1.2rem;
    }

    .steps-header h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .steps-content {
        padding: 24px;
    }

    .step-item-simple {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.3s ease;
    }

    .step-item-simple:last-child {
        border-bottom: none;
    }

    .step-item-simple:hover {
        padding-right: 8px;
        background: rgba(99, 102, 241, 0.02);
        border-radius: 8px;
    }

    .step-number {
        min-width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .step-text {
        color: #374151;
        font-size: 1.05rem;
        line-height: 1.6;
        font-weight: 500;
    }

    .video-link {
        color: #6366f1 !important;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .video-link:hover {
        color: #4f46e5 !important;
        transform: translateX(4px);
    }

    .video-link i {
        font-size: 1.1rem;
    }

    @media (max-width: 768px) {
        .dashboard-header {
            padding: 40px 24px;
        }

        .dashboard-header h1 {
            font-size: 1.8rem;
        }

        .stat-value {
            font-size: 2rem;
        }

        .stat-card, .feature-box {
            padding: 32px 24px;
        }

        .bottom-steps-section {
            padding: 40px 20px;
        }

        .steps-header {
            padding: 16px 20px;
        }

        .steps-header h3 {
            font-size: 1.1rem;
        }

        .steps-content {
            padding: 20px;
        }

        .step-item-simple {
            padding: 12px 0;
        }

        .step-number {
            min-width: 32px;
            height: 32px;
            font-size: 0.9rem;
        }

        .step-text {
            font-size: 0.95rem;
        }
    }
</style>

<!-- Dashboard Header -->
<div class="dashboard-header">
    <div class="text-center">
        <h1 class="mb-3">
            <i class="fas fa-wave-square me-3"></i>مرحباً بك في نظام وصيّ 
        </h1>
        
        <p class="mb-0">
            @auth
                إدارة طلبات الوصاية الخاصة بك بكل سهولة واحترافية
            @else
                نظام متكامل لإدارة طلبات الوصاية الإلكترونية
            @endauth
        </p>
        
        <!-- Quick Start Guide -->
    
    </div>
</div>

<!-- Statistics Section (Logged In Users) -->
@auth
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(99, 102, 241, 0.08)); color: #6366f1;">
            <i class="fas fa-file-contract"></i>
        </div>
        <div class="stat-value">{{ auth()->user()->parcels()->count() }}</div>
        <div class="stat-label">إجمالي الطلبات</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08)); color: #f59e0b;">
            <i class="fas fa-spinner"></i>
        </div>
        <div class="stat-value">{{ auth()->user()->parcels()->where('status', '!=', 'delivered')->count() }}</div>
        <div class="stat-label">الطلبات النشطة</div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.08)); color: #10b981;">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-value">{{ auth()->user()->parcels()->where('status', 'delivered')->count() }}</div>
        <div class="stat-label">المكتملة</div>
    </div>
</div>
@endauth

<!-- Features Section -->
<div class="features-grid">
    <div class="feature-box">
        <div class="feature-icon-box" style="background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(99, 102, 241, 0.08)); color: #6366f1;">
            <i class="fas fa-file-signature"></i>
        </div>
        <h3 class="feature-title">تقديم الطلبات</h3>
        <p class="feature-desc">قدم طلبات الوصاية بكل سهولة عبر نموذج احترافي وآمن</p>
    </div>

    <div class="feature-box">
        <div class="feature-icon-box" style="background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.08)); color: #10b981;">
            <i class="fas fa-tasks"></i>
        </div>
        <h3 class="feature-title">متابعة الحالة</h3>
        <p class="feature-desc">تابع حالة طلباتك في الوقت الفعلي مع إشعارات فورية</p>
    </div>

    <div class="feature-box">
        <div class="feature-icon-box" style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08)); color: #f59e0b;">
            <i class="fas fa-shield-halved"></i>
        </div>
        <h3 class="feature-title">أمان عالي</h3>
        <p class="feature-desc">بيانات محمية بأعلى معايير الأمان والتشفير الحديثة</p>
    </div>
</div>

<!-- Steps Section at Bottom -->
<div class="bottom-steps-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="steps-card">
                    <div class="steps-header">
                        <i class="fas fa-list-ol"></i>
                        <h3>خطوات البدء السريع</h3>
                    </div>
                    <div class="steps-content">
                        <div class="step-item-simple">
                            <div class="step-number">1</div>
                            <div class="step-text">تسجيل الدخول إلى حسابك في النظام</div>
                        </div>
                        <div class="step-item-simple">
                            <div class="step-number">2</div>
                            <div class="step-text">إضافة بيانات الوصي وبيانات الوصاية </div>
                        </div>
                        <div class="step-item-simple">
                            <div class="step-number">3</div>
                            <div class="step-text">متابعة حالة الطلب حتى إصدار القرار النهائي</div>
                        </div>
                        <div class="step-item-simple">
                            <div class="step-number">4</div>
                            <div class="step-text">
                                <a href="https://www.youtube.com/watch?v=68x1rkcNH6I" target="_blank" class="video-link">
                                    <i class="fas fa-play-circle me-2"></i>
                                    فيديو تعليمي لمساعدتك في تقديم طلب الوصاية الخاص بك
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Guest Call to Action -->

@endsection
