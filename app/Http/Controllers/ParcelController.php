<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function create()
    {
        if (auth('organization')->check()) {
            abort(403);
        }

        $organizations = Organization::where('is_approved', true)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('parcels.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        if (auth('organization')->check()) {
            abort(403);
        }

        $validated = $request->validate([
            'organization_id' => 'required|exists:organizations,id,is_approved,1',
            'parcel_number' => 'required|string|max:50',
            'agent_name' => 'required|string|max:100',
            'agent_phone' => 'required|string|max:20',
            'agent_id_number' => 'required|string|max:50',
            'branch_name' => 'required|string|max:100',
            'custody_days' => 'required|integer|min:1|max:365',
        ], [
            'organization_id.required' => 'يرجى اختيار المؤسسة',
            'organization_id.exists' => 'المؤسسة المحددة غير صالحة',
        ]);

        $days = (int) $validated['custody_days'];
        $expiresAt = now()->addDays($days);

        $user = $request->user();

        $parcel = Parcel::create($validated + [
            'user_id' => $user->id,
            'organization_id' => $validated['organization_id'],
            'sender_name' => $user->name ?? null,
            'sender_phone' => $user->phone ?? null,
            'sender_id_number' => $user->id_number ?? null,
            'sender_address' => $user->branch_name ?? null,
            'expires_at' => $expiresAt,
        ]);

        return redirect()->route('parcels.show', $parcel->serial_number)
            ->with('success', 'تم إنشاء طلب الوصاية بنجاح');
    }

    public function show(Request $request, $serialNumber = null)
    {
        // If serial number is in the request (from search form), redirect to the show route
        if ($request->has('serial_number')) {
            return redirect()->route('parcels.show', $request->serial_number);
        }

        // If no serial number is provided, show the search form
        if (!$serialNumber) {
            return $this->deliverForm();
        }

        $parcel = Parcel::where('serial_number', $serialNumber)->firstOrFail();
        return view('parcels.show', compact('parcel'));
    }

    public function deliverForm()
    {
        abort(403);
    }

    public function deliver(Request $request, $serialNumber)
    {
        abort(403);
    }
}
