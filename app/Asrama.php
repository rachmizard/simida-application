<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    protected $table = 'asrama';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'kategori_asrama', 'nama_asrama', 'roisam_asrama',
    ];
}
