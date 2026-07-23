<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function index(Request $request)
    {
        return view('change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');

        $user = $request->user();

        // Validate old password
        if (!Hash::check($oldPassword, $user->password)) {
            abort(403, 'Unauthorized!');
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        // Log user out after password change
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
