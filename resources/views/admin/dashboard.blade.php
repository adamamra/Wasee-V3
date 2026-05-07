@extends('admin.layout')

@section('title', 'لوحة التحكم')

@section('content')
<style>
    .dashboard-card {
        background: white;
        border-radius: 16px;
        padding: 30px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border-left: 4px solid;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
    }

    .dashboard-card.primary {
        border-left-color: #0284c7;
    }

    .dashboard-card.success {
        border-left-color: #16a34a;
    }

    .dashboard-card.warning {
        border-left-color: #f59e0b;
    }

    .dashboard-card.danger {
        border-left-color: #ef4444;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 10px 0;
    }

    .dashboard-card.primary .stat-value {
        color: #0284c7;
    }

    .dashboard-card.success .stat-value {
        color: #16a34a;
    }

    .dashboard-card.warning .stat-value {
        color: #f59e0b;
    }

    .dashboard-card.danger .stat-value {
        color: #ef4444;
    }

    .stat-label {
        color: #6b7280;
        font-weight: 500;
    }

    .icon-box {
        float: left;
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-left: 20px;
    }

    .dashboard-card.primary .icon-box {
        background: rgba(2, 132, 199, 0.1);
        color: #0284c7;
    }

    .dashboard-card.success .icon-box {
        background: rgba(22, 163, 74, 0.1);
        color: #16a34a;
    }

    .dashboard-card.warning .icon-box {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .dashboard-card.danger .icon-box {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 30px 0 20px;
        color: #1f2937;
        padding-bottom: 12px;
        border-bottom: 3px solid #0284c7;
        display: inline-block;
    }

    .table-modern {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .table-modern thead {
        background: linear-gradient(135deg, #0284c7, #0369a1);
        color: white;
    }

    .table-modern thead th {
        border: none;
        font-weight: 600;
        padding: 16px;
    }

    .table-modern tbody tr {
        border-bottom: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .table-modern tbody tr:hover {
        background: #f9fafb;
    }

    .table-modern tbody td {
        padding: 16px;
        color: #6b7280;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.1);
        color: #b45309;
    }

    .status-approved {
        background: rgba(22, 163, 74, 0.1);
        color: #15803d;
    }

    .btn-action {
        padding: 6px 12px;
        font-size: 0.85rem;
        border-radius: 8px;
        margin: 2px;
        transition: all 0.3s ease;
    }

    .btn-action:hover {
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .dashboard-card {
            padding: 20px;
        }

        .icon-box {
            float: none;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 1.8rem;
        }
    }
</style>

<!-- Dashboard Header -->
<div class="mb-5">
    <h2 class="section-title">
        <i class="fas fa-chart-line me-3"></i>لوحة التحكم
    </h2>
    <p class="text-muted mt-3">مرحباً بك في لوحة تحكم النظام</p>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="dashboard-card primary">
            <div class="icon-box">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-label">إجمالي المستخدمين</div>
            <div class="stat-value">{{ \App\Models\User::count() }}</div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="dashboard-card success">
            <div class="icon-box">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-label">المستخدمون المفعلون</div>
            <div class="stat-value">{{ \App\Models\User::where('is_approved', true)->count() }}</div>
        </div>
    </div>
    
    <div class="col-md-4 mb-4">
        <div class="dashboard-card warning">
            <div class="icon-box">
                <i class="fas fa-user-clock"></i>
            </div>
            <div class="stat-label">في انتظار الموافقة</div>
            <div class="stat-value">{{ \App\Models\User::where('is_approved', false)->count() }}</div>
        </div>
    </div>
</div>

<!-- Recent Registrations -->
<div class="mt-4">
    <h3 class="section-title">
        <i class="fas fa-users-cog me-2"></i>أحدث طلبات التسجيل
    </h3>
    
    @php
        $pendingUsers = \App\Models\User::where('is_approved', false)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
    @endphp
    
    @if($pendingUsers->count() > 0)
        <div class="card-modern mt-4">
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user me-2"></i>الاسم</th>
                            <th><i class="fas fa-id-card me-2"></i>رقم الهوية</th>
                            <th><i class="fas fa-envelope me-2"></i>البريد الإلكتروني</th>
                            <th><i class="fas fa-calendar me-2"></i>تاريخ الطلب</th>
                            <th><i class="fas fa-cogs me-2"></i>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingUsers as $user)
                            <tr>
                                <td class="fw-bold">{{ $user->name }}</td>
                                <td>{{ $user->id_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="status-badge status-pending">{{ $user->created_at->diffForHumans() }}</span></td>
                                <td>
                                    <a href="{{ route('admin.users.approve', $user->id) }}" 
                                       class="btn btn-sm btn-success btn-action" 
                                       onclick="return confirm('هل أنت متأكد من الموافقة على هذا المستخدم؟')">
                                        <i class="fas fa-check me-1"></i> موافقة
                                    </a>
                                    <a href="{{ route('admin.users.destroy', $user->id) }}" 
                                       class="btn btn-sm btn-danger btn-action" 
                                       onclick="event.preventDefault(); if(confirm('هل أنت متأكد من رفض هذا الطلب؟')) { document.getElementById('delete-form-{{ $user->id }}').submit(); }">
                                        <i class="fas fa-times me-1"></i> رفض
                                    </a>
                                    <form id="delete-form-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="text-end mt-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-modern">
                <i class="fas fa-list me-2"></i> عرض جميع المستخدمين
            </a>
        </div>
    @else
        <div class="card-modern mt-4">
            <div class="card-body text-center py-5">
                <div style="font-size: 48px; color: #d1d5db; margin-bottom: 15px;">
                    <i class="fas fa-inbox"></i>
                </div>
                <h5 class="fw-bold text-muted">لا توجد طلبات تسجيل جديدة</h5>
                <p class="text-muted">جميع المستخدمين تمت الموافقة عليهم</p>
            </div>
        </div>
    @endif
</div>

@endsection
