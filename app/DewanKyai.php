<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DewanKyai extends Model
{
    protected $table = 'dewan_kyai';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
<<<<<<< HEAD
        'nama_dewan_kyai', 'foto', 'status'
=======
        'nama_dewan_kyai', 'foto',
>>>>>>> 0f9c21bfdd5253e58bb2b1eccdf38268e8407c1c
    ];
}
