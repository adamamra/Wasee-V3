<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="وصيّ - نظام متطور وآمن لإدارة طلبات الوصاية الإلكترونية">
    <title>وصيّ - نظام إدارة الوصاية الذكي</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons & Styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #10b981;
            --accent: #f59e0b;
            --dark: #1e293b;
            --light: #f8fafc;
        }

        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Tajawal', 'Inter', sans-serif;
            overflow-x: hidden;
            background: var(--light);
        }

        /* Navigation */
        .navbar-modern {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 0 !important;
            transition: all 0.3s ease;
        }

        .navbar-modern.scrolled {
            background: rgba(255, 255, 255, 1) !important;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
        }

        .navbar-brand {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark)) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            font-size: 32px !important;
            font-weight: 900 !important;
            letter-spacing: -0.5px;
        }

        .navbar-brand i {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-link {
            font-weight: 600 !important;
            color: #475569 !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            right: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 25%, #7c3aed 50%, #4f46e5 75%, #6366f1 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -20%;
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 12s ease-in-out infinite;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        .hero-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            animation: particle-float 15s linear infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0) translateX(0) rotate(0deg); }
            25% { transform: translateY(-20px) translateX(15px) rotate(90deg); }
            50% { transform: translateY(40px) translateX(-10px) rotate(180deg); }
            75% { transform: translateY(-15px) translateX(-20px) rotate(270deg); }
        }

        @keyframes particle-float {
            0% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            max-width: 900px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .hero-title {
            font-size: clamp(2.5rem, 6vw, 5rem);
            font-weight: 900;
            color: white;
            margin-bottom: 24px;
            line-height: 1.1;
            animation: slideUp 1s ease;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .hero-title span {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: clamp(1.1rem, 3vw, 1.8rem);
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 48px;
            line-height: 1.6;
            animation: slideUp 1s ease 0.2s both;
            font-weight: 500;
        }

        .hero-buttons {
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
            animation: slideUp 1s ease 0.4s both;
        }

        .btn-hero {
            padding: 18px 48px;
            font-size: 18px;
            font-weight: 700;
            border-radius: 16px;
            transition: all 0.4s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .btn-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-hero:hover::before {
            left: 100%;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, white, #f8fafc);
            color: var(--primary);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
        }

        .btn-hero-primary:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 48px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #f8fafc, white);
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            border: 3px solid white;
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.2);
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 16px 32px rgba(255, 255, 255, 0.3);
        }

        /* Features Section */
        .features-section {
            padding: 120px 20px;
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 50%, #f1f5f9 100%);
            position: relative;
        }

        .features-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .section-header {
            text-align: center;
            margin-bottom: 80px;
        }

        .section-header h2 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            margin-bottom: 20px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1.2;
        }

        .section-header p {
            font-size: 1.3rem;
            color: #64748b;
            max-width: 700px;
            margin: 0 auto;
            font-weight: 500;
        }

        .feature-card {
            background: white;
            border-radius: 24px;
            padding: 48px 32px;
            height: 100%;
            border: 1px solid rgba(0, 0, 0, 0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-16px);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.15);
        }

        .feature-icon {
            width: 96px;
            height: 96px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 42px;
            margin-bottom: 32px;
            transition: all 0.4s ease;
            position: relative;
        }

        .feature-icon::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            border-radius: 20px;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .feature-card:hover .feature-icon::after {
            opacity: 1;
        }

        .feature-card:nth-child(1) .feature-icon {
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(99, 102, 241, 0.08));
            color: var(--primary);
        }

        .feature-card:nth-child(2) .feature-icon {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.08));
            color: var(--secondary);
        }

        .feature-card:nth-child(3) .feature-icon {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08));
            color: var(--accent);
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.15) rotate(8deg);
        }

        .feature-card h5 {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 16px;
            color: #1e293b;
        }

        .feature-card p {
            color: #64748b;
            line-height: 1.8;
            margin: 0;
            font-size: 1.05rem;
        }

        /* Stats Section */
        .stats-section {
            padding: 120px 20px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 25%, #7c3aed 50%, #4f46e5 100%);
            color: white;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -200px;
            animation: float 15s ease-in-out infinite;
        }

        .stats-section::after {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -150px;
            left: -150px;
            animation: float 12s ease-in-out infinite reverse;
        }

        .stat-item {
            text-align: center;
            position: relative;
            z-index: 10;
            padding: 32px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-item:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-8px);
        }

        .stat-number {
            font-size: 3.5rem;
            font-weight: 900;
            margin-bottom: 12px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 1.2rem;
            opacity: 0.95;
            font-weight: 600;
        }

        /* CTA Section */
        .cta-section {
            padding: 120px 20px;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 25%, #7c3aed 50%, #4f46e5 100%);
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .cta-section::before {
            content: '';
            position: absolute;
            width: 700px;
            height: 700px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -300px;
            left: -200px;
            animation: float 18s ease-in-out infinite;
        }

        .cta-section h2 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 900;
            margin-bottom: 24px;
            position: relative;
            z-index: 10;
            line-height: 1.2;
        }

        .cta-section p {
            font-size: 1.4rem;
            margin-bottom: 48px;
            opacity: 0.95;
            position: relative;
            z-index: 10;
            font-weight: 500;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .cta-buttons {
            display: flex;
            gap: 24px;
            justify-content: center;
            position: relative;
            z-index: 10;
            flex-wrap: wrap;
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 80px 20px 40px;
        }

        footer h6 {
            color: var(--primary);
            font-weight: 800;
            position: relative;
            padding-bottom: 16px;
            margin-bottom: 24px;
            font-size: 1.2rem;
        }

        footer h6::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 40px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            border-radius: 2px;
        }

        footer a {
            color: #64748b;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        footer a:hover {
            color: var(--primary);
            transform: translateX(8px);
        }

        footer ul {
            list-style: none;
            padding: 0;
        }

        footer ul li {
            margin-bottom: 16px;
        }

        .footer-brand {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* How It Works Section */
        .how-it-works-section {
            padding: 120px 20px;
            background: linear-gradient(135deg, #f8fafc 0%, #ffffff 50%, #f1f5f9 100%);
            position: relative;
        }

        .how-it-works-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary), transparent);
        }

        .step-card {
            background: white;
            border-radius: 20px;
            padding: 40px 24px;
            text-align: center;
            position: relative;
            transition: all 0.4s ease;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .step-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .step-card:hover::before {
            transform: scaleX(1);
        }

        .step-card:hover {
            transform: translateY(-16px);
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.15);
        }

        .step-number {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            z-index: 10;
        }

        .step-icon {
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
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(99, 102, 241, 0.08));
            color: var(--primary);
        }

        .step-icon::after {
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

        .step-card:hover .step-icon::after {
            opacity: 1;
        }

        .step-card:hover .step-icon {
            transform: scale(1.15) rotate(8deg);
        }

        .step-card h5 {
            font-size: 1.4rem;
            font-weight: 800;
            margin-bottom: 16px;
            color: #1e293b;
        }

        .step-card p {
            color: #64748b;
            line-height: 1.7;
            margin: 0;
            font-size: 1.05rem;
        }

        .step-card:nth-child(2) .step-icon {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.15), rgba(16, 185, 129, 0.08));
            color: var(--secondary);
        }

        .step-card:nth-child(3) .step-icon {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.15), rgba(245, 158, 11, 0.08));
            color: var(--accent);
        }

        .step-card:nth-child(4) .step-icon {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.15), rgba(239, 68, 68, 0.08));
            color: #ef4444;
        }

        @media (max-width: 768px) {
            .hero-section {
                padding-top: 80px;
            }

            .features-section,
            .stats-section,
            .cta-section,
            .how-it-works-section {
                padding: 80px 20px;
            }

            .feature-card {
                padding: 32px 24px;
            }

            .step-card {
                padding: 32px 20px;
            }

            .stat-number {
                font-size: 2.5rem;
            }

            .hero-buttons {
                gap: 16px;
            }

            .btn-hero {
                padding: 16px 32px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-modern sticky-top" style="z-index: 1030;">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="fas fa-shield-alt me-2"></i>وصيّ
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link" href="#features">المميزات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#stats">الإحصائيات</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">طريقة الاستخدام</a></li>
                    @auth
                        <li class="nav-item ms-2">
                            <a class="btn-hero btn-hero-primary" href="{{ route('home') }}" style="padding: 8px 18px; margin: 0;">
                                <i class="fas fa-dashboard me-1"></i> لوحة التحكم
                            </a>
                        </li>
                    @else
                        <li class="nav-item ms-2">
                            <a class="btn-hero btn-hero-primary" href="{{ route('login') }}" style="padding: 8px 18px; margin: 0;">
                                <i class="fas fa-sign-in-alt me-1"></i> تسجيل الدخول
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-particles" id="particles"></div>
        <div class="hero-content">
            <h1 class="hero-title">
                <span>وصيّ</span>
                <span style="font-size: 0.6em; opacity: 0.95; display: block; margin-top: 16px;">نظام إدارة الوصاية الذكي</span>
            </h1>
            <p class="hero-subtitle">منصة متكاملة وآمنة لإدارة طلبات الوصاية الإلكترونية بكل سهولة واحترافية</p>
            <div class="hero-buttons">
                @auth
                    <a href="{{ route('home') }}" class="btn-hero btn-hero-primary">
                        <i class="fas fa-tachometer-alt me-2"></i> الانتقال للوحة التحكم
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-hero btn-hero-primary">
                        <i class="fas fa-rocket me-2"></i> ابدأ الآن
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero btn-hero-secondary">
                        <i class="fas fa-sign-in-alt me-2"></i> تسجيل الدخول
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section" id="features">
        <div class="container">
            <div class="section-header">
                <h2>المميزات الرئيسية</h2>
                <p>تم تطوير النظام بأحدث التقنيات ليوفر لك أفضل تجربة</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-contract"></i>
                        </div>
                        <h5>إدارة الطلبات</h5>
                        <p>قدم وتابع طلبات الوصاية بكل سهولة مع نظام متقدم للتتبع والتنبيهات الفورية</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <h5>أمان عالي</h5>
                        <p>بيانات محمية بأعلى معايير الأمان والتشفير مع ضمانات قانونية قوية</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-bolt"></i>
                        </div>
                        <h5>سرعة وكفاءة</h5>
                        <p>معالجة سريعة للطلبات مع واجهة سهلة الاستخدام وتصميم متجاوب</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="stats-section" id="stats">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ \App\Models\Parcel::count() }}+</div>
                        <div class="stat-label">طلب معالج</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number">{{ \App\Models\User::count() }}+</div>
                        <div class="stat-label">مستخدم فعال</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number">99.9%</div>
                        <div class="stat-label">نسبة الأمان</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">دعم فني</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-section">
        <div class="container">
            <h2>ابدأ الآن</h2>
            <p>انضم إلى آلاف المستخدمين الذين يثقون بنا لإدارة وصاياهم</p>
            <div class="cta-buttons">
                @auth
                    <a href="{{ route('home') }}" class="btn-hero btn-hero-primary">
                        لوحة التحكم
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-hero btn-hero-primary">
                        إنشاء حساب مجاني
                    </a>
                    <a href="{{ route('login') }}" class="btn-hero btn-hero-secondary">
                        تسجيل الدخول
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="how-it-works-section" id="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>خطوات استخدام الموقع</h2>
                <p>اتبع هذه الخطوات البسيطة للاستفادة من خدماتنا</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <div class="step-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h5>إنشاء حساب</h5>
                        <p>سجل في الموقع مجاناً وأنشئ حسابك الشخصي للبدء في استخدام الخدمات</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <div class="step-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h5>تقديم الطلب</h5>
                        <p>املأ نموذج طلب الوصاية بكل المعلومات المطلوبة بدقة وموثوقية</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <div class="step-icon">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h5>متابعة الحالة</h5>
                        <p>تابع حالة طلبك في الوقت الفعلي واستلم إشعارات حول التقدم</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <div class="step-icon">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <h5>استلام النتيجة</h5>
                        <p>احصل على نتيجة طلبك إلكترونياً مع جميع المستندات المطلوبة</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Create particles
        function createParticles() {
            const particlesContainer = document.getElementById('particles');
            if (!particlesContainer) return;
            
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (15 + Math.random() * 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Navbar scroll effect
        function handleNavbarScroll() {
            const navbar = document.querySelector('.navbar-modern');
            if (!navbar) return;
            
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href !== '#' && document.querySelector(href)) {
                    e.preventDefault();
                    document.querySelector(href).scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'slideUp 0.6s ease forwards';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            createParticles();
            
            document.querySelectorAll('.feature-card').forEach(el => {
                observer.observe(el);
            });
            
            document.querySelectorAll('.stat-item').forEach(el => {
                el.style.animation = 'fadeInScale 0.8s ease forwards';
                observer.observe(el);
            });
            
            document.querySelectorAll('.step-card').forEach(el => {
                observer.observe(el);
            });
        });

        window.addEventListener('scroll', handleNavbarScroll);
    </script>
</body>
</html>
