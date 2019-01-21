<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Predikat extends Model
{
    protected $table = 'predikat';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    	'nilai_minimal',
		'nilai_maksimal',
		'keterangan'
    ];
}
