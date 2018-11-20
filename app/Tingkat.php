<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    protected $table = 'tingkat';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_tingkatan',
    ];
}
