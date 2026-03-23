<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Admin Login Page
     */
    public function adminLogin()
    {
        return view('Backend.auth.login');
    }

    /**
     * Admin Login
     */
    public function adminLoginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
}
