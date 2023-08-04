<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Login (Create Session)
    public function create() {
        return inertia('Auth/Login');
    }

    // Login (Store Session if valid)
    public function store(Request $request) {
        if(!Auth::attempt($request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]), true)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed',
            ]);
        };

        $request->session()->regenerate();
        return redirect()->intended(route('listing.index'));
    }

    // Logout
    public function destroy(Request $request) {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        redirect(route('listing.index'));
    }
}
