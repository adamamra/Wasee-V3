<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display and manage users with optional status filter.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $query = User::query();

        if ($status === 'pending') {
            $query->where('is_approved', false);
        } elseif ($status === 'approved') {
            $query->where('is_approved', true);
        }

        $users = $query->orderByDesc('created_at')->paginate(15)->withQueryString();

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
        if ($user->is_approved) {
            return redirect()->route('admin.users.index')
                ->with('info', 'هذا المستخدم موافق عليه مسبقاً');
        }
        
        $user->is_approved = true;
        $user->save();

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'user_approved',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "تمت الموافقة على المستخدم {$user->name}",
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'تمت الموافقة على المستخدم بنجاح');
    }

    /**
     * Reject a user (delete their account).
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => 'user_rejected',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "تم رفض المستخدم {$user->name} وحذف الحساب",
        ]);

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'تم رفض طلب المستخدم وحذف الحساب');
    }
}
