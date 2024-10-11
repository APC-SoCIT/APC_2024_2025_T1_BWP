<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('user-profile'); // This should return the view for user profile
    }

    public function edit()
    {
        return view('edit-profile'); // This should return the view for editing profile
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate the input
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update the user's username
        $user->username = $request->username;

        // If a new password is provided, hash it and update
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
