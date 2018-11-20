<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    protected $table = 'periode';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_periode', 'start_date', 'end_date', 'status',
    ];
}
