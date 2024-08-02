<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function profile()
    {
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'edit' => User::findOrFail(auth()->user()->id),
        ];
        return view('v_akun.profile', $data);
    }

    public function guru()
    {
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'rows' => User::where('roles', 'GURU')->get(),
            'countPan' => User::where('roles', 'GURU')->where('status', '0')->count(),
            'countApp' => User::where('roles', 'GURU')->where('status', '1')->count(),
            'countUn' => User::where('roles', 'GURU')->where('status', '2')->count(),
        ];
        return view('v_akun.guru.index', $data);
    }

    public function operator()
    {
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'rows' => User::where('roles', 'OPERATOR')->get(),
            'countPan' => User::where('roles', 'OPERATOR')->where('status', '0')->count(),
            'countApp' => User::where('roles', 'OPERATOR')->where('status', '1')->count(),
            'countUn' => User::where('roles', 'OPERATOR')->where('status', '2')->count(),
        ];
        return view('v_akun.operator.index', $data);
    }


    public function addAccount(Request $request)
    {



        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'roles' => 'required|string|in:OPERATOR,GURU,ADMIN',
                'gelar' => 'string|max:255',
                'password' => 'string|min:6',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'roles.required' => 'Peran harus dipilih.',
            ],
        );
        $user = new User();

        if ($request->roles == 'GURU') {
            $yr = Carbon::now()->year;
            $mo = Carbon::now()->month;

            // Memformat bagian NIP
            $y2 = substr($yr, -2); // 2 digit terakhir tahun
            $y1 = substr($yr, 0, 2); // 2 digit pertama tahun
            $m = str_pad($mo, 2, '0', STR_PAD_LEFT); // bulan dengan 2 digit

            // Menghitung jumlah pengguna dengan peran "guru"
            $countGuru = User::where('roles', 'guru')->count();
            $seq = $countGuru + 1; // Urutan baru

            // Memformat 3 digit urutan
            $seqFormatted = str_pad($seq, 2, '0', STR_PAD_LEFT);

            // Membentuk NIP
            $nip = '0' . $y2 . $y1 . $m . $seqFormatted;
            $user->nip = $nip;
        }

        $user->nama = $request->name;
        $user->email = $request->email;
        $user->roles = $request->roles;
        $user->gelar = $request->gelar;
        $user->status = $request->status;
        $user->password = Hash::make('Mubarok2024');
        $user->save();

        return redirect()->back()->with('success', 'Akun berhasil dibuat.');
    }

    public function editAccountGuru($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'edit' => $user,
        ];
        return view('v_akun.guru.edit', $data);
    }

    public function editAccountOperator($id)
    {
        $user = User::findOrFail($id);
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'edit' => $user,
        ];
        return view('v_akun.operator.edit', $data);
    }

    public function updateAccount(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                // 'roles' => 'required|string|in:OPERATOR,GURU,ADMIN',
                'password' => 'nullable|string|min:6',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'roles.required' => 'Peran harus dipilih.',
                'password.min' => 'Password minimal harus 6 karakter.',
            ],
        );

        if ($request->status != 1 || $request->status != 2 || $request->status != 0) {
            if ($request->status == 'Approved') {
                $status = '1';
            } elseif ($request->status == 'Panding') {
                $status = '0';
            } else {
                $status = '2';
            }
        }
        $user = User::findOrFail($id);
        $user->nama = $request->name;
        $user->email = $request->email;
        // $user->roles = $request->roles;
        $user->gelar = $request->gelar;
        $user->status = ($request->status == 1 || $request->status == 2 || $request->status == 0) ? $request->status : $status;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect($request->segment(1) . '/' . $request->segment(2))->with('success', 'Akun berhasil diperbarui.');
    }

    public function deleteAccount($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Akun berhasil dihapus.');
    }

    public function updateStatus(Request $request, $id)
    {
        $status = $request->input('status');
        $guru = User::find($id);
        if ($guru) {
            $guru->status = $status;
            $guru->save();
            return redirect()->back()->with('success', 'Status berhasil diubah');
        }
        return redirect()->back()->with('error', 'Guru tidak ditemukan');
    }

    public function ubahSandi(Request $request, $id)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = User::find($id);

        if (!$user || !Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }
}
