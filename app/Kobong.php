<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kobong extends Model
{
    protected $table = 'kobong';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'asrama_id', 'nama_kobong', 'roisam_kobong',
    ];

    public function asrama()
    {
    	return $this->belongsTo(Asrama::class, 'asrama_id', 'id');
    }
}
