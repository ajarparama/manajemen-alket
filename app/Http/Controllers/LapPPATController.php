<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\LapPPAT;
use App\PPAT;

class LapPPATController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nama_bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November","Desember");

        $lapppats   = LapPPAT::paginate(10);
        $lap = LapPPAT::select('no_surat');
        return view('lapppat.index')->with(compact('lapppats', 'nama_bulan', 'lap'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $ppats = PPAT::pluck('nama', 'npwp');
        $tgl_surat_old = "";
        $tgl_terima_old = "";
        $nilai_data_old = "";

        return view('lapppat.create')->with(compact('ppats', 'nama_bulan', 'tgl_surat_old', 'tgl_terima_old', 'nilai_data_old'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['no_surat' => 'required', 'no_agenda' => 'required', 'bulan' => 'required', 'tahun' => 'required', 'ppat_npwp' => 'required', 'tgl_surat' => 'required|date_format:d/m/Y', 'tgl_terima' => 'required|date_format:d/m/Y', 'jml_data' => 'required', 'nilai_data' => 'required', 'jml_alket' => 'required']);
        $lapppat = LapPPAT::create($request->all());

        return redirect()->route('lapppat.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $ppats = PPAT::pluck('nama', 'npwp');
        $lapppat = LapPPAT::find($id);

        $tgl_surat_awal = date("Y-m-d", strtotime(old( 'tgl_surat', $lapppat->tgl_surat )));
        $pisah = explode("-", $tgl_surat_awal);
        $tgl_surat_old = $pisah[2].$pisah[1].$pisah[0];

        $tgl_terima_awal = date("Y-m-d", strtotime(old( 'tgl_terima', $lapppat->tgl_terima )));
        $pisah = explode("-", $tgl_terima_awal);
        $tgl_terima_old = $pisah[2].$pisah[1].$pisah[0];

        $nilai_data_old = old( 'nilai_data', $lapppat->nilai_data );

        return view('lapppat.edit')->with(compact('lapppat', 'nama_bulan', 'ppats', 'tgl_surat_old', 'tgl_terima_old', 'nilai_data_old'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, ['no_surat' => 'required', 'no_agenda' => 'required', 'bulan' => 'required', 'tahun' => 'required', 'ppat_npwp' => 'required', 'tgl_surat' => 'required|date|After:1986-05-28', 'tgl_terima' => 'required|date|After:1986-05-28', 'jml_data' => 'required', 'nilai_data' => 'required', 'jml_alket' => 'required']);
        $lapppat = LapPPAT::find($id);
        $lapppat->update($request->all());

        return redirect()->route('lapppat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!LapPPAT::destroy($id)) return redirect()->back();

        return redirect()->route('lapppat.index');
    }
}
