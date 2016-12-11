<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WajibPajak extends Model
{
    // Define table name
    protected $table = 'wajib_pajak';

    // Mass assignment
    protected $fillable = ['npwp', 'nama', 'alamat', 'ar_nip'];

    // Relationships
    public function ar() {
    	return $this->belongsTo('App\AR');
    }
}
