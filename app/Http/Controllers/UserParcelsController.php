<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;

class UserParcelsController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Parcel::where('user_id', $request->user()->id);

        $search = trim((string) $request->query('q', ''));
        $statusFilter = $request->query('status', '');

        if ($search !== '') {
            $baseQuery->where(function ($q) use ($search) {
                $q->where('parcel_number', 'like', '%' . $search . '%')
                    ->orWhere('serial_number', 'like', '%' . $search . '%')
                    ->orWhere('agent_name', 'like', '%' . $search . '%')
                    ->orWhere('agent_phone', 'like', '%' . $search . '%');
            });
        }

        if ($statusFilter !== '' && in_array($statusFilter, [Parcel::STATUS_PENDING, Parcel::STATUS_DELIVERED])) {
            $baseQuery->where('status', $statusFilter);
        }

        $parcels = (clone $baseQuery)
            ->latest()
            ->paginate(10)
            ->withQueryString();

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

        return view('parcels.my', compact('parcels', 'expiringSoonCount', 'expiredCount', 'search', 'statusFilter'));
    }
}
