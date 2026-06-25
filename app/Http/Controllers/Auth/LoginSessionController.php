<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginSessionController extends Controller
{
    /**
     * Display the custom corporate login view.
     */
    public function create()
    {
        return view('login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Attempt authentication using the credentials stored in your users table
        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => __('The provided credentials do not match our organizational records.'),
            ]);
        }

        // Regenerate session to protect against session fixation attacks
        $request->session()->regenerate();

        // Redirect directly to the secure dashboard module
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session (Logout).
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
