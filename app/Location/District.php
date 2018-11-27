<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	// protected $table = ['districts'];
    protected $table = 'districts';	
    protected $fillable = ['id', 'regency_id', 'name'];

    public function regency()
    {
    	return $this->belongsTo(Regency::class, 'regency_id', 'id');
    }

    public function village()
    {
    	return $this->hasMany(Village::class, 'id');
    }
}
