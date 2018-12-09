<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    protected $table = 'jadwal_pelajaran';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'mata_pelajaran_id', 'hari', 'guru_id', 'kelas_id', 'semester_id', 'jam_masuk', 'jam_selesai', 'periode'
    ];

    public function matapelajaran()
    {
    	return $this->belongsTo('App\MataPelajaran', 'mata_pelajaran_id', 'id');
    }

    public function guru()
    {
    	return $this->belongsTo('App\Guru', 'guru_id', 'id');
    }

    public function kelas()
    {
    	return $this->belongsTo('App\Kelas', 'kelas_id', 'id');
    }

}
