<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AR extends Model
{
    // Define table name
    protected $table = 'tabel_ar';

    protected $primaryKey = 'nip';
    public $incrementing = false;

    // Mass assignment
    protected $fillable = ['nama', 'seksi'];

    // Relationships
    public function ppat() {
    	return $this->hasMany('App\PPAT', 'ar_nip');
    }

    public function seksi() {
    	return $this->belongsTo('App\Seksi');
    }
}
