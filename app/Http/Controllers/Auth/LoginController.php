<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if the login is an email or ID number
        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'id_number';
        
        $credentials = [
            $loginType => $request->login,
            'password' => $request->password,
        ];

        // Try to find the user by email or ID number
        $user = \App\Models\User::where($loginType, $request->login)->first();
        
        // If user exists but not approved
        if ($user && !$user->is_approved) {
            return redirect()->back()
                ->withInput($request->only('login', 'remember'))
                ->withErrors([
                    'login' => 'حسابك لم تتم الموافقة عليه بعد من قبل المسؤول.',
                ]);
        }

        // If user exists and is approved, attempt login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Redirect to admin dashboard if admin
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.users.index');
            }
            
            // For regular users, redirect to home
            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'login' => 'بيانات الاعتماد هذه غير متطابقة مع سجلاتنا.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
