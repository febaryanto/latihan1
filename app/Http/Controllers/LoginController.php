<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //login cek
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            //jika berhasil
            if (Auth::user()->role == 'admin') {
                return redirect('/');
            } else {
                return redirect('profile');
            }
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors([
            'email' => 'Account not found.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
