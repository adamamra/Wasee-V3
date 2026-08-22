<?php

use App\Models\Parcel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('wa3ee:check-expiry', function () {
    $expired = Parcel::whereNotNull('expires_at')
        ->where('status', '!=', Parcel::STATUS_DELIVERED)
        ->where('expires_at', '<', now())
        ->get();

    foreach ($expired as $parcel) {
        Log::warning("انتهت صلاحية الطلب رقم {$parcel->serial_number} للوصي {$parcel->agent_name}");
    }

    $this->info("تم فحص {$expired->count()} طلب(ات) منتهية الصلاحية.");
})->purpose('فحص الطلبات منتهية الصلاحية وتسجيلها');

Schedule::command('wa3ee:check-expiry')->daily()->withoutOverlapping();
