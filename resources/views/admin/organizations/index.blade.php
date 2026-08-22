@extends('admin.layout')

@section('title', 'إدارة المؤسسات')
@section('page-title', 'إدارة المؤسسات')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div class="flex gap-2">
        <a href="{{ route('admin.organizations.index', ['status' => 'all']) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 {{ ($status ?? 'all') === 'all' ? 'bg-gray-800 text-white border-2 border-gray-800 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">الكل</a>
        <a href="{{ route('admin.organizations.index', ['status' => 'approved']) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 {{ ($status ?? '') === 'approved' ? 'bg-secondary-50 text-secondary-700 border-2 border-secondary-200 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">مفعلة</a>
        <a href="{{ route('admin.organizations.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 {{ ($status ?? '') === 'pending' ? 'bg-amber-50 text-amber-700 border-2 border-amber-200 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">معلقة</a>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-primary-600 transition-colors font-medium"><i class="fas fa-arrow-right ml-1"></i> العودة</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-primary-500 to-primary-700"></div>
        <div class="text-2xl font-black text-gray-800">{{ $stats['total'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">إجمالي المؤسسات</div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-secondary-500 to-secondary-600"></div>
        <div class="text-2xl font-black text-secondary-600">{{ $stats['approved'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">المؤسسات المفعلة</div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-amber-500 to-amber-600"></div>
        <div class="text-2xl font-black text-amber-600">{{ $stats['pending'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">في انتظار الموافقة</div>
    </div>
</div>

<div class="card">
    <div class="p-6">
        @if($organizations->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">#</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">اسم المؤسسة</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">البريد</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الهاتف</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">العنوان</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الحالة</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">تاريخ التسجيل</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($organizations as $index => $org)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-400">{{ $organizations->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-gray-800">{{ $org->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $org->email }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $org->phone ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ Str::limit($org->address ?? '-', 30) }}</td>
                                <td class="px-4 py-3">@if($org->is_approved)<span class="badge bg-secondary-50 text-secondary-700">مفعلة</span>@else<span class="badge bg-amber-50 text-amber-700">معلقة</span>@endif</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $org->created_at?->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-1.5">
                                        <form action="{{ route('admin.organizations.toggle-approval', $org->id) }}" method="POST" class="inline">@csrf @method('PATCH')
                                            <button type="submit" class="px-3 py-1.5 rounded-xl text-xs font-bold transition-colors {{ $org->is_approved ? 'bg-amber-50 text-amber-600 hover:bg-amber-100' : 'bg-secondary-50 text-secondary-600 hover:bg-secondary-100' }}">
                                                @if($org->is_approved) <i class="fas fa-ban ml-1"></i>إلغاء التفعيل @else <i class="fas fa-check ml-1"></i>تفعيل @endif
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.organizations.destroy', $org->id) }}" method="POST" class="inline">@csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('حذف هذه المؤسسة؟')" class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition-colors text-xs" title="حذف"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $organizations->links('pagination::tailwind') }}</div>
        @else
            <div class="text-center py-16">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4"><i class="fas fa-building-circle-exclamation text-3xl text-gray-300"></i></div>
                <p class="font-bold text-gray-400">لا توجد مؤسسات مطابقة</p>
            </div>
        @endif
    </div>
</div>
@endsection