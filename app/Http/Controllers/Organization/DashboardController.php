<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the organization dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $organization = auth('organization')->user();

        $query = $organization->parcels();

        $stats = [
            'total' => (clone $query)->count(),
            'pending' => (clone $query)->where('status', '!=', Parcel::STATUS_DELIVERED)->count(),
            'delivered' => (clone $query)->where('status', Parcel::STATUS_DELIVERED)->count(),
        ];

        return view('organization.dashboard', compact('stats'));
    }

    /**
     * Search for a custody request by serial number.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function search(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string|max:255',
        ]);

        $organization = auth('organization')->user();

        // البحث عن الطلب برقم السيريال على مستوى جميع الطلبات
        // (لا يشترط أن يكون مربوطًا مسبقًا بالمؤسسة عبر organization_id)
        $parcel = Parcel::where('serial_number', $request->serial_number)->first();

        if (!$parcel) {
            return redirect()->route('organization.dashboard')
                ->with('error', 'لم يتم العثور على طلب الوصاية برقم السيريال المطلوب.');
        }

        // إذا انتهت مدة الوصاية والطرد لم يُسلّم، نعرض رسالة للمؤسسة لكن نظهر البيانات للقراءة فقط
        $query = $organization->parcels();

        $stats = [
            'total' => (clone $query)->count(),
            'pending' => (clone $query)->where('status', '!=', Parcel::STATUS_DELIVERED)->count(),
            'delivered' => (clone $query)->where('status', Parcel::STATUS_DELIVERED)->count(),
        ];

        if ($parcel->expires_at && now()->greaterThan($parcel->expires_at) && $parcel->status !== Parcel::STATUS_DELIVERED) {
            return view('organization.dashboard', [
                'parcel' => $parcel,
                'searched' => true,
                'stats' => $stats,
            ])->with('error', 'انتهت مدة الوصاية لهذا الطلب وتم إلغاؤها تلقائياً، لا يمكن تغيير حالته.');
        }

        return view('organization.dashboard', [
            'parcel' => $parcel,
            'searched' => true,
            'stats' => $stats,
        ]);
    }

    /**
     * Update the status of a parcel.
     *
     * @param  \App\Models\Parcel  $parcel
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Parcel $parcel, Request $request)
    {
        $organization = auth('organization')->user();

        if ($parcel->organization_id !== $organization->id) {
            return redirect()->route('organization.dashboard')
                ->with('error', 'هذا الطلب غير مرتبط بمؤسستك.');
        }

        $request->validate([
            'status' => 'required|in:' . implode(',', [
                Parcel::STATUS_PENDING,
                Parcel::STATUS_DELIVERED
            ]),
            'receiver_name' => 'required_if:status,' . Parcel::STATUS_DELIVERED . '|nullable|string|max:100',
            'receiver_phone' => 'required_if:status,' . Parcel::STATUS_DELIVERED . '|nullable|string|max:20',
            'receiver_id_number' => 'required_if:status,' . Parcel::STATUS_DELIVERED . '|nullable|string|max:50',
            'receiver_address' => 'required_if:status,' . Parcel::STATUS_DELIVERED . '|nullable|string|max:500',
        ]);

        $updateData = [
            'status' => $request->status,
            'delivered_at' => $request->status === Parcel::STATUS_DELIVERED ? now() : null,
            'receiver_name' => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_id_number' => $request->receiver_id_number,
            'receiver_address' => $request->receiver_address,
        ];

        $parcel->update($updateData);

        $message = match($request->status) {
            Parcel::STATUS_DELIVERED => 'تم تأكيد تسليم الطلب بنجاح',
            default => 'تم تحديث حالة الطلب بنجاح',
        };

        return redirect()->route('organization.parcels.search', ['serial_number' => $parcel->serial_number])
            ->with('status', $message);
    }
}
