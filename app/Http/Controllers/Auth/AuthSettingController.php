<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthSettingController extends Controller
{
    /**
     * Show admin profile
     */
    public function adminProfile()
    {
        return view('Backend.auth.profile');
    }

    /**
     * Update admin profile
     */
    public function adminProfileUpdate(Request $request)
    {
        $admin = auth('admin')->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update admin password
     */
    public function adminPasswordUpdate(Request $request)
    {
        $admin = auth('admin')->user();

        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $admin->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}
