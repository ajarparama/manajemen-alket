<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LapPPAT;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama_bulan = array(
            '1'     => "Januari",
            '2'     => "Februari",
            '3'     => "Maret",
            '4'     => "April",
            '5'     => "Mei",
            '6'     => "Juni",
            '7'     => "Juli",
            '8'     => "Agustus",
            '9'     => "September",
            '10'    => "Oktober",
            '11'    => "November",
            '12'    => "Desember");

        // $jml_data = LapPPAT::select(DB::raw("SUM(jml_data) as data"))
        //     ->where('tahun', '=', '2016')
        //     ->orderBy('bulan')
        //     ->groupBy('bulan')
        //     ->get()->toArray();
        // $jml_data = array_column($jml_data, 'data');

        // $jml_data = DB::table('bulan')
        //     ->selectRaw('bulan.nama, sum(jml_data) as data')
        //     ->leftJoin('tabel_lapppat', 'bulan.id', '=', 'tabel_lapppat.bulan')
        //     ->groupBy('bulan.nama')
        //     ->orderBy('bulan.id')
        //     ->get();
        // return $jml_data;

        $chart_disposisi = DB::table('bulan')
            ->selectRaw("SUM(IFNULL(nilai_data,0)) AS nilai")
            ->leftJoin('alket', function($join) {
                $join->on(DB::raw("strftime('%m', alket.created_at)"), '=', 'bulan.no')
                     ->whereYear('alket.created_at', '=', date("Y"));
            })
            ->groupBy('bulan.id')
            ->orderBy('bulan.id')
            ->pluck('nilai');

        $chart_data = DB::table('bulan')
            ->selectRaw("SUM(IFNULL(jml_data,0)) AS data")
            ->leftJoin('tabel_lapppat', function($join) {
                $join->on('bulan.id', '=', 'tabel_lapppat.bulan')
                     ->where('tahun', '=', date("Y"));
            })
            ->groupBy('bulan.id')
            ->orderBy('bulan.id')
            ->pluck('data');


        $chart_alket = DB::table('bulan')
            ->selectRaw("SUM(IFNULL(jml_alket,0)) AS alket")
            ->leftJoin('tabel_lapppat', function($join) {
                $join->on('bulan.id', '=', 'tabel_lapppat.bulan')
                     ->where('tahun', '=', date("Y"));
            })
            ->groupBy('bulan.id')
            ->orderBy('bulan.id')
            ->pluck('alket');

        $widget_alket = DB::table('tabel_lapppat')
            ->where('tahun', '=', date("Y"))
            ->sum('jml_alket');

        $widget_nilai = DB::table('tabel_lapppat')
            ->where('tahun', '=', date("Y"))
            ->sum('nilai_data');
            
        $widget_lap = DB::table('tabel_lapppat')
            ->where('tahun', '=', date("Y"))
            ->count();

        return view('home')->with(compact('nama_bulan', 'widget_alket', 'widget_nilai', 'widget_lap'))->with('chart_data', json_encode($chart_data, JSON_NUMERIC_CHECK))->with('chart_alket', json_encode($chart_alket, JSON_NUMERIC_CHECK))->with('chart_disposisi', json_encode($chart_disposisi, JSON_NUMERIC_CHECK));
    }
}
