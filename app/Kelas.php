<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'kelas';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_kelas', 'tingkat_id', 'tingkat', 'lokal', 'jk', 'guru_id', 'badal_id'
    ];

    /**
     * Relationship model
     *
     */

    public function tingkatKelas()
    {
    	return $this->belongsTo(Tingkat::class, 'tingkat_id', 'id');
    }

    public function guru()
    {
    	return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    public function badal()
    {
        return $this->belongsTo(Guru::class, 'badal_id', 'id');
    }

}
