@extends('admin.layout')

@section('title', 'لوحة التحكم')
@section('page-title', 'لوحة التحكم')

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-lg transition-all duration-300">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-primary-500 to-primary-700"></div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-50 to-primary-100 flex items-center justify-center text-primary-500 text-lg shadow-sm group-hover:scale-110 transition-transform duration-300"><i class="fas fa-users"></i></div>
            <div><div class="text-2xl font-black text-gray-800">{{ App\Models\User::count() }}</div><div class="text-xs text-gray-500 font-medium">إجمالي المستخدمين</div></div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-lg transition-all duration-300">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-secondary-500 to-secondary-600"></div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-secondary-50 to-secondary-100 flex items-center justify-center text-secondary-500 text-lg shadow-sm group-hover:scale-110 transition-transform duration-300"><i class="fas fa-user-check"></i></div>
            <div><div class="text-2xl font-black text-gray-800">{{ App\Models\User::where('is_approved', true)->count() }}</div><div class="text-xs text-gray-500 font-medium">مفعلون</div></div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-lg transition-all duration-300">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-amber-500 to-amber-600"></div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-50 to-amber-100 flex items-center justify-center text-amber-500 text-lg shadow-sm group-hover:scale-110 transition-transform duration-300"><i class="fas fa-user-clock"></i></div>
            <div><div class="text-2xl font-black text-gray-800">{{ App\Models\User::where('is_approved', false)->count() }}</div><div class="text-xs text-gray-500 font-medium">بانتظار الموافقة</div></div>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-lg transition-all duration-300">
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-l from-purple-500 to-purple-600"></div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-purple-50 to-purple-100 flex items-center justify-center text-purple-500 text-lg shadow-sm group-hover:scale-110 transition-transform duration-300"><i class="fas fa-box"></i></div>
            <div><div class="text-2xl font-black text-gray-800">{{ App\Models\Parcel::count() }}</div><div class="text-xs text-gray-500 font-medium">إجمالي الطلبات</div></div>
        </div>
    </div>
</div>

<div class="card overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gradient-to-l from-gray-50 to-white">
        <span class="font-bold text-gray-800 flex items-center gap-2"><i class="fas fa-users-gear text-primary-500"></i> أحدث طلبات التسجيل</span>
        @if(\App\Models\User::where('is_approved', false)->count() > 0)
            <a href="{{ route('admin.users.index') }}" class="btn-primary btn-sm"><i class="fas fa-arrow-left text-xs mr-1"></i> عرض الكل</a>
        @endif
    </div>
    <div class="p-6">
        @php $pendingUsers = App\Models\User::where('is_approved', false)->orderBy('created_at', 'desc')->take(10)->get(); @endphp
        @if($pendingUsers->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الاسم</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">رقم الهوية</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">البريد الإلكتروني</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">تاريخ الطلب</th>
                            <th class="px-4 py-3 text-xs font-bold text-gray-500 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingUsers as $user)
                            <tr class="border-b border-gray-50 hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-3 text-sm font-bold text-gray-800">{{ $user->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->id_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-4 py-3"><span class="badge bg-amber-50 text-amber-700">{{ $user->created_at->diffForHumans() }}</span></td>
                                <td class="px-4 py-3">
                                    <div class="flex gap-1.5">
                                        <a href="{{ route('admin.users.approve', $user->id) }}" onclick="return confirm('الموافقة على هذا المستخدم؟')" class="w-8 h-8 flex items-center justify-center rounded-lg bg-secondary-50 text-secondary-600 hover:bg-secondary-100 transition-colors text-xs" title="موافقة"><i class="fas fa-check"></i></a>
                                        <button onclick="event.preventDefault(); if(confirm('رفض هذا الطلب؟')){document.getElementById('df-{{ $user->id }}').submit();}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors text-xs" title="رفض"><i class="fas fa-xmark"></i></button>
                                        <form id="df-{{ $user->id }}" action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="hidden">@csrf @method('DELETE')</form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4"><i class="fas fa-inbox text-3xl text-gray-300"></i></div>
                <h5 class="font-bold text-gray-400 mb-1">لا توجد طلبات تسجيل جديدة</h5>
                <p class="text-sm text-gray-400">جميع المستخدمين تمت الموافقة عليهم</p>
            </div>
        @endif
    </div>
</div>
@endsection