<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Alket extends Model
{
    // Define table name
    protected $table = 'alket';

    // Mass assignment
    protected $fillable = ['nama', 'npwp', 'nilai_data', 'jns_transaksi', 'tanggal', 'sumber'];

    // Relationships
    public function seksi() {
 		return $this->belongsToMany('App\Seksi', 'disposisi', 'alket_id', 'seksi_id')->withTimestamps();
 	}

 	// Mutators
 	public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::createFromFormat('d/m/Y', $value);
    }
}