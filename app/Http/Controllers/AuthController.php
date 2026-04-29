<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // =====================
    // FORM LOGIN
    // =====================
    public function loginForm(){
        return view('auth.login');
    }

    // =====================
    // FORM REGISTER
    // =====================
    public function registerForm(){
        return view('auth.register');
    }

    // =====================
    // PROSES REGISTER
    // =====================
    public function register(Request $r){
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        User::create([
            'name' => $r->name,
            'email' => $r->email,
            'password' => Hash::make($r->password),
            'role' => 'siswa' // default siswa
        ]);

        return redirect('/')
            ->with('success','Akun berhasil dibuat, silakan login 🚀');
    }

    // =====================
    // PROSES LOGIN
    // =====================
    public function login(Request $r){

        $r->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($r->only('email','password'))){

            // regenerasi session (biar lebih aman)
            $r->session()->regenerate();

            // cek role
            if(auth()->user()->role == 'admin'){
                return redirect('/admin')
                    ->with('success','Login sebagai Admin berhasil 👨‍💼');
            }

            // siswa
            return redirect('/dashboard')
                ->with('success','Login berhasil 👋');
        }

        return back()->with('error','Email atau password salah ❌');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout(Request $r){
        Auth::logout();

        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect('/')
            ->with('success','Berhasil logout 👋');
    }
}