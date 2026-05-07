@extends('admin.layout')

@section('title', 'تفاصيل طلب الوصاية')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h4 mb-0">تفاصيل طلب الوصاية</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.parcels.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-right"></i> رجوع
                </a>
                <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف طلب الوصاية؟')">
                        <i class="fas fa-trash"></i> حذف
                    </button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mb-3">
            <div class="card-body">
                @php
                    $isDelivered = $parcel->status === \App\Models\Parcel::STATUS_DELIVERED;
                @endphp

                <div class="d-flex flex-wrap gap-2 mb-3">
                    <span class="badge bg-dark">{{ $parcel->serial_number }}</span>
                    @if($isDelivered)
                        <span class="badge bg-success">تم التسليم</span>
                    @else
                        <span class="badge bg-warning text-dark">قيد الانتظار</span>
                    @endif
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <div class="fw-bold mb-2">معلومات الطلب</div>
                            <div class="small text-muted">رقم الطرد</div>
                            <div class="mb-2">{{ $parcel->parcel_number }}</div>

                            <div class="small text-muted">اسم المؤسسة</div>
                            <div class="mb-2">{{ optional($parcel->organization)->name ?? '-' }}</div>

                            <div class="small text-muted">المستخدم</div>
                            <div class="mb-2">{{ optional($parcel->user)->name ?? '-' }}</div>

                            <div class="small text-muted">تاريخ الإنشاء</div>
                            <div class="mb-2">{{ optional($parcel->created_at)->format('Y-m-d H:i') }}</div>

                            <div class="small text-muted">تاريخ التسليم</div>
                            <div class="mb-0">{{ $parcel->delivered_at ? $parcel->delivered_at->format('Y-m-d H:i') : '-' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <div class="fw-bold mb-2">معلومات الوصي</div>
                            <div class="small text-muted">اسم الوصي</div>
                            <div class="mb-2">{{ $parcel->agent_name ?? '-' }}</div>

                            <div class="small text-muted">جوال الوصي</div>
                            <div class="mb-2">{{ $parcel->agent_phone ?? '-' }}</div>

                            <div class="small text-muted">هوية الوصي</div>
                            <div class="mb-0">{{ $parcel->agent_id_number ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <div class="fw-bold mb-2">معلومات المرسل</div>
                            <div class="small text-muted">الاسم</div>
                            <div class="mb-2">{{ $parcel->sender_name ?? '-' }}</div>

                            <div class="small text-muted">الجوال</div>
                            <div class="mb-2">{{ $parcel->sender_phone ?? '-' }}</div>

                            <div class="small text-muted">رقم الهوية</div>
                            <div class="mb-2">{{ $parcel->sender_id_number ?? '-' }}</div>

                            <div class="small text-muted">العنوان</div>
                            <div class="mb-0">{{ $parcel->sender_address ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="border rounded p-3 h-100">
                            <div class="fw-bold mb-2">معلومات المستلم</div>

                            <div class="small text-muted">الاسم</div>
                            <div class="mb-2">{{ $parcel->receiver_name ?? '-' }}</div>

                            <div class="small text-muted">الجوال</div>
                            <div class="mb-2">{{ $parcel->receiver_phone ?? '-' }}</div>

                            <div class="small text-muted">رقم الهوية</div>
                            <div class="mb-2">{{ $parcel->receiver_id_number ?? '-' }}</div>

                            <div class="small text-muted">العنوان</div>
                            <div class="mb-0">{{ $parcel->receiver_address ?? '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(!$isDelivered)
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">تأكيد التسليم</div>
                <div class="card-body">
                    <form action="{{ route('admin.parcels.deliver', $parcel->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row g-2">
                            <div class="col-md-3">
                                <input type="text" name="receiver_name" class="form-control form-control-sm @error('receiver_name') is-invalid @enderror" placeholder="اسم المستلم" value="{{ old('receiver_name', $parcel->receiver_name) }}" required>
                                @error('receiver_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="receiver_phone" class="form-control form-control-sm @error('receiver_phone') is-invalid @enderror" placeholder="جوال المستلم" value="{{ old('receiver_phone', $parcel->receiver_phone) }}" required>
                                @error('receiver_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="receiver_id_number" class="form-control form-control-sm @error('receiver_id_number') is-invalid @enderror" placeholder="هوية المستلم" value="{{ old('receiver_id_number', $parcel->receiver_id_number) }}" required>
                                @error('receiver_id_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="receiver_address" class="form-control form-control-sm @error('receiver_address') is-invalid @enderror" placeholder="عنوان المستلم" value="{{ old('receiver_address', $parcel->receiver_address) }}" required>
                                @error('receiver_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i>
                                تأكيد التسليم
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
