<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Tahfidz;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        if (!Tahfidz::where('id', $id)->first()) {
            return redirect($request->segment(1) . '/' . $request->segment(2));
        }
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'tahfidz' => Tahfidz::where('id', $id)->first(),
            'nilai' => Nilai::where('tahfidz_id', $id)->orderBy('created_at', 'asc')->get(),
        ];
        return view('v_nilai.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate(
            [
                'nama_tahfidz' => 'required|string|max:255',
                'nama_surat' => 'required|string|max:255',
                'total_ayat' => 'required|string',
                'juz' => 'required|string',
                'status' => 'required|string|in:0,1',
            ],
            [
                'nama_tahfidz.required' => 'Nama harus diisi.',
                'nama_surat.required' => 'Nama Surat harus diisi.',
                'total_ayat.required' => 'Total Ayat harus dipilih.',
                'juz.required' => 'Juz harus diisi.',
                'status.required' => 'Status harus diisi.',
            ],
        );

        $nilai = new Nilai();
        $nilai->nama_surat = $request->nama_surat;
        $nilai->total_ayat = $request->total_ayat;
        $nilai->juz = $request->juz;
        $nilai->tahfidz_id = $request->nama_tahfidz;
        $nilai->users_id = auth()->user()->id;
        $nilai->status = $request->status;
        $nilai->save();

        return redirect()->back()->with('success', 'Data Nilai berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */

    public function edit($id_tahfidz, $id_nilai)
    {
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'tahfidz' => Tahfidz::where('id', $id_tahfidz)->first(),
            'nilai' => Nilai::find($id_nilai),
        ];
        return view('v_nilai.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $request->validate(
            [
                'nama_tahfidz' => 'required|string|max:255',
                'nama_surat' => 'required|string|max:255',
                'total_ayat' => 'required|string',
                'juz' => 'required|string',
                'status' => 'required|string|in:0,1',
            ],
            [
                'nama_tahfidz.required' => 'Nama harus diisi.',
                'nama_surat.required' => 'Nama Surat harus diisi.',
                'total_ayat.required' => 'Total Ayat harus dipilih.',
                'juz.required' => 'Juz harus diisi.',
                'status.required' => 'Status harus diisi.',
            ],
        );

        $nilai = Nilai::findOrFail($id);
        $nilai->nama_surat = $request->nama_surat;
        $nilai->total_ayat = $request->total_ayat;
        $nilai->juz = $request->juz;
        $nilai->tahfidz_id = $request->nama_tahfidz;
        $nilai->users_id = auth()->user()->id;
        $nilai->status = $request->status;
        $nilai->save();

        return redirect()->back()->with('success', 'Data Nilai berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
