<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profiles\Country;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return $request->only('email', 'password', 'password');
    }

    protected function validateLogin(Request $request)
    {
        if ($request->has('email')) {
            $request->validate([
                'email' => 'required|string',
                'password' => 'required|string',
            ]);
        } else {
            $request->validate([
                'phone' => 'required|string|numeric',
                'password' => 'required|string',
            ]);
        }
    }

    protected function attemptLogin(Request $request)
    {
        if ($request->has('email')) {
            return $this->guard()->attempt(
                $request->only('email', 'password'), $request->filled('remember')
            );
        } else {
            return $this->guard()->attempt(
                $request->only('phone', 'password'), $request->filled('remember')
            );
        }
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->has('phone')) {
            throw ValidationException::withMessages([
                'phone' => [trans('auth.failed')],
            ]);
        } else {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    public function showLoginForm()
    {
        $countries = Country::all();
        return view('auth.login', compact('countries'));
    }


    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect()->route('login');
    }
}
