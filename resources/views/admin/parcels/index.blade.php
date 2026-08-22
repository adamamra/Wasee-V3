@extends('admin.layout')

@section('title', 'إدارة طلبات الوصاية')
@section('page-title', 'إدارة طلبات الوصاية')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-primary-500 to-primary-700"></div>
        <div class="text-2xl font-black text-gray-800">{{ $stats['total'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">إجمالي الطلبات</div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-amber-500 to-amber-600"></div>
        <div class="text-2xl font-black text-amber-600">{{ $stats['pending'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">قيد الانتظار</div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-secondary-500 to-secondary-600"></div>
        <div class="text-2xl font-black text-secondary-600">{{ $stats['delivered'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">تم التسليم</div>
    </div>
</div>

<div class="card">
    <div class="px-6 py-4 border-b border-gray-100 bg-gradient-to-l from-gray-50 to-white">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3">
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.parcels.index', ['status' => 'all', 'q' => $search ?? null]) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 {{ ($status ?? 'all') === 'all' ? 'bg-gray-800 text-white shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">الكل</a>
                <a href="{{ route('admin.parcels.index', ['status' => 'pending', 'q' => $search ?? null]) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 {{ ($status ?? '') === 'pending' ? 'bg-amber-50 text-amber-700 border-2 border-amber-200 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">قيد الانتظار</a>
                <a href="{{ route('admin.parcels.index', ['status' => 'delivered', 'q' => $search ?? null]) }}" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-all duration-200 {{ ($status ?? '') === 'delivered' ? 'bg-secondary-50 text-secondary-700 border-2 border-secondary-200 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">تم التسليم</a>
            </div>
            <form method="GET" action="{{ route('admin.parcels.index') }}" class="flex gap-2 w-full md:w-auto">
                <input type="hidden" name="status" value="{{ $status ?? 'all' }}">
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="بحث..." class="input text-sm flex-1 md:w-56">
                <button type="submit" class="btn-primary btn-sm"><i class="fas fa-search"></i></button>
                @if(($search ?? '') !== '')
                    <a href="{{ route('admin.parcels.index', ['status' => $status ?? 'all']) }}" class="btn rounded-xl text-xs px-3 py-1.5 border-2 border-gray-200 text-gray-500 hover:bg-gray-50">مسح</a>
                @endif
            </form>
        </div>
    </div>
    <div class="p-6">
        @if(($parcels ?? collect())->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">#</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">السيريال</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">رقم الطرد</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">المؤسسة</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">المستخدم</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الوصي</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الحالة</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">تاريخ الإنشاء</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parcels as $index => $parcel)
                            @php $isDelivered = $parcel->status === App\Models\Parcel::STATUS_DELIVERED; @endphp
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-400">{{ $parcels->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-gray-800 font-mono">{{ $parcel->serial_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $parcel->parcel_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $parcel->organization?->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $parcel->user?->name ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $parcel->agent_name ?? '-' }}</td>
                                <td class="px-4 py-3">@if($isDelivered)<span class="badge bg-secondary-50 text-secondary-700">تم التسليم</span>@else<span class="badge bg-amber-50 text-amber-700">قيد الانتظار</span>@endif</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $parcel->created_at?->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-1.5">
                                        <a href="{{ route('admin.parcels.show', $parcel->id) }}" class="w-8 h-8 flex items-center justify-center rounded-xl bg-primary-50 text-primary-600 hover:bg-primary-100 transition-colors text-xs" title="عرض"><i class="fas fa-eye"></i></a>
                                        <form action="{{ route('admin.parcels.destroy', $parcel->id) }}" method="POST" class="inline">@csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('حذف طلب الوصاية؟')" class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition-colors text-xs" title="حذف"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $parcels->links('pagination::tailwind') }}</div>
        @else
            <div class="text-center py-16">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4"><i class="fas fa-box-open text-3xl text-gray-300"></i></div>
                <p class="font-bold text-gray-400">لا توجد طلبات وصاية مطابقة</p>
            </div>
        @endif
    </div>
</div>
@endsection