<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
	// protected $table = ['regencies'];
    protected $fillable = ['id', 'province_id', 'name'];
}
