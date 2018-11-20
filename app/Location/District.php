<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	// protected $table = ['districts'];
    protected $fillable = ['id', 'regency_id', 'name'];
}
