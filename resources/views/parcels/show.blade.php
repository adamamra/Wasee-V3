@extends('layouts.app')

@section('title', 'تفاصيل الطلب')

@section('content')
<div class="container mx-auto px-4 py-8 lg:py-12">
    <div class="max-w-3xl mx-auto">
        @php $isDelivered = $parcel->status === App\Models\Parcel::STATUS_DELIVERED; @endphp
        <div class="bg-white rounded-3xl shadow-lg shadow-gray-200/50 border border-gray-100 overflow-hidden">
            <div class="p-6 lg:p-8">
                <div class="flex items-start justify-between gap-4 mb-6">
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-black text-gray-900">تفاصيل الطلب</h1>
                        <p class="text-sm text-gray-500 mt-1 font-medium">الرقم التسلسلي: <span class="font-bold text-primary-600">{{ $parcel->serial_number }}</span></p>
                    </div>
                    <span class="badge text-sm shrink-0 {{ $isDelivered ? 'bg-secondary-50 text-secondary-700' : 'bg-amber-50 text-amber-700' }}">{{ $isDelivered ? 'تم التسليم' : 'قيد الانتظار' }}</span>
                </div>

                <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl p-5 border border-gray-100 mb-8">
                    <div class="flex items-center justify-between gap-4">
                        <div class="text-center flex-1">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mx-auto shadow-lg shadow-primary-500/20"><i class="fas fa-paper-plane text-white"></i></div>
                            <p class="mt-2.5 text-sm font-bold text-gray-800">تم الإرسال</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $parcel->created_at->format('d-m-Y') }}</p>
                        </div>
                        <div class="h-0.5 flex-1 max-w-[120px] bg-gray-200 relative"><div class="absolute inset-0 bg-gradient-to-l from-primary-500 to-gray-200 rounded-full {{ $isDelivered ? 'w-full' : 'w-0' }}"></div></div>
                        <div class="text-center flex-1">
                            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mx-auto shadow-lg transition-all duration-500 {{ $isDelivered ? 'bg-gradient-to-br from-secondary-500 to-secondary-600 shadow-secondary-500/20' : 'bg-gray-200' }}"><i class="fas fa-check {{ $isDelivered ? 'text-white' : 'text-gray-400' }}"></i></div>
                            <p class="mt-2.5 text-sm font-bold text-gray-800">تم التسليم</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $parcel->delivered_at?->format('d-m-Y') ?? '---' }}</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-gray-800 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-primary-500 rounded-full inline-block"></span>معلومات الطلب</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">رقم الطرد</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->parcel_number }}</p></div>
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">الفرع</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->branch_name }}</p></div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-800 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-secondary-500 rounded-full inline-block"></span>معلومات الوصي</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">الاسم</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->agent_name }}</p></div>
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">رقم الهوية</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->agent_id_number }}</p></div>
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">الجوال</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->agent_phone }}</p></div>
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">البريد</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->user->email ?? '---' }}</p></div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-800 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-amber-500 rounded-full inline-block"></span>المواعيد</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">تاريخ الإنشاء</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->created_at->format('d-m-Y H:i') }}</p></div>
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">انتهاء الوصاية</p><p class="mt-1 font-bold text-gray-800">@if($parcel->expires_at){{ $parcel->expires_at->format('d-m-Y H:i') }}@if(now()->greaterThan($parcel->expires_at) && !$isDelivered)<span class="badge bg-red-50 text-red-700 text-xs mr-1.5">منتهية</span>@endif @else---@endif</p></div>
                            @if($parcel->delivered_at)
                                <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">تاريخ التسليم</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->delivered_at->format('d-m-Y H:i') }}</p></div>
                            @endif
                            <div class="bg-gray-50 rounded-xl p-4"><p class="text-xs text-gray-400">آخر تحديث</p><p class="mt-1 font-bold text-gray-800">{{ $parcel->updated_at->format('d-m-Y H:i') }}</p></div>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-gray-800 mb-3 flex items-center gap-2"><span class="w-1 h-5 bg-red-500 rounded-full inline-block"></span>سجل الطلب</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-4 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white text-sm shadow-md shrink-0"><i class="fas fa-plus"></i></div>
                                <div><p class="font-bold text-gray-800">تم إنشاء الطلب</p><p class="text-xs text-gray-400 mt-0.5">{{ $parcel->created_at->format('d-m-Y H:i') }}</p></div>
                            </div>
                            @if($parcel->delivered_at)
                                <div class="flex items-start gap-4 p-4 rounded-xl bg-gray-50 border border-gray-100">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-secondary-500 to-secondary-600 flex items-center justify-center text-white text-sm shadow-md shrink-0"><i class="fas fa-check"></i></div>
                                    <div><p class="font-bold text-gray-800">تم التسليم</p><p class="text-xs text-gray-400 mt-0.5">{{ $parcel->delivered_at->format('d-m-Y H:i') }}</p></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('parcels.my') }}" class="block w-full py-3.5 text-center bg-gray-50 text-gray-600 font-bold rounded-2xl border-2 border-gray-200 hover:border-primary-300 hover:text-primary-600 hover:bg-primary-50 transition-all duration-200 text-sm"><i class="fas fa-arrow-right ml-2"></i>العودة إلى طلباتي</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection