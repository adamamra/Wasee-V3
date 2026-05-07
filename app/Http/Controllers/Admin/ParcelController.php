<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $status = $request->query('status', 'all');
        $search = trim((string) $request->query('q', ''));

        $query = Parcel::query()->with(['user', 'organization']);

        if ($status === 'pending') {
            $query->where('status', '!=', Parcel::STATUS_DELIVERED);
        } elseif ($status === 'delivered') {
            $query->where('status', Parcel::STATUS_DELIVERED);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('serial_number', 'like', '%' . $search . '%')
                    ->orWhere('parcel_number', 'like', '%' . $search . '%')
                    ->orWhere('agent_name', 'like', '%' . $search . '%')
                    ->orWhere('sender_name', 'like', '%' . $search . '%')
                    ->orWhere('sender_phone', 'like', '%' . $search . '%');
            });
        }

        $parcels = $query->orderByDesc('created_at')->get();

        $stats = [
            'total' => Parcel::count(),
            'pending' => Parcel::where('status', '!=', Parcel::STATUS_DELIVERED)->count(),
            'delivered' => Parcel::where('status', Parcel::STATUS_DELIVERED)->count(),
        ];

        return view('admin.parcels.index', compact('parcels', 'status', 'stats', 'search'));
    }

    public function show(Parcel $parcel)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $parcel->load(['user', 'organization']);

        return view('admin.parcels.show', compact('parcel'));
    }

    public function deliver(Request $request, Parcel $parcel)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        if ($parcel->status === Parcel::STATUS_DELIVERED) {
            return redirect()->route('admin.parcels.show', $parcel)
                ->with('success', 'هذا الطلب تم تسليمه مسبقاً');
        }

        $validated = $request->validate([
            'receiver_name' => 'required|string|max:100',
            'receiver_phone' => 'required|string|max:20',
            'receiver_id_number' => 'required|string|max:50',
            'receiver_address' => 'required|string|max:500',
        ]);

        $parcel->update($validated + [
            'status' => Parcel::STATUS_DELIVERED,
            'delivered_at' => now(),
        ]);

        return redirect()->route('admin.parcels.show', $parcel)
            ->with('success', 'تم تأكيد تسليم الطلب بنجاح');
    }

    public function destroy(Parcel $parcel)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $parcel->delete();

        return redirect()->route('admin.parcels.index')
            ->with('success', 'تم حذف طلب الوصاية بنجاح');
    }
}
