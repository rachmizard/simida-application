<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NilaiMingguan extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    	'santri_id',
    	'kelas_id',
    	'semester_id',
    	'periode_id',
    	'rata_rata',
    	'mata_pelajaran_id',
    ];

    public function santri()
    {
    	return $this->belongsTo(Santri::class, 'santri_id', 'id');
    }

    public function kelas()
    {
    	return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function semester()
    {
    	return $this->belongsTo(Semester::class, 'semester_id', 'id');
    }

    public function periode()
    {
    	return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }

    public function matapelajaran()
    {
    	return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }
}
