@extends('admin.layout')

@section('title', 'إدارة المستخدمين')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">إدارة المستخدمين</h1>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-right"></i> العودة للرئيسية
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('info'))
            <div class="alert alert-info">{{ session('info') }}</div>
        @endif

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-2">
                        <div>إجمالي المستخدمين</div>
                        <div class="fw-bold fs-5">{{ $stats['total'] ?? 0 }}</div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div>المستخدمون المفعلون</div>
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
                <div class="fw-bold">قائمة المستخدمين</div>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.users.index', ['status' => 'pending']) }}" class="btn btn-sm btn-outline-warning {{ ($status ?? 'pending') === 'pending' ? 'active' : '' }}">معلّقون</a>
                    <a href="{{ route('admin.users.index', ['status' => 'approved']) }}" class="btn btn-sm btn-outline-success {{ ($status ?? '') === 'approved' ? 'active' : '' }}">موافق عليهم</a>
                    <a href="{{ route('admin.users.index', ['status' => 'all']) }}" class="btn btn-sm btn-outline-secondary {{ ($status ?? '') === 'all' ? 'active' : '' }}">الكل</a>
                </div>
            </div>
            <div class="card-body">
                @if($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:50px">#</th>
                                    <th>الاسم</th>
                                    <th>رقم الهوية</th>
                                    <th>الجوال</th>
                                    <th>البريد الإلكتروني</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الطلب</th>
                                    <th style="width:220px">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->id_number }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->is_approved)
                                                <span class="badge bg-success">مفعل</span>
                                            @else
                                                <span class="badge bg-warning text-dark">معلّق</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                @if(!$user->is_approved)
                                                    <a href="{{ route('admin.users.approve', $user->id) }}" 
                                                       class="btn btn-sm btn-success" title="موافقة"
                                                       onclick="return confirm('هل أنت متأكد من الموافقة على هذا المستخدم؟')">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                @endif

                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="حذف"
                                                            onclick="return confirm('هل أنت متأكد من حذف هذا المستخدم؟')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                                <a href="mailto:{{ $user->email }}" class="btn btn-sm btn-outline-secondary" title="إرسال بريد">
                                                    <i class="fas fa-envelope"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info mb-0">لا توجد طلبات تسجيل جديدة في الوقت الحالي.</div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
