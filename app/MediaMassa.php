<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MediaMassa extends Model
{
    // Define table name
    protected $table = 'media_massa';

    // Mass assignment
    protected $guard = [];

    public function setTglBeritaAttribute($value)
    {
        $this->attributes['tgl_berita'] = Carbon::createFromFormat('d/m/Y', $value);
    }
}
