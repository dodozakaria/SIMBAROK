<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CheckDefaultPassword
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user) { // Pastikan pengguna sudah login
            $defaultPasswordHash = Hash::make('Mubarok2024');

            if (Hash::check('Mubarok2024', $user->password)) {
                // Menyimpan data pengguna di sesi
                $request->session()->put('userData', [
                    'id' => $user->id,
                    'nama' => $user->nama,
                ]);

                // Menyimpan flag untuk menampilkan notifikasi
                $request->session()->flash('showPasswordResetNotification', true);
            }
        }

        return $next($request);
    }
}
