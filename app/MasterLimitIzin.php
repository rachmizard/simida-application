<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterLimitIzin extends Model
{
    protected $table = 'master_limit_izin';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'max_durasi', 'kategori_limit', 'status'
    ];
}
