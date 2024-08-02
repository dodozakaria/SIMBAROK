<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ForgotPassword;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            if (auth()->user()->roles == 'ADMIN') {
                return redirect()->intended('/admin');
            } elseif (auth()->user()->roles == 'OPERATOR') {
                return redirect()->intended('/operator');
            } else {
                return redirect()->intended('/guru');
            }
        }
        return view('Auth.login');
    }

    public function register()
    {
        if (auth()->check()) {
            if (auth()->user()->roles == 'ADMIN') {
                return redirect()->intended('/admin');
            } elseif (auth()->user()->roles == 'OPERATOR') {
                return redirect()->intended('/operator');
            } else {
                return redirect()->intended('/guru');
            }
        }
        return view('Auth.register');
    }

    public function storeRegister(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'roles' => 'required|string|in:OPERATOR,GURU',
                'gelar' => 'string|max:255',
                'password' => 'required|string|min:6',
                'konfirmasi_password' => 'required|same:password',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'roles.required' => 'Peran harus dipilih.',
                'password.required' => 'Password harus diisi.',
                'password.min' => 'Password minimal harus 6 karakter.',
                'konfirmasi_password.same' => 'Konfirmasi password tidak cocok dengan password yang dimasukkan.',
            ],
        );

        $user = new User();
        $user->nama = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->gelar = $request->gelar;
        $user->status = '0';
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::login($user);
        if (auth()->check()) {
            if (auth()->user()->roles == 'OPERATOR') {
                return redirect()->intended('/operator');
            } elseif (auth()->user()->roles == 'GURU') {
                return redirect()->intended('/guru');
            }
        }
    }

    public function authentication(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->check()) {
                if (auth()->user()->roles == 'ADMIN') {
                    return redirect()->intended('/admin');
                } elseif (auth()->user()->roles == 'OPERATOR') {
                    return redirect()->intended('/operator');
                } else {
                    return redirect()->intended('/guru');
                }
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    public function forgotPassword()
    {
        return view('Auth.forgot_password');
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $users = User::where('email', $request->email)->first();
        if (!$users) {
            return redirect()->back()->with('error', 'email tidak terdaftar');
        }
        $email = ForgotPassword::where('email', $request->email)->first();
        if ($email) {
            return redirect()->back()->with('success', 'email sudah diajukan untuk direset silahkan tunggu admin mereset passwordnya.');
            $email->update([
                'email' => $request->email,
            ]);
        } else {
            ForgotPassword::create([
                'email' => $request->email,
            ]);
            return redirect()->back()->with('success', 'Permintaan reset password telah dikirim. Silakan konfirmasi dengan admin dan tunggu instruksi lebih lanjut.');
        }
    }
    public function resetApproved(Request $request)
    {
        $users = User::where('id', $request->user)->first();
        if (!$users) {
            return redirect()->back()->with('error', 'user tidak terdaftar');
        }
        $forgot = ForgotPassword::where('email', $users->email)->first();
        if ($forgot) {
            $users->update([
                'password' => Hash::make('Mubarok2024')
            ]);
            ForgotPassword::where('id', $forgot->id)->delete();
            return redirect()->back()->with('success', 'Password berhasil direset');
        } else {
            return redirect()->back()->with('error', 'terjadi kesalahan saat reset password.');
        }
    }
    public function resetUnapproved(Request $request)
    {
        $users = User::where('id', $request->user)->first();
        $forgot = ForgotPassword::where('email', $users->email)->first();
        ForgotPassword::where('id', $forgot->id)->delete();
        return redirect()->back()->with('success', 'Berhasil ditolak');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}
