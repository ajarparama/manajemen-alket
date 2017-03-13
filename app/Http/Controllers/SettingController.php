<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Seksi;
use App\User;
use App\Wilayah;
use DB;

class SettingController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$users = DB::table('users')
                    ->orderBy('seksi', 'desc')
                    ->paginate(20);
    	$seksi = Seksi::pluck('nama', 'id');
        $wilayahs = DB::table('wilayah_kpp')->get();
        return view('setting.index')->with(compact('seksi', 'users', 'wilayahs'));
    }

    public function daftar(Request $request)
    {
        $this->validate($request, [
            'nama'  => 'required|max:255',
            'nip'  => 'required|numeric|unique:users',
            'password' => 'required|min:5|confirmed',
            ]);
        $daftar = User::create([
            'nama' => $request->input('nama'),
            'nip' => $request->input('nip'),
            'userpic' => $request->input('userpic'),
            'seksi' => $request->input('seksi'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('setting');
    }

    public function editpegawai($id)
    {
        $user = User::find($id);
        $seksi = Seksi::pluck('nama', 'id');

        return view('setting.index');
    }

    public function updatepegawai(Request $request, $id)
    {
        $user = User::find($id);
        $user->nama = $request->input('nama');
        $user->nip = $request->input('nip');
        $user->userpic = $request->input('userpic');
        $user->seksi = $request->input('seksi');
        $user->save();

        return redirect()->route('setting');
    }

    public function hapuspegawai($id)
    {
        if(!User::destroy($id)) return redirect()->back();

        return redirect()->back();
    }

    public function tambahwilayah(Request $request)
    {
        $wilayah = DB::table('wilayah_kpp')->insert([
            'nama' => $request->input('nama_wilayah'),
        ]);

        return redirect()->back();
    }

    public function editwilayah($id)
    {
        $wilayah = DB::table('wilayah_kpp')
                        ->where('id', $id)
                        ->get();

        return view('setting.index');
    }

    public function updatewilayah(Request $request, $id)
    {
        $wilayah = DB::table('wilayah_kpp')
                        ->where('id', $id)
                        ->update([
                            'nama' => $request->input('nama_wilayah'),
        ]);

        return redirect()->back();
    }
}
