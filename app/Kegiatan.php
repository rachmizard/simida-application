<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_kegiatan', 'mulai_kegiatan', 'akhir_kegiatan', 'periode', 'nilai_kegiatan'
    ];
}
