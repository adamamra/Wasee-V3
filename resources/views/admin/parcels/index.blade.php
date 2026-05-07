@extends('admin.layout')

@section('title', 'إدارة طلبات الوصاية')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">إدارة طلبات الوصاية</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-arrow-right"></i> العودة للرئيسية
            </a>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-2">
                        <div>إجمالي الطلبات</div>
                        <div class="fw-bold fs-5">{{ $stats['total'] ?? 0 }}</div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div>قيد الانتظار</div>
                        <div class="fw-bold fs-5 text-warning">{{ $stats['pending'] ?? 0 }}</div>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div>تم التسليم</div>
                        <div class="fw-bold fs-5 text-success">{{ $stats['delivered'] ?? 0 }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                    <div class="fw-bold">قائمة الطلبات</div>

                    <form method="GET" action="{{ route('admin.parcels.index') }}" class="d-flex gap-2">
                        <input type="hidden" name="status" value="{{ $status ?? 'all' }}">
                        <input type="text" name="q" value="{{ $search ?? '' }}" class="form-control form-control-sm" placeholder="بحث (سيريال/رقم طرد/اسم الوصي/المرسل...)" style="min-width: 260px;">
                        <button class="btn btn-sm btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(($search ?? '') !== '')
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.parcels.index', ['status' => $status ?? 'all']) }}">
                                مسح
                            </a>
                        @endif
                    </form>

                    <div class="btn-group" role="group">
                        <a href="{{ route('admin.parcels.index', ['status' => 'all', 'q' => $search ?? null]) }}" class="btn btn-sm btn-outline-secondary {{ ($status ?? 'all') === 'all' ? 'active' : '' }}">الكل</a>
                        <a href="{{ route('admin.parcels.index', ['status' => 'pending', 'q' => $search ?? null]) }}" class="btn btn-sm btn-outline-warning {{ ($status ?? '') === 'pending' ? 'active' : '' }}">قيد الانتظار</a>
                        <a href="{{ route('admin.parcels.index', ['status' => 'delivered', 'q' => $search ?? null]) }}" class="btn btn-sm btn-outline-success {{ ($status ?? '') === 'delivered' ? 'active' : '' }}">تم التسليم</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(($parcels ?? collect())->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px">#</th>
                                    <th>السيريال</th>
                                    <th>رقم الطرد</th>
                                    <th>المؤسسة</th>
                                    <th>المستخدم</th>
                                    <th>الوصي</th>
                                    <th>الحالة</th>
                                    <th>تاريخ الإنشاء</th>
                                    <th style="width:220px">الإجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($parcels as $index => $parcel)
                                    @php
                                        $isDelivered = $parcel->status === \App\Models\Parcel::STATUS_DELIVERED;
                                    @endphp
                                    <tr>
                                        <td class="text-muted">{{ $index + 1 }}</td>
                                        <td><span class="fw-bold">{{ $parcel->serial_number }}</span></td>
                                        <td>{{ $parcel->parcel_number }}</td>
                                        <td>{{ optional($parcel->organization)->name ?? '-' }}</td>
                                        <td>{{ optional($parcel->user)->name ?? '-' }}</td>
                                        <td>{{ $parcel->agent_name ?? '-' }}</td>
                                        <td>
                                            @if($isDelivered)
                                                <span class="badge bg-success">تم التسليم</span>
                                            @else
                                                <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                            @endif
                                        </td>
                                        <td>{{ optional($parcel->created_at)->format('Y-m-d') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.parcels.show', $parcel->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i> عرض
                                                </a>

                                                <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" class="m-0">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف طلب الوصاية؟')">
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
                    <div class="alert alert-info mb-0">لا توجد طلبات وصاية مطابقة للفلتر الحالي.</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
