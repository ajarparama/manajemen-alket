<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\MediaMassa;
use App\User;
use DB;
use Auth;

class MediaMassaController extends Controller
{
    /**
     * Display a listing of the resource.
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
        $beritas = DB::table('media_massa')
                    ->orderBy('created_at', 'desc')
                    ->paginate(3);
        $pengirim = User::pluck('nama', 'nip');

        return view('mediamassa.index')->with(compact('beritas', 'nama_bulan', 'pengirim'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $file_old = "";
        $deskripsi_old = "";
        $tgl_berita_old = "";
        return view('mediamassa.create', compact('tgl_berita_old', 'file_old', 'deskripsi_old'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // $data = $request->deskripsi;
        // $img_url = "berita-".time().".jpg";
        // $path = public_path()."css/".$img_url;
        // $image = $data['base64_image'];
        // $image = substr($image, strpos($image, ",")+1);
        // $data = base64_decode($image);
        // $success = file_put_contents($path, $data);

        // $deskripsi = $request->all();
        // dd($deskripsi);
        // $dom = new \DOMDocument();
        // $dom->loadHtml($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        // $images = $dom->getElementsByTagName('img');

        // foreach($images as $img){
        //     return $img;
        //         $img_url = "berita-".time().".jpg";
        //         $path = public_path()."css/".$img_url;
        //     $src =  $deskripsi['base64_image'];
        //     $src = substr($src, strpos($src, ",")+1);

        //         $data = base64_decode($src);
        //         $success = file_put_contents($path, $data);

        //         $new_src = asset($path);
        //         $img->removeAttribute('src');
        //         $img->setAttribute('src', $new_src);
        //     }

        $berita = new MediaMassa();

            $media = $request->file;
            // mengambil extension file
            $extension = $media->getClientOriginalExtension();
            // membuat nama file random berikut extension
            $text = $request->judul;
            $text = strtolower(htmlentities($text)); 
            $text = str_replace(get_html_translation_table(), "-", $text);
            $text = str_replace(" ", "-", $text);
            $text = preg_replace("/[-]+/i", "-", $text);
            $filename = $text.'-'.time() . '.' . $extension;
            // menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'mediamassa'; $media->move($destinationPath, $filename);
            // mengisi field cover di book dengan filename yang baru dibuat
            $berita->judul = $request->judul;
            $berita->nota_dinas = $request->nota_dinas;
            $berita->sumber = $request->sumber;
            $berita->tgl_berita = $request->tgl_berita;
            $berita->file = $filename;
            $berita->deskripsi = $request->deskripsi;
            $berita->pengirim = Auth::user()->nip;
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
        $mediamassa = MediaMassa::find($id);
        $file_old = old( 'file', $mediamassa->file );
        $deskripsi_old = old( 'deskripsi', $mediamassa->deskripsi );
        $tgl_berita_old = old( 'tgl_berita', $mediamassa->tgl_berita );

        return view('mediamassa.edit')->with(compact('mediamassa', 'tgl_berita_old', 'file_old', 'deskripsi_old'));
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
        $mediamassa = MediaMassa::find($id);
        $mediamassa->update($request->all());

        return redirect()->route('mediamassa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!MediaMassa::destroy($id)) return redirect()->back();

        return redirect()->route('mediamassa.index');
    }
}
