<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $error = 'Oppes! You have entered invalid credentials';
        $user = User::where('email', $request->email)->where('status', 1)->orWhere('mobile_no', $request->email)->where('status', 1)->first();
        if ($user) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
                return redirect()->route('dashboard');
            } elseif (Auth::attempt(['mobile_no' => $request->email, 'password' => $request->password, 'status' => 1])) {
                return redirect()->route('dashboard');
            }
        } else {
            $error = 'Oppes! Your account disabled.';
        }


        return redirect('login')->with('error', $error);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
