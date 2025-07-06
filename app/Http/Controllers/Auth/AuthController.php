<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        Log::debug('Login attempt', [
            'username' => $credentials['username'],
            'session_id' => session()->getId(),
            'auth_check_before' => Auth::check()
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->save(); // Explicitly save the session

            Log::debug('Login successful', [
                'user_id' => Auth::id(),
                'username' => Auth::user()->username,
                'session_id' => session()->getId(),
                'auth_check_after' => Auth::check(),
                'session_keys' => array_keys(session()->all())
            ]);

            return redirect()->intended(route('playlists.index'))
                ->with('success', 'Welcome back!');
        }

        Log::debug('Login attempt failed', [
            'credentials' => $credentials,
            'user_exists' => User::where('username', $credentials['username'])->exists()
        ]);

        return back()->withErrors([
            'username' => 'Wrong username or password.',
        ])->onlyInput('username');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect(route('playlists.index'))
            ->with('success', 'Account created successfully! Welcome to ' . config('app.name'));
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'You have been logged out successfully.');
    }
}
