<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntryLapPPAT extends Model
{
    // Define table name
    protected $table = 'entry_lapppat';

    // Mass assignment
    protected $fillable = ['no_surat', 'no_urut', 'no_akta', 'tgl_akta', 'btk_perbuatan', 'penjual_nama', 'penjual_alamat', 'penjual_npwp', 'penjual_ar', 'penerima_nama', 'penerima_alamat', 'penerima_npwp', 'penerima_ar', 'jenis_nomor', 'letak_tanah', 'luas_tanah', 'luas_bangunan', 'hrg_transaksi', 'nop', 'njop', 'tgl_ssp', 'nilai_ssp', 'tgl_ssb', 'nilai_ssb', 'keterangan', 'uraian', 'no_alket'];

 	// Relationships
 	public function lapppat() {
 		return $this->belongsTo('App\LapPPAT');
 	}

}
