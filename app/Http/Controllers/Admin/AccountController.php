<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Update the authenticated admin's account details.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:8|confirmed',
            'old_password' => 'required_with:password',
        ]);

        $user = Auth::user();

        // Update name
        $user->name = $request->name;

        // If password change requested, verify current password first
        if ($request->filled('password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'The current password is incorrect.']);
            }
            $user->password = Hash::make($request->password);
        }

        // Email is intentionally not updatable here
        $user->save();

        return back()->with('status', 'Account updated successfully.');
    }
}
