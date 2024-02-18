<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'max:100'],
            'password' => ['required', 'max:100']
        ], [
            'username.max' => 'Username maximal 100 karakter',
            'password.max' => 'Username maximal 100 karakter',
            'username.required' => 'Username wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard-admin');
            } elseif (Auth::user()->role === 'member') {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard-member');
            } else {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard-librarian');
            }
        }

        return back()->with('loginFail', 'Password atau username salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('successLogout', 'Anda telah keluar!');
    }
}
