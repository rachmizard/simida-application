<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'tingkat_id', 'nama_guru', 'kelas_id',
    ];

    public function tingkat()
    {
    	return $this->belongsTo(Tingkat::class, 'tingkat_id', 'id');
    }

    public function kelas()
    {
    	return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

}
