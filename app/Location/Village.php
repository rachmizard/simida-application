<?php

namespace App\Location;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
	// protected $table = ['villages'];
    protected $table = 'villages';	
    protected $primaryKey = 'id_na';
    protected $fillable = ['district_id', 'name'];

    public function district()
    {
    	return $this->belongsTo(District::class, 'district_id', 'id_na');
    }
}
