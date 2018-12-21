<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keamanan extends Model
{
    protected $table = 'keamanan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'santri_id', 'kategori', 'alasan', 'durasi', 'status', 'pemberi_izin', 'tgl_berakhir_izin'
    ];

    public function santri()
    {
    	return $this->belongsTo('App\Santri', 'santri_id', 'id');
    }
}
