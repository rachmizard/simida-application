<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriIzin extends Model
{    
    protected $table = 'history_izin';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'kode_izin', 'santri_id', 'tujuan', 'alasan', 'kategori', 'pemberi_izin', 'status', 'tgl_berakhir_izin', 'keamanan_id', 'jam_berakhir'
    ];

    public function santri()
    {
    	return $this->belongsTo('App\Santri', 'santri_id', 'id');
    }

    public function keamanan()
    {
        return $this->belongsTo('App\Keamanan', 'keamanan_id', 'id');
    }

}
