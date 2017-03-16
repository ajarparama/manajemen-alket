<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PPAT;
use DB;

class PPATController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ppats = PPAT::all();
        return view('ppat.index')->with(compact('ppats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ppat = '';
        $kabupatens = DB::table('wilayah_kpp')->pluck('nama');

        return view('ppat.create')->with(compact('ppat', 'kabupatens'));
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
            'nama'      =>  'required|max:255',
            'npwp'      =>  'required',
            'email'     =>  'email',
            ]);
        $ppat = PPAT::create([
            'nama'      =>  $request->input('nama'),
            'npwp'      =>  $request->input('npwp'),
            'email'     =>  $request->input('email'),
            'no_hp'     =>  $request->input('no_hp'),
            'no_telp'   =>  $request->input('no_telp'),
            'alamat'    =>  $request->input('alamat'),
            'kabupaten' =>  $request->input('kabupaten'),
            ]);

        return redirect()->route('ppat.index');
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
    public function edit($npwp)
    {
        $ppat = PPAT::find($npwp);
        $kabupatens = DB::table('wilayah_kpp')->pluck('nama');

        return view('ppat.edit')->with(compact('ppat', 'kabupatens'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $npwp)
    {
        $ppat = PPAT::find($npwp);

        $ppat->nama = $request->input('nama');
        $ppat->npwp = $request->input('npwp');
        $ppat->email = $request->input('email');
        $ppat->no_hp = $request->input('no_hp');
        $ppat->no_telp = $request->input('no_telp');
        $ppat->alamat = $request->input('alamat');
        $ppat->kabupaten = $request->input('kabupaten');

        $ppat->save();

        return redirect()->route('ppat.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($npwp)
    {
        if(!PPAT::destroy($npwp)) return redirect()->back();

        return redirect()->back();
    }
}
