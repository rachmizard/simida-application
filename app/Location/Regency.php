<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
	// protected $table = ['regencies'];
    protected $table = 'regencies';
    protected $fillable = ['id', 'province_id', 'name'];

    public function province()
    {
    	return $this->belongsTo(Province::class, 'province_id', 'id');
    }
}
