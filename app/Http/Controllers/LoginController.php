<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        // dd($request->all());
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $intendedUrl = session()->pull('url.intended', '/');
            return redirect()->intended($intendedUrl);
        }

        return back()->with('loginError', 'Email atau Password salah!');
    }

    public function logout()
    {
        session(['url.intended' => url()->previous()]);
        
        Auth::logout();

        session()->invalidate();
 
        session()->regenerateToken();
 
        return redirect('/flogin');
    }
}
