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
<<<<<<< HEAD
    public $timestamps = false;
=======
    public $timestamps = true;
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    protected $fillable = [
        'santri_id', 'kegiatan_id', 'keterangan',
    ];

    public function santri()
    {
    	return $this->belongsTo(Santri::class, 'santri_id', 'nis');
    }

    public function kegiatan()
    {
    	return $this->belongsTo(Kegiatan::class, 'kegiatan_id', 'id');
    }
}
