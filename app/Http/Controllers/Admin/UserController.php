<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display and manage users with optional status filter.
     */
    public function index(Request $request)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $status = $request->query('status', 'pending');

        $query = User::query();

        if ($status === 'pending') {
            $query->where('is_approved', false);
        } elseif ($status === 'approved') {
            $query->where('is_approved', true);
        }

        $users = $query->orderByDesc('created_at')->get();

        $stats = [
            'total' => User::count(),
            'approved' => User::where('is_approved', true)->count(),
            'pending' => User::where('is_approved', false)->count(),
        ];

        return view('admin.users.index', compact('users', 'status', 'stats'));
    }
    
    /**
     * Approve a user.
     */
    public function approve(User $user)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }
        
        // Check if user is already approved
        if ($user->is_approved) {
            return redirect()->route('admin.users.index')
                ->with('info', 'هذا المستخدم موافق عليه مسبقاً');
        }
        
        $user->is_approved = true;
        $user->save();

        return redirect()->route('admin.users.index')
            ->with('success', 'تمت الموافقة على المستخدم بنجاح');
    }

    /**
     * Reject a user (delete their account).
     */
    public function destroy($id)
    {
        if (!Auth::check() || Auth::user()->email !== 'admin@example.com') {
            abort(403, 'Unauthorized action.');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'تم رفض طلب المستخدم وحذف الحساب');
    }
}
