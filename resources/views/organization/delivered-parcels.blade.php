@extends('layouts.organization')

@section('title', 'الطرود المسلمة')

@section('content')
<style>
    .delivered-header {
        background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%);
        color: white;
        padding: 40px;
        border-radius: 20px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .delivered-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .delivered-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
    }

    .delivered-title {
        font-size: 2rem;
        font-weight: 800;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .delivered-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
        font-weight: 500;
    }

    .delivered-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .table-container {
        padding: 32px;
    }

    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .modern-table thead {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    }

    .modern-table th {
        padding: 16px;
        text-align: right;
        font-weight: 700;
        color: #374151;
        font-size: 0.95rem;
        border-bottom: 2px solid #e5e7eb;
        position: relative;
    }

    .modern-table th:first-child {
        border-top-right-radius: 12px;
    }

    .modern-table th:last-child {
        border-top-left-radius: 12px;
    }

    .modern-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid #f1f5f9;
    }

    .modern-table tbody tr:hover {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.05), rgba(16, 185, 129, 0.02));
        transform: translateX(4px);
    }

    .modern-table td {
        padding: 16px;
        color: #1e293b;
        font-weight: 500;
        vertical-align: middle;
    }

    .serial-number {
        font-family: 'Courier New', monospace;
        background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
        color: #0369a1;
        display: inline-block;
    }

    .agent-name {
        font-weight: 600;
        color: #1e293b;
    }

    .id-number {
        font-family: 'Courier New', monospace;
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
        color: #92400e;
        display: inline-block;
    }

    .delivery-date {
        background: linear-gradient(135deg, #d1fae5, #a7f3d0);
        color: #065f46;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .parcel-number {
        background: linear-gradient(135deg, #ddd6fe, #c4b5fd);
        color: #5b21b6;
        padding: 4px 8px;
        border-radius: 6px;
        font-weight: 600;
        display: inline-block;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    .empty-icon {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 16px;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
    }

    .empty-text {
        font-size: 1rem;
        color: #64748b;
    }

    .back-btn {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
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
        background: rgba(255, 255, 255, 0.3);
        color: white;
        transform: translateY(-2px);
    }

    .pagination-container {
        padding: 24px 32px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .pagination a,
    .pagination span {
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .pagination a {
        background: white;
        color: #6366f1;
        border: 1px solid #e5e7eb;
    }

    .pagination a:hover {
        background: #6366f1;
        color: white;
        transform: translateY(-2px);
    }

    .pagination span.current {
        background: linear-gradient(135deg, #6366f1, #4f46e5);
        color: white;
    }

    @media (max-width: 768px) {
        .delivered-header {
            padding: 24px;
        }

        .delivered-title {
            font-size: 1.5rem;
        }

        .table-container {
            padding: 16px;
        }

        .modern-table {
            font-size: 0.9rem;
        }

        .modern-table th,
        .modern-table td {
            padding: 12px 8px;
        }

        .back-btn {
            padding: 8px 16px;
            font-size: 0.9rem;
        }
    }
</style>

<!-- Header -->
<div class="delivered-header">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="delivered-title">
                <i class="fas fa-box-check-circle"></i>
                الطرود المسلمة
            </h1>
            <p class="delivered-subtitle">عرض جميع الطرود التي تم تسليمها بنجاح</p>
        </div>
        <a href="{{ route('organization.dashboard') }}" class="back-btn">
            <i class="fas fa-arrow-right"></i>
            العودة للوحة التحكم
        </a>
    </div>
</div>

<!-- Table Card -->
<div class="delivered-card">
    <div class="table-container">
        @forelse($parcels as $parcel)
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الشحنة</th>
                        <th>رقم السيريال</th>
                        <th>اسم الوكيل</th>
                        <th>هوية الوكيل</th>
                        <th>تاريخ التسليم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parcels as $parcel)
                        <tr>
                            <td>
                                <span class="fw-bold text-primary">{{ $loop->parent->iteration + (($parcels->currentPage() - 1) * $parcels->perPage()) }}</span>
                            </td>
                            <td>
                                <span class="parcel-number">{{ $parcel->parcel_number }}</span>
                            </td>
                            <td>
                                <span class="serial-number">{{ $parcel->serial_number }}</span>
                            </td>
                            <td>
                                <span class="agent-name">{{ $parcel->agent_name }}</span>
                            </td>
                            <td>
                                <span class="id-number">{{ $parcel->agent_id_number }}</span>
                            </td>
                            <td>
                                <span class="delivery-date">
                                    <i class="fas fa-calendar-check"></i>
                                    {{ $parcel->delivered_at->format('Y-m-d H:i') }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3 class="empty-title">لا توجد طرود مسلمة</h3>
                <p class="empty-text">لم يتم تسليم أي طرود بعد. سيظهر هنا جميع الطرود المسلمة.</p>
            </div>
        @endforelse
    </div>

    @if($parcels->hasPages())
        <div class="pagination-container">
            {{ $parcels->links() }}
        </div>
    @endif
</div>
@endsection
