<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            return $this->authenticated($request, Auth::user());
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ]);

    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:siswa,pembimbing,mitra,mentor,admin',
            'email' => 'required|string|email|max:255|unique:users',
            'gender' => 'required|string',
            'city' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email' => $request->email,
            'gender' => $request->gender,
            'city' => $request->city,
        ]);

        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    protected function authenticated(Request $request, $user)

    {
        if ($user->role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role == 'siswa') {
            return redirect()->route('siswa.beranda');
        } elseif ($user->role == 'pembimbing') {
            return redirect()->route('pembimbing.home');
        } elseif ($user->role == 'mitra') {
            return redirect()->route('mitra.dashboard');
        } elseif ($user->role == 'mentor') {
            return redirect()->route('mentor.dashboard');
        }

        // Default redirect jika role tidak cocok
        return redirect('/');
    }
}
