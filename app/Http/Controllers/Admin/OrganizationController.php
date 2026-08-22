<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of organizations with basic stats.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $query = Organization::query();

        if ($status === 'approved') {
            $query->where('is_approved', true);
        } elseif ($status === 'pending') {
            $query->where(function ($q) {
                $q->whereNull('is_approved')->orWhere('is_approved', false);
            });
        }

        $organizations = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

        $stats = [
            'total' => Organization::count(),
            'approved' => Organization::where('is_approved', true)->count(),
            'pending' => Organization::whereNull('is_approved')->orWhere('is_approved', false)->count(),
        ];

        return view('admin.organizations.index', compact('organizations', 'status', 'stats'));
    }

    /**
     * Toggle approval status for an organization.
     */
    public function toggleApproval(Organization $organization)
    {
        $organization->is_approved = ! (bool) $organization->is_approved;
        $organization->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $organization->is_approved ? 'org_approved' : 'org_disabled',
            'model_type' => Organization::class,
            'model_id' => $organization->id,
            'description' => ($organization->is_approved ? 'تم تفعيل' : 'تم إلغاء تفعيل') . " المؤسسة {$organization->name}",
        ]);

        $message = $organization->is_approved
            ? 'تم تفعيل المؤسسة بنجاح'
            : 'تم إلغاء تفعيل المؤسسة بنجاح';

        return redirect()->route('admin.organizations.index')
            ->with('success', $message);
    }

    /**
     * Delete an organization.
     */
    public function destroy(Organization $organization)
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'org_deleted',
            'model_type' => Organization::class,
            'model_id' => $organization->id,
            'description' => "تم حذف المؤسسة {$organization->name}",
        ]);

        $organization->delete();

        return redirect()->route('admin.organizations.index')
            ->with('success', 'تم حذف المؤسسة بنجاح');
    }
}
