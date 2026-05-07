@extends('admin.layout')

@section('title', 'إدارة المؤسسات')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">إدارة المؤسسات</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-right"></i> العودة للرئيسية
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-2">
                        <div>إجمالي المؤسسات</div>
                        <div class="fw-bold fs-5">{{ $stats['total'] ?? 0 }}</div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div>المؤسسات المفعلة</div>
                        <div class="fw-bold fs-5 text-success">{{ $stats['approved'] ?? 0 }}</div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div>في انتظار الموافقة</div>
                        <div class="fw-bold fs-5 text-warning">{{ $stats['pending'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <div class="fw-bold">قائمة المؤسسات</div>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.organizations.index', ['status' => 'all']) }}" class="btn btn-sm btn-outline-secondary {{ ($status ?? 'all') === 'all' ? 'active' : '' }}">الكل</a>
                    <a href="{{ route('admin.organizations.index', ['status' => 'approved']) }}" class="btn btn-sm btn-outline-success {{ ($status ?? '') === 'approved' ? 'active' : '' }}">مفعلة</a>
                    <a href="{{ route('admin.organizations.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning {{ ($status ?? '') === 'pending' ? 'active' : '' }}">معلقة</a>
                </div>
            </div>
            <div class="card-body">
                @if($organizations->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>اسم المؤسسة</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>رقم الهاتف</th>
                                    <th>العنوان</th>
                                    <th>الحالة</th>
                                    <th>تاريخ التسجيل</th>
                                    <th style="width:220px">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($organizations as $index => $org)
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
                                        <td>{{ $org->name }}</td>
                                        <td>{{ $org->email }}</td>
                                        <td>{{ $org->phone ?? '-' }}</td>
                                        <td>{{ $org->address ?? '-' }}</td>
                                        <td>
                                            @if($org->is_approved)
                                                <span class="badge bg-success">مفعلة</span>
                                            @else
                                                <span class="badge bg-warning text-dark">معلقة</span>
                                            @endif
                                        </td>
                                        <td>{{ optional($org->created_at)->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <form action="{{ route('admin.organizations.toggle-approval', $org->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm {{ $org->is_approved ? 'btn-outline-warning' : 'btn-outline-success' }}">
                                                        @if($org->is_approved)
                                                            <i class="fas fa-ban"></i> إلغاء التفعيل
                                                        @else
                                                            <i class="fas fa-check"></i> تفعيل
                                                        @endif
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.organizations.destroy', $org->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذه المؤسسة؟')">
                                                        <i class="fas fa-trash"></i> حذف
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">لا توجد مؤسسات مطابقة للفلتر الحالي.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
