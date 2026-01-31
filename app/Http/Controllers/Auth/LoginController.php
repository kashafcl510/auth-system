<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

   protected function redirectTo()
    {
        if (Auth::user()->role === 'admin') {
            return '/admin/dashboard';
        } else {
            return '/dashboard';
        }
    }





    public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Login successful',
                'user' => Auth::user(),
                 'redirect' => $this->redirectTo(),
            ]);
        }

        return redirect()->intended($this->redirectTo);
    }

    if ($request->expectsJson()) {
        return response()->json([
            'errors' => [
                'email' => ['These credentials do not match our records.']
            ]
        ], 422);
    }

    throw ValidationException::withMessages([
        'email' => ['These credentials do not match our records.'],
    ]);
}
}





