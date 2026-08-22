<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    public function index(Request $request)
    {
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

        $parcels = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        $stats = [
            'total' => Parcel::count(),
            'pending' => Parcel::where('status', '!=', Parcel::STATUS_DELIVERED)->count(),
            'delivered' => Parcel::where('status', Parcel::STATUS_DELIVERED)->count(),
        ];

        return view('admin.parcels.index', compact('parcels', 'status', 'stats', 'search'));
    }

    public function show(Parcel $parcel)
    {
        $parcel->load(['user', 'organization']);

        return view('admin.parcels.show', compact('parcel'));
    }

    public function deliver(Request $request, Parcel $parcel)
    {
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

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'parcel_delivered',
            'model_type' => Parcel::class,
            'model_id' => $parcel->id,
            'description' => "تم تأكيد تسليم الطلب رقم {$parcel->serial_number}",
        ]);

        return redirect()->route('admin.parcels.show', $parcel)
            ->with('success', 'تم تأكيد تسليم الطلب بنجاح');
    }

    public function destroy(Parcel $parcel)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'parcel_deleted',
            'model_type' => Parcel::class,
            'model_id' => $parcel->id,
            'description' => "تم حذف طلب الوصاية رقم {$parcel->serial_number}",
        ]);

        $parcel->delete();

        return redirect()->route('admin.parcels.index')
            ->with('success', 'تم حذف طلب الوصاية بنجاح');
    }
}
