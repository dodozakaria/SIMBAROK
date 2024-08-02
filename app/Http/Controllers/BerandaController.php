<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Tahfidz;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BerandaController extends Controller
{

    private function getTahfidzData($orderDirection, $limit = 10)
    {
        return Tahfidz::select('tahfidz.*')
            ->selectSub(function ($query) {
                $query->selectRaw('COUNT(DISTINCT juz)')
                    ->from('nilai')
                    ->whereColumn('nilai.tahfidz_id', 'tahfidz.id');
            }, 'total_juz')
            ->selectSub(function ($query) {
                $query->selectRaw('GROUP_CONCAT(DISTINCT juz ORDER BY CAST(juz AS UNSIGNED) DESC SEPARATOR \', \')')
                    ->from('nilai')
                    ->whereColumn('nilai.tahfidz_id', 'tahfidz.id');
            }, 'juz_details')
            ->whereHas('nilai') // Ensure there are related nilai records
            ->orderBy('total_juz', $orderDirection) // Order by total_juz
            ->take($limit) // Limit the number of records
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->nama, // Assuming 'nama' is the field for name
                    'total_juz' => $item->total_juz,
                    'juz_details' => $item->juz_details, // Juz details as a comma-separated string
                ];
            });
    }

    private function getGroupedJuzData()
    {
        $start = 30;
        $end = 29;
        $ascending = range(1, $end); // Create an ascending range
        $customOrder = array_merge([$start], $ascending);

        // Fetch all tahfidz with their distinct juz
        $tahfidz = Tahfidz::select('tahfidz.id')
            ->selectSub(function ($query) {
                $query->selectRaw('GROUP_CONCAT(DISTINCT juz ORDER BY CAST(juz AS UNSIGNED) ASC SEPARATOR \', \')')
                    ->from('nilai')
                    ->whereColumn('nilai.tahfidz_id', 'tahfidz.id');
            }, 'juz_details')
            ->whereHas('nilai') // Ensure there are related nilai records
            ->get();

        // Initialize the grouped data array based on custom order
        $groupedData = array_fill_keys($customOrder, 0);

        foreach ($tahfidz as $item) {
            // Split juz details and filter based on custom order
            $juzArray = array_map('intval', explode(', ', $item->juz_details));
            $juzArray = array_intersect($customOrder, $juzArray); // Ensure only valid juz are included

            // Increment the count for the smallest juz in the array
            if (!empty($juzArray)) {
                $groupKey = min($juzArray); // Group by the smallest juz
                $groupedData[$groupKey]++;
            }
        }

        return $groupedData;
    }


    public function index()
    {
        $tahfidzSmallestResult = $this->getTahfidzData('asc');

        $tahfidzLargestResult = $this->getTahfidzData('desc');
        $getgroupedJuzData = $this->getGroupedJuzData();

        // Prepare data in the format required by the chart
        $groupedJuzData = [];
        foreach ($getgroupedJuzData as $juz => $count) {
            $groupedJuzData[] = [
                'category' => $juz,
                'count' => $count
            ];
        }

        $data = [
            'status_user' => User::where('status', '0')->get(),
            'admin' => User::where('roles', 'ADMIN')->count(),
            'guru' => User::where('roles', 'GURU')->where('status', '1')->count(),
            'operator' => User::where('roles', 'OPERATOR')->where('status', '1')->count(),
            'tahfidz' => Tahfidz::count(),
            'customDays' => 30,
            'activeStudents' => Tahfidz::where('status', 'Aktif')->count(),
            'graduatedStudents' => Tahfidz::where('status', 'Lulus')->count(),
            'tahfidzSmalles' => $tahfidzSmallestResult,
            'tahfidzLargest' => $tahfidzLargestResult,
            'groupedJuzData' => $groupedJuzData,

        ];
        return view('v_beranda.index', $data);
    }


    public function rejected(Request $request)
    {
        User::where('id', $request->user)->update([
            'status' => '0'
        ]);
        return redirect('/')->with('success', 'Berhasil Diajukan Kembali');
    }

    public function approved(Request $request)
    {
        User::where('id', $request->user)->update([
            'status' => '1'
        ]);
        return redirect()->back()->with('success', 'Berhasil disetujui');
    }

    public function unapproved(Request $request)
    {
        User::where('id', $request->user)->update([
            'status' => '2'
        ]);
        return redirect()->back()->with('success', 'Berhasil ditolak');
    }

    public function showChart()
    {
        $customDays = 30; // Misalnya, periode 30 hari
        $activeStudents = Tahfidz::where('status', 'Aktif')->count();
        $graduatedStudents = Tahfidz::where('status', 'Lulus')->count();

        // Kirim data ke tampilan
        return view('your-view', [
            'customDays' => $customDays,
            'activeStudents' => $activeStudents,
            'graduatedStudents' => $graduatedStudents,
        ]);
    }
}
