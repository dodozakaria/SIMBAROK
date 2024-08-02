<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use App\Models\Tahfidz;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahfidzController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $data = [
    //         'status_user' => User::where('status', '0')->get(),
    //         'rows' => Tahfidz::orderBy('id', 'desc')->get(),
    //     ];
    //     return view('v_tahfidz.index', $data);
    // }

    public function index($status = null)
    {
        // Query untuk mengambil data Tahfidz berdasarkan status
        if ($status === 'lulus') {
            $tahfidzQuery = Tahfidz::where('status', 'lulus');
        } elseif ($status === 'aktif') {
            $tahfidzQuery = Tahfidz::where('status', 'aktif');
        } else {
            $tahfidzQuery = Tahfidz::query();
        }

        // Dapatkan data Tahfidz dengan urutan terbaru
        // $tahfidz = $tahfidzQuery->orderBy('id', 'desc')->get();
        $tahfidz = $tahfidzQuery
            ->leftJoinSub(
                DB::table('nilai')
                    ->select('tahfidz_id', DB::raw('COUNT(DISTINCT juz) as total_juz'))
                    ->groupBy('tahfidz_id'),
                'nilai',
                'tahfidz.id',
                '=',
                'nilai.tahfidz_id'
            )
            ->select('tahfidz.*', 'nilai.total_juz')
            ->orderBy('tahfidz.id', 'desc')
            ->get();


        // Dapatkan data user dengan status 0
        $status_user = User::where('status', '0')->get();

        // Data yang akan dikirim ke view
        $data = [
            'status_user' => $status_user,
            'rows' => $tahfidz,
        ];

        return view('v_tahfidz.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:L,P',
                'kategori' => 'required|string|in:ANAK_PONDOK,TPQ',
                'status' => 'required|string|in:Aktif,Lulus',
                'tanggal_lahir' => 'required|date',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'no_telp' => 'required',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'alamat.required' => 'Alamat harus diisi.',
                'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih.',
                'kategori.required' => 'Kategori harus dipilih.',
                'status.required' => 'Status harus dipilih.',
                'tanggal_lahir.required' => 'Tanggal Lahir harus diisi.',
                'nama_ayah.required' => 'Nama Ayah harus diisi.',
                'nama_ibu.required' => 'Nama Ibu harus diisi.',
                'no_telp.required' => 'No Telp harus diisi.',
            ],
        );

        $yr = Carbon::now()->year;
        $mo = Carbon::now()->month;

        // Memformat bagian NIP
        $y2 = substr($yr, -2); // 2 digit terakhir tahun
        $y1 = substr($yr, 0, 2); // 2 digit pertama tahun
        $m = str_pad($mo, 2, '0', STR_PAD_LEFT); // bulan dengan 2 digit

        // Menghitung jumlah pengguna dengan peran "guru"
        $countTahfizh = Tahfidz::count();
        $seq = $countTahfizh + 1; // Urutan baru

        // Memformat 3 digit urutan
        $seqFormatted = str_pad($seq, 2, '0', STR_PAD_LEFT);

        // Membentuk NIS
        $nis = '1' . $y2 . $y1 . $m . $seqFormatted;
        $tahfidz = new Tahfidz();
        $tahfidz->nis = $nis;
        $tahfidz->nama = $request->name;
        $tahfidz->alamat = $request->alamat;
        $tahfidz->jenis_kelamin = $request->jenis_kelamin;
        $tahfidz->kategori = $request->kategori;
        $tahfidz->status = $request->status;
        $tahfidz->tgl_lahir = $request->tanggal_lahir;
        $tahfidz->nama_ayah = $request->nama_ayah;
        $tahfidz->nama_ibu = $request->nama_ibu;
        $tahfidz->no_telp = $request->no_telp;

        $tahfidz->save();

        return redirect()->back()->with('success', 'Data tahfidz berhasil dibuat.');
    }

    public function show(Request $request, $id)
    {
        if (!Tahfidz::where('id', $id)->first()) {
            return redirect($request->segment(1) . '/' . $request->segment(2));
        }

        $data = [
            'status_user' => User::where('status', '0')->get(),
            'tahfidz' => Tahfidz::where('id', $id)->first(),
            'nilai' => Nilai::where('tahfidz_id', $id)->orderBy('id', 'desc')->get(),
        ];
        return view('v_tahfidz.show', $data);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'edit' => Tahfidz::findOrFail($id),
        ];
        return view('v_tahfidz.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:L,P',
                'kategori' => 'required|string|in:ANAK_PONDOK,TPQ',
                'status' => 'required|string|in:Aktif,Lulus',
                'tanggal_lahir' => 'required|date',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'alamat.required' => 'Alamat harus diisi.',
                'jenis_kelamin.required' => 'Jenis Kelamin harus dipilih.',
                'tanggal_lahir.required' => 'Tanggal Lahir harus diisi.',
                'kategori.required' => 'Kategori harus dipilih.',
                'status.required' => 'Status harus dipilih.',
                'nama_ayah.required' => 'Nama Ayah harus diisi.',
                'nama_ibu.required' => 'Nama Ibu harus diisi.',
            ],
        );

        $tahfidz = Tahfidz::findOrFail($id);
        $tahfidz->nama = $request->name;
        $tahfidz->alamat = $request->alamat;
        $tahfidz->jenis_kelamin = $request->jenis_kelamin;
        $tahfidz->kategori = $request->kategori;
        $tahfidz->status = $request->status;
        $tahfidz->tgl_lahir = $request->tanggal_lahir;
        $tahfidz->nama_ayah = $request->nama_ayah;
        $tahfidz->nama_ibu = $request->nama_ibu;
        $tahfidz->save();

        return redirect($request->segment(1) . '/' . $request->segment(2))->with('success', 'Data tahfidz berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $tahfidz = Tahfidz::findOrFail($request->id);
        $tahfidz->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
