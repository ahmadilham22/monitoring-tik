<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('home')->with('success', 'Berhasil Login');
        } else {
            return redirect()->back()->with('failed', 'Email atau Password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('signin')->with('success', 'Berhasil logout');
    }
}