<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrganizationController extends Controller
{
    /**
     * Display a listing of organizations with basic stats.
     */
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $status = $request->query('status', 'all');

        $query = Organization::query();

        if ($status === 'approved') {
            $query->where('is_approved', true);
        } elseif ($status === 'pending') {
            $query->where(function ($q) {
                $q->whereNull('is_approved')->orWhere('is_approved', false);
            });
        }

        $organizations = $query->orderByDesc('created_at')->get();

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
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $organization->is_approved = ! (bool) $organization->is_approved;
        $organization->save();

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
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $organization->delete();

        return redirect()->route('admin.organizations.index')
            ->with('success', 'تم حذف المؤسسة بنجاح');
    }
}
