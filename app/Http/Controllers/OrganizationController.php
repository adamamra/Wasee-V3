<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of organizations.
     */
    public function index()
    {
        $organizations = Organization::where('is_approved', true)
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('organizations.index', compact('organizations'));
    }

    /**
     * Display the specified organization.
     */
    public function show(Organization $organization)
    {
        if (!$organization->is_approved) {
            abort(404);
        }

        return view('organizations.show', compact('organization'));
    }
}
