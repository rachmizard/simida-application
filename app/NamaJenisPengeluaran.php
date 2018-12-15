<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NamaJenisPengeluaran extends Model
{
    protected $table = 'jenis_pengeluaran';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nama_jenis_pengeluaran'
    ];

    public function pengeluaran()
    {
    	$this->hasMany('App\NamaJenisPengeluaran', 'id');
    }
}
