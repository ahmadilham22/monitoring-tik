<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use SSO\SSO;

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

    public function ssoLogin(){
        SSO::cookieClear();
        SSO::ciCookieClear();
        \Session::flush();
        Auth::logout();
        if(SSO::authenticate()) //mengecek apakah user telah login atau belum
        {
            if(SSO::check()) {
                $check =  \App\Models\DataMaster\User::where('email', SSO::getUser()->email)->first(); //mengecek apakah pengguna SSO memiliki username yang sama dengan database aplikasi
                if(!is_null($check)) {
                    Auth::loginUsingId($check->id); //mengotentikasi pengguna aplikasi
                    session()->flash('success', 'Berhasil Login!');
                    return redirect()->route('home');
                } else {
                    return redirect()->route('signin')->with('error', 'Data pengguna tidak ditemukan, silahkan hubungi administrator.'); //mengarahkan ke halaman login jika pengguna gagal diotentikasi oleh aplikasi
                }
            }
        } else {
            return redirect()->route('logout'); //me-*redirect* user jika otentikasi SSO gagal, diarahkan untuk mengakhiri sesi login (jika ada)
        }
    }

    public function logout()
    {
        if(Auth::check()) { //mengecek otentikasi pada aplikasi
            SSO::cookieClear(); //If destroy cookie laravel
            SSO::ciCookieClear(); //If destroy cookie codeigniter4
            \Session::flush(); //Destroy Session
            Auth::logout(); //Destroy Auth
            return redirect()->route('signin')->with('success', 'Berhasil logout'); //Redirect to login page
        } else {
            return redirect('login'); //menampilkan halaman login
        }
    }
}
