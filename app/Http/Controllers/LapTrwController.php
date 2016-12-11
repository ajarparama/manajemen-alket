<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LapPPAT;
use App\PPAT;
use App\AR;

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

        // $nama_bulan = array(
        //     '1'     => "Januari",
        //     '2'     => "Februari",
        //     '3'     => "Maret",
        //     '4'     => "April",
        //     '5'     => "Mei",
        //     '6'     => "Juni",
        //     '7'     => "Juli",
        //     '8'     => "Agustus",
        //     '9'     => "September",
        //     '10'    => "Oktober",
        //     '11'    => "November",
        //     '12'    => "Desember");

        // $trw =  array(  array( 'Ke' => "Triwulan 1", 
        //                       'Bulan' => array(1,2,3)
        //             ),
        //                 array( 'Ke' => "Triwulan 2", 
        //                       'Bulan' => array(4,5,6)
        //             ),
        //                 array( 'Ke' => "Triwulan 3", 
        //                       'Bulan' => array(7,8,9)
        //             ),
        //                 array( 'Ke' => "Triwulan 4", 
        //                       'Bulan' => array(10,11,12)
        //             )
        //     );

        // $trw_lalu   =   $trw[0]['Bulan'];
        // $trw_ini    =   $trw[1]['Bulan'];
        // $sd_trw_ini =   array_merge($trw_lalu, $trw_ini);

    	$ppatkobars	   = PPAT::with('lapppat', 'ar')->where('kabupaten', '=', 'Kotawaringin Barat')->get();
        $ppatlamandaus = PPAT::with('lapppat', 'ar')->where('kabupaten', '=', 'Lamandau')->get();
        $ppatsukamaras = PPAT::with('lapppat', 'ar')->where('kabupaten', '=', 'Sukamara')->get();
        $kobarjml34    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_lalu) {
                               $query->where('kabupaten', '=', 'Kotawaringin Barat');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_lalu); 
                           })->get();
        $kobarjml56    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_ini) {
                               $query->where('kabupaten', '=', 'Kotawaringin Barat');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_ini); 
                           })->get();
        $kobarjml78    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $sd_trw_ini) {
                               $query->where('kabupaten', '=', 'Kotawaringin Barat');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $sd_trw_ini); 
                           })->get();
        $sukamarajml34    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_lalu) {
                               $query->where('kabupaten', '=', 'Sukamara');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_lalu); 
                           })->get();
        $sukamarajml56    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_ini) {
                               $query->where('kabupaten', '=', 'Sukamara');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_ini); 
                           })->get();
        $sukamarajml78    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $sd_trw_ini) {
                               $query->where('kabupaten', '=', 'Sukamara');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $sd_trw_ini); 
                           })->get();
        $lamandaujml34    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_lalu) {
                               $query->where('kabupaten', '=', 'Lamandau');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_lalu); 
                           })->get();
        $lamandaujml56    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_ini) {
                               $query->where('kabupaten', '=', 'Lamandau');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_ini); 
                           })->get();
        $lamandaujml78    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $sd_trw_ini) {
                               $query->where('kabupaten', '=', 'Lamandau');
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $sd_trw_ini); 
                           })->get();
        $alljml34    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_lalu) {
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_lalu); 
                           })->get();
        $alljml56    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $trw_ini) {
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $trw_ini); 
                           })->get();
        $alljml78    = LapPPAT::whereHas('ppat', function($query) use ($tahun, $sd_trw_ini) {
                               $query->where('tahun', '=', $tahun);
                               $query->whereIn('bulan', $sd_trw_ini); 
                           })->get();


        // $jml_data_kobars    = PPAT::with('lapppat', 'ar')->where('kabupaten', '=', 'Kotawaringin Barat')->whereIn('bulan', [1, 2, 3])->get();

    	return view('laporan.triwulanan')->with(compact('nama_ttd', 'nip_ttd', 'tahun', 'triwulan', 'ppatkobars', 'kobarjml34', 'kobarjml56', 'kobarjml78', 'sukamarajml34', 'sukamarajml56', 'sukamarajml78', 'lamandaujml34', 'lamandaujml56', 'lamandaujml78', 'alljml34', 'alljml56', 'alljml78', 'ppatlamandaus', 'ppatsukamaras', 'trw', 'trw_lalu', 'trw_ini', 'sd_trw_ini'));
    }

}
