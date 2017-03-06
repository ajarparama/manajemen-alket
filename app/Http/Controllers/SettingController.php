<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Seksi;
use App\User;
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
        return view('setting.index')->with(compact('seksi', 'users'));
    }
}
