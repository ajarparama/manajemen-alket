<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    // Define table name
    protected $table = 'tabel_seksi';

    // Mass assignment
    protected $fillable = ['nama'];

    // Relationships

    public function alket() {
    	return $this->belongsToMany('App\Alket', 'disposisi', 'seksi_id', 'alket_id')->withTimestamps();
    }

    public function anggota() {
    	return $this->hasMany('App\User', 'seksi');
    }

}
