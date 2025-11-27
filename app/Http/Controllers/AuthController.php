<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'role' => 'required|in:siswa,guru',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|accepted'
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        
        // Set welcome notification for new user
        $roleNames = [
            'guru' => 'Guru/Pembina',
            'siswa' => 'Siswa'
        ];
        
        session()->flash('welcome', [
            'name' => $user->nama,
            'role' => $roleNames[$user->role] ?? ucfirst($user->role),
            'new_user' => true
        ]);

        return redirect()->route('dashboard');
    }

   public function login(Request $request)
{
    $credentials = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        
        // Set welcome notification
        $user = Auth::user();
        $roleNames = [
            'admin' => 'Administrator',
            'guru' => 'Guru/Pembina',
            'siswa' => 'Siswa'
        ];
        
        session()->flash('welcome', [
            'name' => $user->nama,
            'role' => $roleNames[$user->role] ?? ucfirst($user->role)
        ]);
        
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'username' => 'Username atau password salah.',
    ]);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}