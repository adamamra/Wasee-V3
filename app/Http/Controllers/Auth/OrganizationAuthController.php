<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class OrganizationAuthController extends Controller
{
    /**
     * Show the organization login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login-org');
    }

    /**
     * Handle an organization login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('organization')->attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();

            $organization = Auth::guard('organization')->user();

            // منع دخول المؤسسة قبل الموافقة من الأدمن
            if (!$organization->is_approved) {
                Auth::guard('organization')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return back()->withErrors([
                    'email' => 'تم تسجيل المؤسسة، لكنها بانتظار موافقة المسؤول قبل إمكانية تسجيل الدخول.',
                ])->onlyInput('email');
            }

            return redirect()->intended(route('organization.dashboard'));
        }

        return back()->withErrors([
            'email' => 'بيانات الاعتماد المقدمة غير متطابقة مع سجلاتنا.',
        ])->onlyInput('email');
    }

    /**
     * Show the organization registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register-org');
    }

    /**
     * Handle an organization registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:organizations'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
        ]);

        $organization = Organization::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'is_approved' => false, // Default to false, admin needs to approve
        ]);

        // You can add email verification here if needed

        // لا نقوم بتسجيل دخول المؤسسة مباشرة، يجب انتظار موافقة الأدمن
        return redirect()->route('organization.login')
            ->with('status', 'تم تسجيل المؤسسة بنجاح، بانتظار موافقة المسؤول قبل إمكانية تسجيل الدخول.');
    }

    /**
     * Log the organization out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::guard('organization')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
