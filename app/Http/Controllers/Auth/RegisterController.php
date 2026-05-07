<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // Log the user out after registration (don't log them in automatically)
        Auth::logout();

        // Redirect to login page with a message about pending approval
        return redirect()->route('login')
            ->with('status', 'تم تقديم طلب التسجيل بنجاح. يرجى انتظار موافقة المسؤول على حسابك.');
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'id_number' => ['required', 'string', 'max:20', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:4',
                'max:4',
                'confirmed',
                'regex:/^[0-9]+$/',
            ],
        ], [
            'password.regex' => 'يجب أن يتكون الرمز السري من أرقام فقط',
            'password.min' => 'يجب أن يتكون الرمز السري من 4 أرقام',
            'password.max' => 'يجب أن يتكون الرمز السري من 4 أرقام',
            'id_number.unique' => 'رقم الهوية مسجل مسبقاً',
            'email.unique' => 'البريد الإلكتروني مسجل مسبقاً',
            'email.email' => 'يجب إدخال بريد إلكتروني صحيح',
            '*.required' => 'هذا الحقل مطلوب',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'id_number' => $data['id_number'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_approved' => false, // New users are not approved by default
        ]);
    }
    
    /**
     * The user has been registered but needs admin approval.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        // Log the user out since they need admin approval
        Auth::logout();
        
        // Redirect to login with a message
        return redirect('/login')
            ->with('status', 'تم تقديم طلب التسجيل بنجاح. يرجى انتظار موافقة المسؤول على حسابك.');
    }
}
