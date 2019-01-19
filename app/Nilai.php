<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
    	// 
    ];
}
