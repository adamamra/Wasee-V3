@extends('layouts.app')

@section('title', 'الجهات - وصيّ')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">الجهات المعتمدة</h1>
            <p class="text-gray-600">قائمة الجهات المعتمدة في النظام</p>
        </div>

        <!-- Organizations Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse($organizations as $organization)
                <div class="card hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">{{ $organization->name }}</h3>
                                <p class="text-sm text-gray-500 mt-1">{{ $organization->city ?? 'N/A' }}</p>
                            </div>
                            <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-medium rounded-full">
                                معتمدة
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {{ $organization->description ?? 'لا توجد وصف متاح' }}
                        </p>

                        <div class="space-y-2 mb-6 text-sm">
                            @if($organization->email)
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-envelope ml-2 text-primary"></i>
                                    <span class="break-all">{{ $organization->email }}</span>
                                </div>
                            @endif
                            
                            @if($organization->phone)
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-phone ml-2 text-primary"></i>
                                    <span>{{ $organization->phone }}</span>
                                </div>
                            @endif

                            @if($organization->address)
                                <div class="flex items-start text-gray-700">
                                    <i class="fas fa-map-marker-alt ml-2 text-primary mt-0.5"></i>
                                    <span>{{ $organization->address }}</span>
                                </div>
                            @endif
                        </div>

                        <a href="{{ route('organizations.show', $organization) }}" class="btn btn-primary w-full">
                            عرض التفاصيل
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500 text-lg">لا توجد جهات معتمدة حالياً</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($organizations->hasPages())
            <div class="mt-8">
                {{ $organizations->links() }}
            </div>
        @endif
    </div>
@endsection
