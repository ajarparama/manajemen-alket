<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Alket;
use App\Seksi;
use Carbon\Carbon;
use App\PPAT;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;

class AlketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        $alkets = Alket::with('seksi')->get();
        if ($request->ajax()) {
            $query = Alket::with('seksi')->selectRaw('distinct alket.*');
            return Datatables::of($query)
                ->addColumn('seksi', function (Alket $alket) {
                    return $alket->seksi->map(function($seks) {
                        return $seks->nama;
                    })->implode('<br>');
                })
                ->addColumn('action', function (Alket $alket) {
                return '<div class="btn-group"> <a href="' . route('alket.edit', $alket->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a> <button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModal-'.$alket->id.'"><i class="fa fa-trash"></i> Hapus</button>
                  </div>';
                })
                ->make(true);
        }
        return view('alket.index')->with(compact('alkets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $list_disposisi = Seksi::select('id', 'nama')->get();
        $list_disposisi2 = $list_disposisi->splice(3);
        $ppats = PPAT::pluck('nama');
        return view('alket.create')->with(compact('list_disposisi', 'list_disposisi2', 'ppats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'  => 'required',
            'npwp'  => 'required',
            'nilai_data'    => 'required',
            'jns_transaksi' => 'required',
            'tanggal'   => 'required',
            'sumber'    => 'required',
            'disposisi' => 'required'
            ]);
        $alket = new Alket;
        $alket->nama = $request->input('nama');
        $alket->npwp = $request->input('npwp');
        $alket->nilai_data = $request->input('nilai_data');
        $alket->jns_transaksi = $request->input('jns_transaksi');
        $alket->tanggal = $request->input('tanggal');
        $alket->sumber = $request->input('sumber');
        $alket->save();
        $disposisi = $request->get('disposisi');
        $alket->seksi()->attach($disposisi);

        return redirect()->route('alket.index');
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
        $alket = Alket::find($id);
        $list_disposisi = Seksi::select('id', 'nama')->get();
        $list_disposisi2 = $list_disposisi->splice(3);
        $alket_disposisi = $alket->seksi()->get()->toArray();
        $alket_disposisi = array_pluck($alket_disposisi, 'id');
        $ppats = PPAT::pluck('nama');
        return view('alket.edit')->with(compact('alket', 'list_disposisi', 'list_disposisi2', 'alket_disposisi', 'ppats'));
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
        $this->validate($request, [
            'nama'  => 'required',
            'npwp'  => 'required',
            'nilai_data'    => 'required',
            'jns_transaksi' => 'required',
            'tanggal'   => 'required',
            'sumber'    => 'required',
            'disposisi' => 'required'
            ]);
        $alket = Alket::find($id);
        $alket->nama = $request->input('nama');
        $alket->npwp = $request->input('npwp');
        $alket->nilai_data = $request->input('nilai_data');
        $alket->jns_transaksi = $request->input('jns_transaksi');
        $alket->tanggal = $request->input('tanggal');
        $alket->sumber = $request->input('sumber');
        $alket->save();
        $disposisi = $request->get('disposisi');
        $alket->seksi()->sync($disposisi);

        return redirect()->route('alket.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Alket::destroy($id)) return redirect()->back();

        return redirect()->route('alket.index');
    }
}
