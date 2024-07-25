<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AuthController extends Controller
{
    // Menampilkan form registrasi
    public function showRegisterForm()
    {
        return view('register.index');
    }


    // Proses registrasi user baru
    public function register(Request $request)
    {
        // Validasi input dari form registrasi
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'role' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required'
        ]);

        // Buat user baru
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);
                
        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login.index')->with('info','berhasil membuat akun');
    }


    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login.index', [
            'title' => 'iPusnas | Login'
        ]);
    }

    // Proses login user
    public function login(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Coba untuk melakukan proses autentikasi
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            // Jika autentikasi berhasil, arahkan sesuai peran pengguna
            if (Gate::allows('isAdmin')) {
                return redirect()->route('admin.dashboard');
            } elseif (Gate::allows('isAuthor')) {
                return redirect()->route('user.dashboard');
            } elseif (Gate::allows('isEditor')) {
                return redirect()->route('editor.dashboard');
            }
        }

        // Jika autentikasi gagal, kembali ke halaman login dengan pesan error
        // return back()->withErrors([
        //     'info' => 'Email atau Kata Sandi anda tidak terdaftar pada sistem kami ^_^',
        // ]);
        return back()->with('error', 'LOGIN GAGAL | Login Tidak Berhasil');
    }


        // Menampilkan dashboard
        public function dashboard()
        {
            return view('dashboard');
        }
    
        // Proses logout
        public function logout(Request $request)
        {
            // Auth::logout();
            // return redirect()->route('login');
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerate();
            return redirect('/login');
        }
}
