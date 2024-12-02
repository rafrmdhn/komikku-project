<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Dapatkan user yang sedang login
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->hasRole('Admin')) {
                return redirect('/admin/dashboard');
            } elseif ($user->hasRole('Customer')) {
                return redirect('/');
            }

            // Default redirect jika tidak ada role
            return redirect('/')->with('error', 'Role tidak dikenali.');
        }

        return back()->with('loginError', 'Email atau Password salah!');
    }

    public function logout()
    {
        session(['url.intended' => url()->previous()]);
        
        Auth::logout();

        session()->invalidate();
 
        session()->regenerateToken();
 
        return redirect('/');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:dns',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $user->assignRole('Customer');

        Auth::login($user);

        return redirect('/')->with('status', 'Registrasi berhasil! Anda telah login.');
    }
}
