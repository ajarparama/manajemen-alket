<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LapPPAT extends Model
{
    // Define table name
    protected $table = 'tabel_lapppat';

    // Mass assignment
    protected $fillable = ['no_surat', 'no_agenda', 'bulan', 'tahun', 'ppat_npwp', 'tgl_surat', 'tgl_terima', 'jml_data', 'nilai_data', 'jml_alket'];

    // Date
    protected $dates = ['tgl_surat', 'tgl_terima', 'created_at', 'updated_at'];

 	// Relationships
 	public function ppat() {
 		return $this->belongsTo('App\PPAT', 'ppat_npwp');
 	}

 	public function entry_lapppat() {
 		return $this->hasMany('App\EntryLapPPAT');
 	}

 	public function setTglSuratAttribute($value)
    {
        $this->attributes['tgl_surat'] = Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setTglTerimaAttribute($value)
    {
        $this->attributes['tgl_terima'] = Carbon::createFromFormat('d/m/Y', $value);
    }

}
