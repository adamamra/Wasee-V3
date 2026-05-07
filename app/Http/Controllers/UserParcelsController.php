<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class UserParcelsController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Parcel::where('user_id', $request->user()->id);

        $parcels = (clone $baseQuery)
            ->latest()
            ->paginate(10);

        $expiringSoonCount = (clone $baseQuery)
            ->whereNotNull('expires_at')
            ->where('status', '!=', Parcel::STATUS_DELIVERED)
            ->whereBetween('expires_at', [now(), now()->addDays(2)])
            ->count();

        $expiredCount = (clone $baseQuery)
            ->whereNotNull('expires_at')
            ->where('status', '!=', Parcel::STATUS_DELIVERED)
            ->where('expires_at', '<', now())
            ->count();

        return view('parcels.my', compact('parcels', 'expiringSoonCount', 'expiredCount'));
    }
}
