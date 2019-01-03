<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'tgl_pemasukan', 'jenis_pemasukan', 'jumlah_pemasukan', 'santri_id', 'nama_donatur', 'metode_pembayaran', 'jumlah_tunggakan', 'status_tunggakan'
    ];

    public function santri()
    {
    	return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
}
