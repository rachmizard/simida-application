<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'absen';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'santri_id', 'periode_id', 'semester_id', 'kelas_id', 'kegiatan_id', 'keterangan', 'type',
    ];

    public function santri()
    {
    	return $this->belongsTo(Santri::class, 'santri_id', 'nis');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'santri_id', 'id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function kegiatan()
    {
    	return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }
}
