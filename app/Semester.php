<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $table = 'semester';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'tingkat_semester', 'periode_id', 'status',
    ];

    public function periode()
    {
    	return $this->belongsTo('App\Periode', 'periode_id', 'id');
    }
}
