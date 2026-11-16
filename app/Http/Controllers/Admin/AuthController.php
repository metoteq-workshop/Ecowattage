<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the Ecowattage CMS login page.
     */
    public function showLogin(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Authenticate a CMS user and record an audit log entry.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt([...$credentials, 'is_active' => true], $request->boolean('remember'))) {
            $request->session()->regenerate();

            ActivityLog::record(
                'auth.login',
                "User {$request->user()?->email} signed in to Ecowattage CMS."
            );

            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match an active CMS account.',
        ])->onlyInput('email');
    }

    /**
     * Log out the authenticated CMS user.
     */
    public function logout(Request $request): RedirectResponse
    {
        if ($request->user() !== null) {
            ActivityLog::record(
                'auth.logout',
                "User {$request->user()->email} signed out of Ecowattage CMS."
            );
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
