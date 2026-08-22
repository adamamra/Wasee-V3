@extends('layouts.organization')

@section('title', 'لوحة تحكم المؤسسة')

@section('content')
{{-- Header --}}
<div class="bg-gradient-to-br from-primary-500 to-primary-700 rounded-3xl p-8 lg:p-10 mb-8 text-white relative overflow-hidden">
    <div class="absolute -top-32 -right-32 w-80 h-80 bg-white/10 rounded-full"></div>
    <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-white/5 rounded-full"></div>
    <div class="relative z-10">
        <h1 class="text-3xl lg:text-4xl font-black flex items-center gap-3 mb-2"><i class="fas fa-tachometer-alt text-amber-300"></i> لوحة تحكم المؤسسة</h1>
        <p class="text-white/80 font-medium text-lg">مرحباً بك في لوحة تحكم المؤسسة</p>
    </div>
</div>

{{-- Stats --}}
@if(isset($stats))
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-primary-500 to-primary-700"></div>
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white flex items-center justify-center text-xl shadow-lg shadow-primary-500/20 mb-4">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="text-3xl font-black text-gray-800 mb-1">{{ number_format($stats['total']) }}</div>
        <div class="text-sm text-gray-500 font-medium">إجمالي الطلبات</div>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-amber-500 to-amber-600"></div>
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 text-white flex items-center justify-center text-xl shadow-lg shadow-amber-500/20 mb-4">
            <i class="fas fa-clock"></i>
        </div>
        <div class="text-3xl font-black text-gray-800 mb-1">{{ number_format($stats['pending']) }}</div>
        <div class="text-sm text-gray-500 font-medium">قيد الانتظار</div>
    </div>
    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-secondary-500 to-secondary-600"></div>
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-secondary-500 to-secondary-600 text-white flex items-center justify-center text-xl shadow-lg shadow-secondary-500/20 mb-4">
            <i class="fas fa-circle-check"></i>
        </div>
        <div class="text-3xl font-black text-gray-800 mb-1">{{ number_format($stats['delivered']) }}</div>
        <div class="text-sm text-gray-500 font-medium">تم التسليم</div>
    </div>
</div>
@endif

{{-- Search --}}
<div class="bg-white rounded-2xl border border-gray-100 p-5 sm:p-7 mb-8 shadow-sm">
    <h2 class="text-base font-bold text-gray-800 mb-4 flex items-center gap-2">
        <i class="fas fa-search text-primary-500"></i> بحث عن طلب وصاية
    </h2>
    <form method="GET" action="{{ route('organization.parcels.search') }}" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
        <div class="flex-1 relative">
            <i class="fas fa-search absolute right-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="serial_number" value="{{ request('serial_number', '') }}" required placeholder="ابحث برقم السيريال..." class="w-full pr-14 py-4 px-5 bg-gradient-to-l from-primary-50/80 to-white border-2 border-primary-200 rounded-2xl text-base text-gray-800 placeholder-gray-400 font-medium focus:border-primary-500 focus:ring-4 focus:ring-primary-100 focus:bg-white outline-none transition-all duration-200">
        </div>
        <button type="submit" class="btn-primary shrink-0 py-4 px-8 text-base"><i class="fas fa-search"></i> بحث</button>
    </form>
    @error('serial_number')
        <p class="text-red-500 text-sm font-medium mt-3"><i class="fas fa-exclamation-circle ml-1"></i>{{ $message }}</p>
    @enderror
</div>

{{-- Parcel Result --}}
@if(isset($parcel) && $searched)
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    {{-- Header --}}
    <div class="bg-gradient-to-l from-gray-50 to-white p-6 lg:p-8 border-b border-gray-100">
        <div class="flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-box-open text-primary-500"></i> تفاصيل طلب الوصاية</h3>
            <span class="px-4 py-1.5 rounded-xl text-sm font-bold {{ $parcel->status == 'delivered' ? 'bg-secondary-50 text-secondary-700' : 'bg-amber-50 text-amber-700' }}">
                {{ $parcel->status == 'delivered' ? 'تم التسليم' : 'قيد الانتظار' }}
            </span>
        </div>
    </div>

    {{-- Body --}}
    <div class="p-6 lg:p-8">
        {{-- Progress --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <span class="font-bold text-gray-700">حالة الطلب الحالية</span>
                <span class="px-3 py-1 rounded-lg text-sm font-bold {{ $parcel->status == 'delivered' ? 'bg-secondary-50 text-secondary-700' : 'bg-amber-50 text-amber-700' }}">
                    {{ $parcel->status == 'delivered' ? 'تم التسليم' : 'قيد الانتظار' }}
                </span>
            </div>
            <div class="flex items-center justify-between max-w-sm mx-auto relative">
                <div class="text-center flex-1">
                    <div class="w-6 h-6 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 mx-auto mb-2 shadow-md shadow-primary-500/30"></div>
                    <div class="text-xs font-bold text-gray-600">تم إنشاء الطلب</div>
                </div>
                <div class="h-0.5 flex-1 bg-gray-200 max-w-[100px] relative">
                    <div class="absolute inset-0 bg-gradient-to-l from-secondary-500 to-gray-200 rounded-full transition-all duration-500 {{ $parcel->status == 'delivered' ? 'w-full' : 'w-0' }}"></div>
                </div>
                <div class="text-center flex-1">
                    <div class="w-6 h-6 rounded-full mx-auto mb-2 transition-all duration-500 shadow-md {{ $parcel->status == 'delivered' ? 'bg-gradient-to-br from-secondary-500 to-secondary-600 shadow-secondary-500/30' : 'bg-gray-300' }}"></div>
                    <div class="text-xs font-bold text-gray-600">تم التسليم</div>
                </div>
            </div>
        </div>

        {{-- Info Sections --}}
        <div class="space-y-6">
            {{-- Basic Info --}}
            <div>
                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2"><i class="fas fa-circle-info text-primary-400"></i> معلومات أساسية</h4>
                <div class="bg-gray-50 rounded-xl divide-y divide-gray-100">
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">رقم السيريال</span><span class="text-sm font-bold text-gray-800">{{ $parcel->serial_number }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">تاريخ الإنشاء</span><span class="text-sm font-bold text-gray-800">{{ $parcel->created_at->format('Y-m-d') }}</span></div>
                </div>
            </div>

            {{-- Agent Info --}}
            <div>
                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2"><i class="fas fa-user-shield text-primary-400"></i> معلومات الوصي</h4>
                <div class="bg-gray-50 rounded-xl divide-y divide-gray-100">
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">الاسم</span><span class="text-sm font-bold text-gray-800">{{ $parcel->agent_name ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">الجوال</span><span class="text-sm font-bold text-gray-800">{{ $parcel->agent_phone ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">رقم الهوية</span><span class="text-sm font-bold text-gray-800">{{ $parcel->agent_id_number ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">الفرع</span><span class="text-sm font-bold text-gray-800">{{ $parcel->branch_name ?? 'غير محدد' }}</span></div>
                </div>
            </div>

            {{-- Sender Info --}}
            <div>
                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2"><i class="fas fa-paper-plane text-primary-400"></i> معلومات المرسل</h4>
                <div class="bg-gray-50 rounded-xl divide-y divide-gray-100">
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">الاسم</span><span class="text-sm font-bold text-gray-800">{{ $parcel->sender_name ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">الهاتف</span><span class="text-sm font-bold text-gray-800">{{ $parcel->sender_phone ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">رقم الهوية</span><span class="text-sm font-bold text-gray-800">{{ $parcel->sender_id_number ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">العنوان</span><span class="text-sm font-bold text-gray-800">{{ $parcel->sender_address ?? 'غير محدد' }}</span></div>
                </div>
            </div>

            {{-- Receiver Info --}}
            <div>
                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2"><i class="fas fa-user text-primary-400"></i> معلومات المستلم</h4>
                <div class="bg-gray-50 rounded-xl divide-y divide-gray-100">
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">الاسم</span><span class="text-sm font-bold text-gray-800">{{ $parcel->receiver_name ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">الهاتف</span><span class="text-sm font-bold text-gray-800">{{ $parcel->receiver_phone ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">رقم الهوية</span><span class="text-sm font-bold text-gray-800">{{ $parcel->receiver_id_number ?? 'غير محدد' }}</span></div>
                    <div class="flex justify-between items-center px-4 py-3"><span class="text-sm text-gray-500">العنوان</span><span class="text-sm font-bold text-gray-800">{{ $parcel->receiver_address ?? 'غير محدد' }}</span></div>
                </div>
            </div>

            {{-- Notes --}}
            @if($parcel->notes)
            <div>
                <h4 class="font-bold text-gray-700 mb-3 flex items-center gap-2"><i class="fas fa-note-sticky text-primary-400"></i> ملاحظات</h4>
                <div class="bg-gray-50 rounded-xl p-4"><p class="text-sm text-gray-700">{{ $parcel->notes }}</p></div>
            </div>
            @endif
        </div>

        {{-- Delivery Form or Back Button --}}
        @if($parcel->status != \App\Models\Parcel::STATUS_DELIVERED)
        <div class="mt-8 bg-gradient-to-br from-primary-50/50 to-white border border-primary-100 rounded-2xl p-6">
            <h4 class="font-bold text-gray-700 mb-4 flex items-center gap-2 text-base"><i class="fas fa-check-circle text-secondary-500"></i> تأكيد التسليم</h4>
            <form action="{{ route('organization.parcels.update-status', $parcel) }}" method="POST">
                @csrf @method('PATCH')
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-4">
                    <input type="text" name="receiver_name" placeholder="اسم المستلم" value="{{ old('receiver_name', $parcel->receiver_name) }}" class="input-custom text-sm">
                    <input type="text" name="receiver_phone" placeholder="جوال المستلم" value="{{ old('receiver_phone', $parcel->receiver_phone) }}" class="input-custom text-sm">
                    <input type="text" name="receiver_id_number" placeholder="هوية المستلم" value="{{ old('receiver_id_number', $parcel->receiver_id_number) }}" class="input-custom text-sm">
                    <input type="text" name="receiver_address" placeholder="عنوان المستلم" value="{{ old('receiver_address', $parcel->receiver_address) }}" class="input-custom text-sm">
                </div>
                <input type="hidden" name="status" value="{{ \App\Models\Parcel::STATUS_DELIVERED }}">
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('organization.dashboard') }}" class="btn-secondary text-sm px-5 py-2.5"><i class="fas fa-arrow-right ml-1"></i> رجوع</a>
                    <button type="submit" class="btn bg-gradient-to-l from-secondary-500 to-secondary-600 text-white font-bold rounded-2xl px-6 py-2.5 text-sm hover:shadow-xl hover:shadow-secondary-500/30 transition-all duration-200 active:scale-95"><i class="fas fa-check ml-1"></i> تأكيد التسليم</button>
                </div>
            </form>
        </div>
        @else
        <div class="mt-6">
            <a href="{{ route('organization.dashboard') }}" class="btn-secondary text-sm px-5 py-2.5"><i class="fas fa-arrow-right ml-1"></i> رجوع</a>
        </div>
        @endif
    </div>
</div>
@endif
@endsection