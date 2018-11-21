<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataNamaAsrama extends Model
{
    protected $table = 'data_nama_asrama';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_asrama', 'kategori'
    ];
}
