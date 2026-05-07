@extends('layouts.app')

@section('title', 'تفاصيل الطلب')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        @php
            $statusData = [
                'pending' => ['label' => 'قيد الانتظار', 'bg' => '#fef3c7', 'color' => '#b45309'],
                'in_progress' => ['label' => 'قيد الانتظار', 'bg' => '#fef3c7', 'color' => '#b45309'],
                'delivered' => ['label' => 'تم التسليم', 'bg' => '#ecfdf5', 'color' => '#15803d'],
            ];
            $status = $statusData[$parcel->status] ?? $statusData['pending'];
        @endphp

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 md:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">تفاصيل الطلب</h1>
                        <p class="text-sm text-gray-500 mt-1">الرقم التسلسلي: <span class="font-semibold text-gray-900">{{ $parcel->serial_number }}</span></p>
                    </div>
                    <span class="text-xs font-semibold rounded-full px-3 py-1" style="background: {{ $status['bg'] }}; color: {{ $status['color'] }};">
                        {{ $status['label'] }}
                    </span>
                </div>

                <div class="mt-6 rounded-2xl bg-gray-50 p-4">
                    <div class="flex items-center justify-between gap-4">
                        <div class="text-center flex-1">
                            <div class="w-10 h-10 rounded-full mx-auto flex items-center justify-center" style="background: linear-gradient(135deg, #0284c7, #0369a1);">
                                <i class="fas fa-paper-plane text-white"></i>
                            </div>
                            <p class="mt-2 text-sm font-semibold text-gray-900">تم الإرسال</p>
                            <p class="text-xs text-gray-500">{{ $parcel->created_at->format('d-m-Y') }}</p>
                        </div>

                        <div class="h-0.5 flex-1 bg-gray-200"></div>

                        <div class="text-center flex-1">
                            <div class="w-10 h-10 rounded-full mx-auto flex items-center justify-center" style="background: {{ $parcel->status == 'delivered' ? 'linear-gradient(135deg, #16a34a, #15803d)' : '#e5e7eb' }};">
                                <i class="fas fa-check {{ $parcel->status == 'delivered' ? 'text-white' : 'text-gray-500' }}"></i>
                            </div>
                            <p class="mt-2 text-sm font-semibold text-gray-900">تم التسليم</p>
                            <p class="text-xs text-gray-500">{{ $parcel->delivered_at?->format('d-m-Y') ?? '---' }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 gap-6">
                    <div>
                        <h2 class="text-base font-bold text-gray-900">معلومات الطلب</h2>
                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">رقم الطرد</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->parcel_number }}</p>
                            </div>
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">المؤسسة / الفرع</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->branch_name }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-gray-900">معلومات الوصي</h2>
                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">الاسم</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->agent_name }}</p>
                            </div>
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">رقم الهوية</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->agent_id_number }}</p>
                            </div>
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">رقم الجوال</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->agent_phone }}</p>
                            </div>
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">البريد الإلكتروني</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->user->email ?? '---' }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-gray-900">المواعيد</h2>
                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">تاريخ الإنشاء</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->created_at->format('d-m-Y H:i') }}</p>
                            </div>
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">انتهاء الوصاية</p>
                                <p class="mt-1 font-semibold text-gray-900">
                                    @if($parcel->expires_at)
                                        {{ $parcel->expires_at->format('d-m-Y H:i') }}
                                        @if(now()->greaterThan($parcel->expires_at) && $parcel->status !== 'delivered')
                                            <span class="inline-flex items-center rounded-full bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 mr-2">منتهية</span>
                                        @endif
                                    @else
                                        ---
                                    @endif
                                </p>
                            </div>
                            @if($parcel->delivered_at)
                                <div class="rounded-xl bg-gray-50 p-4">
                                    <p class="text-xs text-gray-500">تاريخ التسليم</p>
                                    <p class="mt-1 font-semibold text-gray-900">{{ $parcel->delivered_at->format('d-m-Y H:i') }}</p>
                                </div>
                            @endif
                            <div class="rounded-xl bg-gray-50 p-4">
                                <p class="text-xs text-gray-500">آخر تحديث</p>
                                <p class="mt-1 font-semibold text-gray-900">{{ $parcel->updated_at->format('d-m-Y H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-base font-bold text-gray-900">سجل الطلب</h2>
                        <div class="mt-3 space-y-4">
                            <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #0284c7, #0369a1);">
                                    <i class="fas fa-plus text-white text-xs"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">تم إنشاء الطلب</p>
                                    <p class="text-xs text-gray-500">{{ $parcel->created_at->format('d-m-Y H:i') }}</p>
                                </div>
                            </div>

                            @if($parcel->delivered_at)
                                <div class="flex items-start gap-3 p-4 rounded-xl bg-gray-50">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #16a34a, #15803d);">
                                        <i class="fas fa-check text-white text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">تم التسليم</p>
                                        <p class="text-xs text-gray-500">{{ $parcel->delivered_at->format('d-m-Y H:i') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('parcels.my') }}" class="btn btn-outline w-full">
                        <i class="fas fa-arrow-left"></i>
                        <span>العودة</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
