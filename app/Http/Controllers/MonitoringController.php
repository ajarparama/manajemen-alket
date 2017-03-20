<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PPAT;
use App\Http\Requests;

class MonitoringController extends Controller
{
    public function monppat(Request $request)
    {
    	$tahun = $request->get('tahun');
    	$ppats    = PPAT::with('lapppat')->orderBy('nama', 'asc')->get();

    	return view('ppat.monitoring')->with(compact('ppats', 'tahun'));
    }
}
