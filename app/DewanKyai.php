<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DewanKyai extends Model
{
    protected $table = 'dewan_kyai';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_dewan_kyai', 'foto', 'status'
    ];
}
