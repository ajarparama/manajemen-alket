<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LapPPAT;
use App\PPAT;
use App\AR;
use DB;

class LapTrwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tahun = $request->get('tahun');
        $triwulan = $request->get('triwulan');
        $nama_ttd = $request->get('nama_ttd');
        $nip_ttd  = $request->get('nip_ttd');
        $array_settings = DB::table('setting')->pluck('value');

        if ($request->get('triwulan')==1) {
            $trw        = "TRIWULAN: I (SATU)";
            $trw_lalu   = [0];
            $trw_ini    = [1,2,3];
            $sd_trw_ini = [1,2,3];
        }

        else if ($request->get('triwulan')==2) {
            $trw        = "TRIWULAN: II (DUA)";
            $trw_lalu   = [1,2,3];
            $trw_ini    = [4,5,6];
            $sd_trw_ini = [1,2,3,4,5,6];
        }

        else if ($request->get('triwulan')==3) {
            $trw        = "TRIWULAN: III (TIGA)";
            $trw_lalu   = [4,5,6];
            $trw_ini    = [7,8,9];
            $sd_trw_ini = [1,2,3,4,5,6,7,8,9];
        }

        else if ($request->get('triwulan')==4) {
            $trw        = "TRIWULAN: IV (EMPAT)";
            $trw_lalu   = [7,8,9];
            $trw_ini    = [10,11,12];
            $sd_trw_ini = [1,2,3,4,5,6,7,8,9,10,11,12];
        }
        else {
            $trw_lalu   = [0];
            $trw_ini    = [0];
            $sd_trw_ini = [0];
        }

        $wilayahs = DB::table('wilayah_kpp')->pluck('nama')->toArray();

        for ($i = 0; $i < count($wilayahs); $i++){
          $ppats[$i]    = PPAT::with('lapppat')->where(function($query) use($wilayahs, $i) {
              $query->orWhere('kabupaten', 'like', $wilayahs[$i]);
          })->get();

        $trx_trw_lalus[$i] = LapPPAT::whereHas('ppat', function($query) use ($wilayahs, $i) {
                               $query->Where('kabupaten', 'like', $wilayahs[$i]);
                           })
          ->where('tahun', '=', $tahun)
          ->whereIn('bulan', $trw_lalu)
          ->get();
        $jml_trw_lalus[$i] = $trx_trw_lalus[$i]->sum('jml_data');
        $nilai_trw_lalus[$i] = $trx_trw_lalus[$i]->sum('nilai_data');
        $alket_trw_lalus[$i] = $trx_trw_lalus[$i]->sum('jml_alket');

        $trx_trw_inis[$i] = LapPPAT::whereHas('ppat', function($query) use ($wilayahs, $i) {
                               $query->Where('kabupaten', 'like', $wilayahs[$i]);
                           })
          ->where('tahun', '=', $tahun)
          ->whereIn('bulan', $trw_ini)
          ->get();
        $jml_trw_inis[$i] = $trx_trw_inis[$i]->sum('jml_data');
        $nilai_trw_inis[$i] = $trx_trw_inis[$i]->sum('nilai_data');
        $alket_trw_inis[$i] = $trx_trw_inis[$i]->sum('jml_alket');

        $trx_sd_trw_inis[$i] = LapPPAT::whereHas('ppat', function($query) use ($wilayahs, $i) {
                               $query->Where('kabupaten', 'like', $wilayahs[$i]);
                           })
          ->where('tahun', '=', $tahun)
          ->whereIn('bulan', $sd_trw_ini)
          ->get();
        $jml_sd_trw_inis[$i] = $trx_sd_trw_inis[$i]->sum('jml_data');
        $nilai_sd_trw_inis[$i] = $trx_sd_trw_inis[$i]->sum('nilai_data');
        $alket_sd_trw_inis[$i] = $trx_sd_trw_inis[$i]->sum('jml_alket');
        };

    	return view('laporan.triwulanan')->with(compact('wilayahs', 'ppats', 'jml_trw_lalus', 'jml_trw_inis', 'jml_sd_trw_inis', 'nilai_trw_lalus', 'nilai_trw_inis', 'nilai_sd_trw_inis', 'alket_trw_lalus', 'alket_trw_inis', 'alket_sd_trw_inis', 'nama_ttd', 'nip_ttd', 'tahun', 'triwulan', 'trw', 'trw_lalu', 'trw_ini', 'sd_trw_ini', 'array_settings'));
    }

}
