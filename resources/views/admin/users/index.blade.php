@extends('admin.layout')

@section('title', 'إدارة المستخدمين')
@section('page-title', 'إدارة المستخدمين')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
    <div class="flex gap-2">
        <a href="{{ route('admin.users.index', ['status' => 'pending']) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 {{ ($status ?? 'pending') === 'pending' ? 'bg-amber-50 text-amber-700 border-2 border-amber-200 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">معلّقون</a>
        <a href="{{ route('admin.users.index', ['status' => 'approved']) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 {{ ($status ?? '') === 'approved' ? 'bg-secondary-50 text-secondary-700 border-2 border-secondary-200 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">موافق عليهم</a>
        <a href="{{ route('admin.users.index', ['status' => 'all']) }}" class="px-4 py-2 rounded-xl text-sm font-bold transition-all duration-200 {{ ($status ?? '') === 'all' ? 'bg-gray-800 text-white border-2 border-gray-800 shadow-sm' : 'bg-white text-gray-500 hover:bg-gray-50 border-2 border-gray-200' }}">الكل</a>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="text-sm text-gray-500 hover:text-primary-600 transition-colors font-medium"><i class="fas fa-arrow-right ml-1"></i> العودة</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-primary-500 to-primary-700"></div>
        <div class="text-2xl font-black text-gray-800">{{ $stats['total'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">إجمالي المستخدمين</div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-secondary-500 to-secondary-600"></div>
        <div class="text-2xl font-black text-secondary-600">{{ $stats['approved'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">المستخدمون المفعلون</div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 text-center relative overflow-hidden">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-amber-500 to-amber-600"></div>
        <div class="text-2xl font-black text-amber-600">{{ $stats['pending'] ?? 0 }}</div>
        <div class="text-xs text-gray-500 font-medium mt-1">في انتظار الموافقة</div>
    </div>
</div>

<div class="card">
    <div class="p-6">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-100">
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">#</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الاسم</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">رقم الهوية</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الجوال</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">البريد</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الحالة</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">تاريخ الطلب</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-3 text-sm text-gray-400">{{ $users->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->id_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->phone }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-3">
                                    @if($user->is_approved)
                                        <span class="badge bg-secondary-50 text-secondary-700">مفعل</span>
                                    @else
                                        <span class="badge bg-amber-50 text-amber-700">معلّق</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->created_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-1.5">
                                        @if(!$user->is_approved)
                                            <a href="{{ route('admin.users.approve', $user->id) }}" onclick="return confirm('الموافقة على هذا المستخدم؟')" class="w-8 h-8 flex items-center justify-center rounded-xl bg-secondary-50 text-secondary-600 hover:bg-secondary-100 transition-colors text-xs" title="موافقة"><i class="fas fa-check"></i></a>
                                        @endif
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">@csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('حذف هذا المستخدم؟')" class="w-8 h-8 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition-colors text-xs" title="حذف"><i class="fas fa-trash"></i></button>
                                        </form>
                                        <a href="mailto:{{ $user->email }}" class="w-8 h-8 flex items-center justify-center rounded-xl bg-gray-50 text-gray-500 hover:bg-gray-100 transition-colors text-xs" title="إرسال بريد"><i class="fas fa-envelope"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">{{ $users->links('pagination::tailwind') }}</div>
        @else
            <div class="text-center py-16">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4"><i class="fas fa-users-slash text-3xl text-gray-300"></i></div>
                <p class="font-bold text-gray-400">لا توجد نتائج</p>
            </div>
        @endif
    </div>
</div>
@endsection