<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
	// protected $table = ['villages'];
    protected $fillable = ['id', 'district_id', 'name'];
}
