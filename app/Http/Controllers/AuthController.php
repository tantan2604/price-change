<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('users.login');
    }

    public function getCredentials() {}

    public function dashboardForm()
    {
        $user = Auth::user();

        return view('dashboard.dashboard', compact('user'));
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'user_name' => $request->user_name,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()
                ->route('dashboard')
                ->with('success', 'Login successful!');
        }

        return back()
            ->with('login_error', 'Invalid username or password.')
            ->withInput();
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Logged out successfully.');
    }
}
