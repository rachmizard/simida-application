<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriIzin extends Model
{    
    protected $table = 'history_izin';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'santri_id', 'tujuan', 'alasan', 'kategori', 'pemberi_izin', 'status'
    ];

    public function santri()
    {
    	return $this->belongsTo('App/Santri', 'santri_id', 'id');
    }

}
