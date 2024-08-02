<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Nilai;
use App\Models\Tahfidz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PdfController extends Controller
{
    public function Tahfizd()
    {
        $now = Carbon::now();
        $data = [
            'status_user' => User::where('status', '0')->get(),
            'rows' => Tahfidz::orderBy('id', 'desc')->get(),
            'date' => $now->format('d F Y'),
        ];
        $fileName = "laporan_tahfidz_{$now->format('d_F_Y_H_i_s')}.pdf";
        $pdf = PDF::loadView('v_download_pdf.data-tahfidz-all', $data);
        return $pdf->download($fileName);
    }


    public function TahfizdById($id)
    {
        $now = Carbon::now();
        $tahfidz = Tahfidz::find($id);
        $data = [
            'tahfidz' => $tahfidz,
            'nilai' => Nilai::where('tahfidz_id', $id)->orderBy('id', 'desc')->get(),
            'date' => $now->format('d F Y'),
        ];
        $fileName = "laporan_nilai_{$tahfidz->nama}_{$now->format('d_F_Y_H_i_s')}.pdf";
        $pdf = PDF::loadView('v_download_pdf.data-tahfidz', $data);
        return $pdf->download($fileName);
    }

    public function Guru()
    {
        $now = Carbon::now();
        $data = [
            'rows' => User::where('roles', 'GURU')->get(),
            'date' => $now->format('d F Y'),
        ];
        $fileName = "laporan_guru_{$now->format('d_F_Y_H_i_s')}.pdf";
        $pdf = PDF::loadView('v_download_pdf.data-guru', $data);
        return $pdf->download($fileName);
    }

    public function Operator()
    {
        $now = Carbon::now();
        $data = [
            'rows' => User::where('roles', 'OPERATOR')->get(),
            'date' => $now->format('d F Y'),
        ];
        $fileName = "laporan_operator_{$now->format('d_F_Y_H_i_s')}.pdf";
        $pdf = PDF::loadView('v_download_pdf.data-operator', $data);
        return $pdf->download($fileName);
    }
    public function tahfizhBySearch(Request $request)
    {
        try {
            $data = $request->input('data');

            if (!is_array($data) || empty($data)) {
                return response()->json(['error' => 'Data tidak valid atau kosong'], 400);
            }

            $now = Carbon::now();
            $fileName = "laporan_tahfidz_{$now->format('d_F_Y_H_i_s')}.pdf";

            $pdf = PDF::loadView('v_download_pdf.data-tahfidz-all', ['rows' => $data]);

            // Mengirim file PDF sebagai respons
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan saat menghasilkan PDF.'], 500);
        }
    }
    public function tahfizhByNilai(Request $request)
    {
        try {
            $data = $request->input('data');

            if (!is_array($data) || empty($data)) {
                return response()->json(['error' => 'Data tidak valid atau kosong'], 400);
            }

            $start = 30;
            $end = 29;
            $ascending = range(1, $end);
            $customJuzOrder = array_merge([$start], $ascending);

            // Extract all 'nama' values from the input data
            $tahfizhNames = array_map(function ($item) {
                return $item['nama'];
            }, $data);

            // Fetch tahfizh records matching the names
            $tahfizhs = Tahfidz::whereIn('nama', $tahfizhNames)->get();

            // Fetch all nilai records for these tahfizh IDs
            $tahfizhIds = $tahfizhs->pluck('id')->toArray();
            $nilai = Nilai::whereIn('tahfidz_id', $tahfizhIds)->get();

            $customOrderMapping = array_flip($customJuzOrder);

            $filteredNilai = $nilai->filter(function ($item) use ($customOrderMapping) {
                return isset($customOrderMapping[$item->juz]);
            })->sortByDesc(function ($item) use ($customOrderMapping) {
                return $customOrderMapping[$item->juz];
            })->groupBy('tahfidz_id')->map(function ($group) {
                return $group->first();
            });

            // Fetch all user records based on users_id from nilai
            $userIds = $filteredNilai->pluck('users_id')->unique()->toArray();
            $users = User::whereIn('id', $userIds)->get()->keyBy('id');

            // Add tahfizh name and user name to the result
            $tahfizhData = $tahfizhs->keyBy('id')->toArray();
            $result = $filteredNilai->map(function ($item) use ($tahfizhData, $users) {
                $tahfizhName = isset($tahfizhData[$item->tahfidz_id]) ? $tahfizhData[$item->tahfidz_id]['nama'] : null;
                $userName = isset($users[$item->users_id]) ? $users[$item->users_id]['nama'] : null; // assuming column name is 'name'
                $gelar = isset($users[$item->users_id]) ? $users[$item->users_id]['gelar'] : null; // assuming column name is 'name'
                return array_merge($item->toArray(), [
                    'nama_tahfizh' => $tahfizhName,
                    'nama_user' => $userName,
                    'gelar' => $gelar
                ]);
            })->values()->toArray();

            // Log the result
            // Log::info('Data nilai dengan juz tertinggi:', $result);

            $now = Carbon::now();
            $fileName = "laporan_nilai_{$now->format('d_F_Y_H_i_s')}.pdf";

            $pdf = PDF::loadView('v_download_pdf.data-tahfidz-alll-by-nilai', ['rows' => $result, 'date' => $now]);

            // Mengirim file PDF sebagai respons
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            Log::error('Error generating PDF: ', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Terjadi kesalahan saat menghasilkan PDF.'], 500);
        }
    }
}
