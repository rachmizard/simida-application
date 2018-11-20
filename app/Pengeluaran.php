<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'tgl_pengeluaran', 'jenis_pengeluaran', 'jumlah_pengeluaran', 'total_pengeluaran',
    ];
}
