@extends('layouts.app')

@section('title', 'الجهات - وصيّ')

@section('content')
<div class="container mx-auto px-4 py-8 lg:py-12">
    <div class="mb-8">
        <h1 class="text-3xl lg:text-4xl font-black text-gray-900 mb-2">الجهات المعتمدة</h1>
        <p class="text-gray-500 font-medium">قائمة الجهات المعتمدة في النظام</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        @forelse($organizations as $organization)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">{{ $organization->name }}</h3>
                            <p class="text-sm text-gray-400 mt-0.5">{{ $organization->city ?? 'N/A' }}</p>
                        </div>
                        <span class="badge bg-secondary-50 text-secondary-700 text-xs">معتمدة</span>
                    </div>
                    <p class="text-gray-500 text-sm mb-4 line-clamp-3">{{ $organization->description ?? 'لا توجد وصف متاح' }}</p>
                    <div class="space-y-2 mb-6 text-sm">
                        @if($organization->email)<div class="flex items-center gap-2 text-gray-600"><i class="fas fa-envelope text-primary-400 w-4 text-center"></i><span class="break-all">{{ $organization->email }}</span></div>@endif
                        @if($organization->phone)<div class="flex items-center gap-2 text-gray-600"><i class="fas fa-phone text-primary-400 w-4 text-center"></i><span>{{ $organization->phone }}</span></div>@endif
                        @if($organization->address)<div class="flex items-start gap-2 text-gray-600"><i class="fas fa-map-location-dot text-primary-400 w-4 text-center mt-0.5"></i><span>{{ $organization->address }}</span></div>@endif
                    </div>
                    <a href="{{ route('organizations.show', $organization) }}" class="block w-full py-3 text-center bg-primary-50 text-primary-600 font-bold rounded-2xl hover:bg-primary-100 hover:text-primary-700 transition-all duration-200 text-sm border border-primary-100">عرض التفاصيل <i class="fas fa-arrow-left text-xs mr-1"></i></a>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16">
                <div class="text-5xl text-gray-200 mb-4"><i class="fas fa-inbox"></i></div>
                <p class="text-gray-400 font-bold text-lg">لا توجد جهات معتمدة حالياً</p>
            </div>
        @endforelse
    </div>
    @if($organizations->hasPages())
        <div class="mt-8 flex justify-center">{{ $organizations->links('pagination::bootstrap-5') }}</div>
    @endif
</div>
@endsection