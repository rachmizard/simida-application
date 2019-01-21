<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_mata_pelajaran', 'tingkat_id', 'bobot'
        // , 'kelas_id', 
    ];

    public function tingkat()
    {
    	return $this->belongsTo(Tingkat::class, 'tingkat_id', 'id');
    }

    // public function kelas()
    // {
    // 	return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    // }
}
