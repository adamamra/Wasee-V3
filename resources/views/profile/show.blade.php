@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">الملف الشخصي</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">الاسم الكامل</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">البريد الإلكتروني</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">رقم الهوية</label>
                        <input type="text" class="form-control" value="{{ $user->id_number }}" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">رقم الجوال</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $user->phone) }}" required>
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">اسم الفرع</label>
                        <input type="text" name="branch_name" class="form-control @error('branch_name') is-invalid @enderror" value="{{ old('branch_name', $user->branch_name) }}">
                        @error('branch_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <hr class="my-4">

                    <h6 class="mb-3">تغيير كلمة المرور</h6>

                    <div class="mb-3">
                        <label class="form-label">كلمة المرور الحالية</label>
                        <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">كلمة المرور الجديدة</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">تأكيد كلمة المرور الجديدة</label>
                            <input type="password" name="new_password_confirmation" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save ms-1"></i> حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
