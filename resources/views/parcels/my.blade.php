@extends('layouts.app')

@section('title', 'طلبات الوصاية الخاصة بي')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-start justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">طلبات الوصاية الخاصة بي</h1>
            <p class="text-sm text-gray-500 mt-1">تتبع طلباتك وحالتها وتواريخها من هنا</p>
        </div>
        <a href="{{ route('parcels.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i>
            <span>طلب جديد</span>
        </a>
    </div>

    @if(($expiringSoonCount ?? 0) > 0)
        <div class="mb-4 rounded-xl border border-amber-200 bg-amber-50 p-4 text-amber-900">
            <div class="flex items-start gap-3">
                <i class="fas fa-clock mt-0.5 text-amber-600"></i>
                <div>
                    <p class="font-semibold">تنبيه</p>
                    <p class="text-sm">لديك {{ $expiringSoonCount }} طلب(ات) وصاية ستنتهي مدة حفظها خلال يومين.</p>
                </div>
            </div>
        </div>
    @endif

    @if(($expiredCount ?? 0) > 0)
        <div class="mb-4 rounded-xl border border-red-200 bg-red-50 p-4 text-red-900">
            <div class="flex items-start gap-3">
                <i class="fas fa-exclamation-circle mt-0.5 text-red-600"></i>
                <div>
                    <p class="font-semibold">هام</p>
                    <p class="text-sm">يوجد {{ $expiredCount }} طلب(ات) انتهت مدة الوصاية لها ولم تُسلّم بعد.</p>
                </div>
            </div>
        </div>
    @endif

    @if($parcels->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($parcels as $parcel)
                @php
                    $statusData = [
                        'pending' => ['label' => 'قيد الانتظار', 'bg' => '#fef3c7', 'color' => '#b45309'],
                        'in_progress' => ['label' => 'قيد الانتظار', 'bg' => '#fef3c7', 'color' => '#b45309'],
                        'delivered' => ['label' => 'تم التسليم', 'bg' => '#ecfdf5', 'color' => '#15803d'],
                    ];
                    $status = $statusData[$parcel->status] ?? $statusData['pending'];
                @endphp

                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                    <div class="p-5 flex-1">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs text-gray-500">رقم الطرد</p>
                                <p class="text-lg font-bold text-gray-900 mt-1">{{ $parcel->parcel_number }}</p>
                            </div>
                            <span class="text-xs font-semibold rounded-full px-3 py-1" style="background: {{ $status['bg'] }}; color: {{ $status['color'] }};">
                                {{ $status['label'] }}
                            </span>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-100 space-y-2 text-sm">
                            <div class="flex items-center gap-2 text-gray-700">
                                <i class="fas fa-user text-primary"></i>
                                <span class="font-semibold">{{ $parcel->agent_name }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-phone text-primary"></i>
                                <span>{{ $parcel->agent_phone }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <i class="fas fa-id-card text-primary"></i>
                                <span>{{ $parcel->agent_id_number }}</span>
                            </div>
                        </div>

                        <div class="mt-4 grid grid-cols-1 gap-3 text-sm">
                            <div class="rounded-xl bg-gray-50 p-3">
                                <p class="text-xs text-gray-500">تاريخ الإنشاء</p>
                                <p class="font-semibold text-gray-900 mt-1">{{ $parcel->created_at->format('d-m-Y H:i') }}</p>
                            </div>

                            @if($parcel->expires_at)
                                <div class="rounded-xl bg-gray-50 p-3">
                                    <p class="text-xs text-gray-500">انتهاء الوصاية</p>
                                    <p class="font-semibold text-gray-900 mt-1">
                                        {{ $parcel->expires_at->format('d-m-Y H:i') }}
                                        @if(now()->greaterThan($parcel->expires_at) && $parcel->status !== 'delivered')
                                            <span class="inline-flex items-center rounded-full bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 mr-2">منتهية</span>
                                        @endif
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="p-4 border-t border-gray-100">
                        <a href="{{ route('parcels.show', $parcel->serial_number) }}" class="w-full btn btn-outline">
                            <i class="fas fa-eye"></i>
                            <span>عرض التفاصيل</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $parcels->links() }}
        </div>
    @else
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10 text-center">
            <div class="w-16 h-16 rounded-2xl bg-gray-100 flex items-center justify-center mx-auto text-gray-400">
                <i class="fas fa-inbox text-2xl"></i>
            </div>
            <h2 class="mt-4 text-lg font-bold text-gray-900">لا توجد طلبات</h2>
            <p class="mt-1 text-sm text-gray-500">لم تقم بإنشاء أي طلبات وصاية حتى الآن</p>
            <div class="mt-6">
                <a href="{{ route('parcels.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i>
                    <span>إنشاء طلب جديد</span>
                </a>
            </div>
        </div>
    @endif
</div>

@endsection
