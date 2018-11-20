<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'tgl_pemasukan', 'jenis_pemasukan', 'santri_id', 'nama_donatur',
    ];

    public function santri()
    {
    	return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }
}
