<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('role:admin'); // Disesuaikan dengan nama di Kernel.php
    // }

    public function dashboard()
    {
        $data = [
            'message' => 'Selamat datang, Admin!',
            'users_count' => User::count(),
            'students_count' => User::where('role', 'siswa')->count(),
            'pembimbing_count' => User::where('role', 'pembimbing')->count(),
            'partners_count' => User::where('role', 'mitra')->count(),
            'mentors_count' => User::where('role', 'mentor')->count(),
        ];

        return view('admin.dashboard', compact('data'));
    }

    public function userManagement()
    {
        $users = User::paginate(2);
        return view('admin.users.index', compact('users'));
    }

    public function createUser()
    {
        return view('admin.users.create');
    }

    public function storeUser(UserRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('admin.users')->with('success', 'User berhasil ditambahkan');
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(UserRequest $request, User $user)
    {
        $validated = $request->validated();

        $user->update($validated);

        return redirect()->route('admin.users')->with('success', 'User berhasil diperbarui');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
}
