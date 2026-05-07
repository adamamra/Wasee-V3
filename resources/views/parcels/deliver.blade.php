@extends('layouts.app')

@section('title', 'تسليم طرد')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">تسليم طرد</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('parcels.show') }}" method="GET">
                    <div class="mb-3">
                        <label for="serial_number" class="form-label">أدخل الرقم التسلسلي للطرد</label>
                        <input type="text" class="form-control form-control-lg text-center" id="serial_number" 
                               name="serial_number" required autofocus>
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">بحث</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
