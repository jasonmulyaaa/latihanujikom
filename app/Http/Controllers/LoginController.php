<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('masyarakat')->check())
        {
            return abort(404);
        }
        return view('panel.index');
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',

        ]);

        if (Auth::guard('petugas')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Login Failed!');
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }

}
