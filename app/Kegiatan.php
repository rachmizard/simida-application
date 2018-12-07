<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
<<<<<<< HEAD
        'nama_kegiatan', 'mulai_kegiatan', 'akhir_kegiatan', 'periode'
=======
        'nama_kegiatan', 'mulai_kegiatan', 'akhir_kegiatan',
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    ];
}
