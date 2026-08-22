@extends('layouts.organization')

@section('title', 'الطرود المسلمة')

@section('content')
<div class="bg-gradient-to-br from-secondary-500 to-secondary-700 rounded-3xl p-8 mb-8 text-white relative overflow-hidden">
    <div class="absolute -top-32 -right-32 w-80 h-80 bg-white/10 rounded-full"></div>
    <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-white/5 rounded-full"></div>
    <div class="relative z-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-black flex items-center gap-3"><i class="fas fa-box-check-circle text-amber-300"></i> الطرود المسلمة</h1>
            <p class="text-white/80 font-medium mt-1">عرض جميع الطرود التي تم تسليمها بنجاح</p>
        </div>
        <a href="{{ route('organization.dashboard') }}" class="bg-white/20 hover:bg-white/30 text-white font-bold px-5 py-2.5 rounded-xl transition-all duration-200 flex items-center gap-2 text-sm border border-white/20"><i class="fas fa-arrow-right"></i>العودة للوحة التحكم</a>
    </div>
</div>

<div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 lg:p-8">
        @forelse($parcels as $parcel)
        @empty
            <div class="text-center py-16">
                <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5"><i class="fas fa-inbox text-4xl text-gray-300"></i></div>
                <h3 class="text-xl font-bold text-gray-500 mb-2">لا توجد طرود مسلمة</h3>
                <p class="text-gray-400">لم يتم تسليم أي طرود بعد. سيظهر هنا جميع الطرود المسلمة.</p>
            </div>
        @endforelse

        @if(count($parcels) > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-l from-gray-50 to-white border-b-2 border-gray-100">
                        <th class="text-right p-4 font-bold text-gray-700 text-sm">#</th>
                        <th class="text-right p-4 font-bold text-gray-700 text-sm">رقم الشحنة</th>
                        <th class="text-right p-4 font-bold text-gray-700 text-sm">رقم السيريال</th>
                        <th class="text-right p-4 font-bold text-gray-700 text-sm">اسم الوكيل</th>
                        <th class="text-right p-4 font-bold text-gray-700 text-sm">هوية الوكيل</th>
                        <th class="text-right p-4 font-bold text-gray-700 text-sm">تاريخ التسليم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parcels as $parcel)
                    <tr class="border-b border-gray-50 hover:bg-gradient-to-l hover:from-secondary-50 hover:to-white transition-all duration-200">
                        <td class="p-4 text-sm font-bold text-gray-600">{{ $loop->iteration + (($parcels->currentPage() - 1) * $parcels->perPage()) }}</td>
                        <td class="p-4 text-sm"><span class="bg-purple-50 text-purple-700 px-3 py-1 rounded-lg font-bold">{{ $parcel->parcel_number }}</span></td>
                        <td class="p-4 text-sm"><span class="bg-sky-50 text-sky-700 px-3 py-1 rounded-lg font-mono font-bold">{{ $parcel->serial_number }}</span></td>
                        <td class="p-4 text-sm font-bold text-gray-800">{{ $parcel->agent_name }}</td>
                        <td class="p-4 text-sm"><span class="bg-amber-50 text-amber-700 px-3 py-1 rounded-lg font-mono font-bold">{{ $parcel->agent_id_number }}</span></td>
                        <td class="p-4 text-sm"><span class="bg-secondary-50 text-secondary-700 px-3 py-1.5 rounded-xl font-bold inline-flex items-center gap-1.5"><i class="fas fa-calendar-check text-xs"></i>{{ $parcel->delivered_at->format('Y-m-d H:i') }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    @if($parcels->hasPages())
    <div class="border-t border-gray-100 p-6 bg-gray-50 flex justify-center">
        {{ $parcels->links() }}
    </div>
    @endif
</div>
@endsection