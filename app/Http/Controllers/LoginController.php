<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }

    public function login(Request $request){
        $validator = Validator::make($request -> all(),[
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Jika autentikasi berhasil
            session(['auth_login' => true]);
            $request->session()->regenerate();
    
            return redirect()->intended('/dashboard/admin');
        }

        // Jika autentikasi gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}

