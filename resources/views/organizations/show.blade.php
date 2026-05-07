@extends('layouts.app')

@section('title', $organization->name . ' - وصيّ')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ route('organizations.index') }}" class="text-primary hover:text-primary-hover flex items-center">
                <i class="fas fa-chevron-right ml-2"></i>
                العودة إلى الجهات
            </a>
        </div>

        <!-- Organization Header -->
        <div class="card mb-8">
            <div class="p-8">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-6 mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $organization->name }}</h1>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                            معتمدة
                        </span>
                    </div>
                </div>

                @if($organization->description)
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        {{ $organization->description }}
                    </p>
                @endif

                <!-- Contact Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($organization->email)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">البريد الإلكتروني</label>
                            <a href="mailto:{{ $organization->email }}" class="text-primary hover:text-primary-hover break-all">
                                {{ $organization->email }}
                            </a>
                        </div>
                    @endif

                    @if($organization->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">رقم الهاتف</label>
                            <a href="tel:{{ $organization->phone }}" class="text-primary hover:text-primary-hover">
                                {{ $organization->phone }}
                            </a>
                        </div>
                    @endif

                    @if($organization->city)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">المدينة</label>
                            <p class="text-gray-800">{{ $organization->city }}</p>
                        </div>
                    @endif

                    @if($organization->address)
                        <div>
                            <label class="block text-sm font-medium text-gray-600 mb-2">العنوان</label>
                            <p class="text-gray-800">{{ $organization->address }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Additional Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Statistics Card -->
            <div class="card">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">معلومات إضافية</h2>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-200">
                            <span class="text-gray-600">تاريخ الانضمام</span>
                            <span class="font-medium text-gray-800">{{ $organization->created_at->format('d/m/Y') }}</span>
                        </div>
                        @if($organization->is_approved)
                            <div class="flex justify-between items-center pb-3">
                                <span class="text-gray-600">الحالة</span>
                                <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-medium rounded-full">
                                    معتمدة
                                </span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            <div class="card">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">العمليات</h2>
                    <div class="space-y-3">
                        <a href="{{ route('organizations.index') }}" class="btn btn-outline w-full">
                            <i class="fas fa-arrow-left ml-2"></i>
                            العودة إلى الجهات
                        </a>
                        @auth
                            @if(auth()->user()->organization_id === $organization->id)
                                <a href="{{ route('organization.profile.show') }}" class="btn btn-primary w-full">
                                    <i class="fas fa-edit ml-2"></i>
                                    تعديل البيانات
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
