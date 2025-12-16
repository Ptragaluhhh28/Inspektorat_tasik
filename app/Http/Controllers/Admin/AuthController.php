<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Guard untuk admin
    protected function guard()
    {
        return Auth::guard('admin');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        if ($this->guard()->check()) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
            'is_active' => true
        ];

        if ($this->guard()->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Update last login
            $this->guard()->user()->updateLastLogin();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'username' => ['Username atau password salah.'],
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $this->guard()->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login');
    }

    // Tampilkan halaman register (untuk development)
    public function showRegisterForm()
    {
        return view('admin.auth.register');
    }

    // Proses register (untuk development)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admin_users',
            'email' => 'required|string|email|max:255|unique:admin_users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = AdminUser::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->guard()->login($admin);

        return redirect()->route('admin.dashboard');
    }
}
