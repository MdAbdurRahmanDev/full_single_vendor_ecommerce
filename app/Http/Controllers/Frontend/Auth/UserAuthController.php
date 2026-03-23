<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    /**
     * Show Login Page
     */
    public function showLogin()
    {
        return view('Frontend.auth.login');
    }

    /**
     * Show Register Page
     */
    public function showRegister()
    {
        return view('Frontend.auth.register');
    }

    /**
     * Handle Registration
     */
    public function register(Request $request)
    {
        $input = $request->input('email_or_phone');
        $isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);

        $rules = [
            'name' => 'required|string|max:100',
            'email_or_phone' => ['required', 'string'],
            'password' => 'required|string|min:6|confirmed',
        ];

        if ($isEmail) {
            $rules['email_or_phone'][] = 'email';
            $rules['email_or_phone'][] = 'unique:users,email';
        } else {
            $rules['email_or_phone'][] = 'max:20';
            $rules['email_or_phone'][] = 'unique:users,phone';
        }

        $request->validate($rules, [
            'email_or_phone.unique' => $isEmail ? 'This email is already registered.' : 'This phone number is already registered.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $isEmail ? $input : null,
            'phone' => $isEmail ? null : $input,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('web')->login($user);

        return redirect()->route('home')->with('success', 'Welcome to Brandao!');
    }

    /**
     * Handle Login
     */
    public function login(Request $request)
    {
        $input = $request->login_id;
        $isEmail = filter_var($input, FILTER_VALIDATE_EMAIL);
        $field = $isEmail ? 'email' : 'phone';

        $credentials = [
            $field => $input,
            'password' => $request->password,
        ];

        if (Auth::guard('web')->attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))->with('success', 'Logged in successfully!');
        }

        return back()->withErrors([
            'login_id' => 'Invalid ' . ($isEmail ? 'email' : 'phone number') . ' or password.',
        ])->onlyInput('login_id');
    }

    /**
     * Handle Logout
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'Logged out smoothly.');
    }
}
