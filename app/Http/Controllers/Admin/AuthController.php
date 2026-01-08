<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

public function login(Request $request)
{
    $request->validate([
        'email' => [
            'required',
            'email:rfc,dns',
            function ($attribute, $value, $fail) {
                if (!str_ends_with(strtolower($value), '@gmail.com')) {
                    $fail('Login admin hanya untuk akun Gmail.');
                }
            }
        ],
        'password' => 'required'
    ]);

    if (Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {

        $user = Auth::user();

        if (!$user->is_active) {
            Auth::logout();
            return back()->withErrors([
                'email' => 'Akun ini belum disetujui oleh Super Admin.'
            ]);
        }

        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.'
    ]);
}



    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
