<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TotalUang extends Model
{
    protected $table = 'total_uang';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'total_nominal', 'periode'
    ]; 
}
