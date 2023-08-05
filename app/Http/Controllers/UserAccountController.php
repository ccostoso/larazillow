<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAccountController extends Controller
{
    // Render form
    public function create() {
        return inertia('UserAccount/Create');
    }

    public function store(Request $request) {
        $user = User::make($request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]));

        // No need for "$user->password = Hash::make($user->password);" as User model handle it using Attribute::make() method
        $user->save();

        Auth::login($user);

        return redirect()->route('listing.index')
            ->with('success', 'Account created successfully.');
    }
}
