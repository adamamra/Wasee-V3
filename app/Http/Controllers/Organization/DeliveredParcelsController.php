<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use App\Exports\ParcelsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DeliveredParcelsController extends Controller
{
    public function index()
    {
        $organization = auth('organization')->user();
        $parcels = $organization->parcels()
            ->where('status', 'delivered')
            ->latest('delivered_at')
            ->paginate(10);

        return view('organization.delivered-parcels', compact('parcels'));
    }

    public function exportPendingParcels()
    {
        $organization = auth('organization')->user();
        return Excel::download(
            new ParcelsExport($organization->id),
            'pending_parcels_' . now()->format('Y-m-d') . '.xlsx'
        );
    }
}
