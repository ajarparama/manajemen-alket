<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PPAT extends Model
{
    // Define table name
    protected $table = 'tabel_ppat';

    protected $primaryKey = 'npwp';
    public $incrementing = false;

    // Mass assignment
    protected $fillable = ['nama', 'npwp', 'alamat', 'no_telp', 'alamat', 'ar_nip'];

    // Relationships
    public function lapppat() {
    	return $this->hasMany('App\LapPPAT', 'ppat_npwp');
    }

    public function ar() {
    	return $this->belongsTo('App\AR', 'ar_nip');
    }
}
