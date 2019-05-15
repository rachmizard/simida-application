<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UangPendaftaran extends Model
{
    protected $table = 'uang_pendaftaran';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'santri_id', 'nominal'
    ];

    public function santri()
    {
    	return $this->belongsTo('App\Santri', 'santri_id', 'id');
    }
}
