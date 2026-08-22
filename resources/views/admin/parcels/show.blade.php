@extends('admin.layout')

@section('title', 'تفاصيل طلب الوصاية')
@section('page-title', 'تفاصيل طلب الوصاية')

@section('content')
<div class="flex justify-between items-center mb-6">
    <a href="{{ route('admin.parcels.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold text-gray-500 hover:text-primary-600 hover:bg-white transition-all duration-200 border-2 border-gray-200 bg-white"><i class="fas fa-arrow-right ml-1"></i> رجوع</a>
    <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" class="inline">@csrf @method('DELETE')
        <button type="submit" onclick="return confirm('حذف طلب الوصاية؟')" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-bold bg-red-500 text-white hover:bg-red-600 transition-all duration-200 shadow-md shadow-red-500/20"><i class="fas fa-trash ml-1"></i> حذف</button>
    </form>
</div>

@php $isDelivered = $parcel->status === App\Models\Parcel::STATUS_DELIVERED; @endphp

<div class="card overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-l from-gray-50 to-white border-b border-gray-100 flex items-center gap-3">
        <span class="px-3 py-1.5 bg-gray-800 text-white rounded-xl text-sm font-bold font-mono">{{ $parcel->serial_number }}</span>
        @if($isDelivered)
            <span class="px-3 py-1.5 bg-secondary-50 text-secondary-700 rounded-xl text-sm font-bold"><i class="fas fa-check-circle ml-1"></i> تم التسليم</span>
        @else
            <span class="px-3 py-1.5 bg-amber-50 text-amber-700 rounded-xl text-sm font-bold"><i class="fas fa-clock ml-1"></i> قيد الانتظار</span>
        @endif
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2"><span class="w-1 h-5 bg-primary-500 rounded-full inline-block"></span>معلومات الطلب</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">رقم الطرد</span><span class="font-bold text-gray-700">{{ $parcel->parcel_number }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">اسم المؤسسة</span><span class="font-bold text-gray-700">{{ $parcel->organization?->name ?? '-' }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">المستخدم</span><span class="font-bold text-gray-700">{{ $parcel->user?->name ?? '-' }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">تاريخ الإنشاء</span><span class="font-bold text-gray-700">{{ $parcel->created_at?->format('Y-m-d H:i') }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-400 font-medium">تاريخ التسليم</span><span class="font-bold text-gray-700">{{ $parcel->delivered_at?->format('Y-m-d H:i') ?? '-' }}</span></div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2"><span class="w-1 h-5 bg-secondary-500 rounded-full inline-block"></span>معلومات الوصي</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">الاسم</span><span class="font-bold text-gray-700">{{ $parcel->agent_name ?? '-' }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">الجوال</span><span class="font-bold text-gray-700">{{ $parcel->agent_phone ?? '-' }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-400 font-medium">رقم الهوية</span><span class="font-bold text-gray-700">{{ $parcel->agent_id_number ?? '-' }}</span></div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2"><span class="w-1 h-5 bg-amber-500 rounded-full inline-block"></span>معلومات المرسل</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">الاسم</span><span class="font-bold text-gray-700">{{ $parcel->sender_name ?? '-' }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">الجوال</span><span class="font-bold text-gray-700">{{ $parcel->sender_phone ?? '-' }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">رقم الهوية</span><span class="font-bold text-gray-700">{{ $parcel->sender_id_number ?? '-' }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-400 font-medium">العنوان</span><span class="font-bold text-gray-700">{{ $parcel->sender_address ?? '-' }}</span></div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2"><span class="w-1 h-5 bg-red-500 rounded-full inline-block"></span>معلومات المستلم</h4>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">الاسم</span><span class="font-bold text-gray-700">{{ $parcel->receiver_name ?? '-' }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">الجوال</span><span class="font-bold text-gray-700">{{ $parcel->receiver_phone ?? '-' }}</span></div>
                    <div class="flex justify-between items-center pb-2 border-b border-gray-200/50"><span class="text-gray-400 font-medium">رقم الهوية</span><span class="font-bold text-gray-700">{{ $parcel->receiver_id_number ?? '-' }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-400 font-medium">العنوان</span><span class="font-bold text-gray-700">{{ $parcel->receiver_address ?? '-' }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!$isDelivered)
<div class="card mt-6 overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-l from-gray-50 to-white border-b border-gray-100 font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-check-circle text-secondary-500"></i> تأكيد التسليم</div>
    <div class="p-6">
        <form action="{{ route('admin.parcels.deliver', $parcel->id) }}" method="POST">
            @csrf @method('PATCH')
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                <input type="text" name="receiver_name" placeholder="اسم المستلم" value="{{ old('receiver_name', $parcel->receiver_name) }}" required class="input text-sm @error('receiver_name') border-red-300 bg-red-50 @enderror">
                <input type="text" name="receiver_phone" placeholder="جوال المستلم" value="{{ old('receiver_phone', $parcel->receiver_phone) }}" required class="input text-sm @error('receiver_phone') border-red-300 bg-red-50 @enderror">
                <input type="text" name="receiver_id_number" placeholder="هوية المستلم" value="{{ old('receiver_id_number', $parcel->receiver_id_number) }}" required class="input text-sm @error('receiver_id_number') border-red-300 bg-red-50 @enderror">
                <input type="text" name="receiver_address" placeholder="عنوان المستلم" value="{{ old('receiver_address', $parcel->receiver_address) }}" required class="input text-sm @error('receiver_address') border-red-300 bg-red-50 @enderror">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-gradient-to-l from-secondary-500 to-secondary-600 text-white rounded-xl text-sm font-bold hover:shadow-xl hover:shadow-secondary-500/30 transition-all duration-200 active:scale-95"><i class="fas fa-check"></i> تأكيد التسليم</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection