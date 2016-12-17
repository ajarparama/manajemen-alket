<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MediaMassa;

class MediaMassaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mediamassa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tgl_berita_old = "";
        return view('mediamassa.create', compact('tgl_berita_old'));
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
            'judul'  => 'required',
            'nota_dinas'  => 'required',
            'sumber'    => 'required',
            'tgl_berita' => 'required',
            'deskripsi' => 'required',
            ]);

        $deskripsi = $request->deskripsi;
        $dom = new \DOMDocument();
        $dom->loadHtml($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $img){
            $src = $img->getAttribute('src');
            if(preg_match('data:image/', $src)){
                // get the mimetype
                preg_match('data:image\/(?.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                $filename = uniqid();
                $filepath = ("img/$filename.$mimetype");

                $image = Image::make($src)
                    ->encode($mimetype, 100)
                    ->save(public_path($filepath));

                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            }
        }

        $berita = new MediaMassa();

        $berita->judul = $request->judul;
        $berita->nota_dinas = $request->nota_dinas;
        $berita->sumber = $request->sumber;
        $berita->tgl_berita = $request->tgl_berita;
        $berita->deskripsi = $dom->saveHTML();

        $berita->save();
        return redirect()->route('mediamassa.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
