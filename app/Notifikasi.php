<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{    
    protected $table = 'notifikasi';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'judul', 'pesan', 'tipe', 'status', 'reminder', 'keamanan_id'
    ];

}
