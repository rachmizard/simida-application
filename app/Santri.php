<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santri';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'nis', 'nik', 'nama_santri', 'tgl_lahir', 'jenis_kelamin', 'provinsi', 'kabupaten_kota', 'kecamatan', 'kelurahan', 'alamat', 'kode_pos', 'nama_ortu', 'nama_wali', 'no_telp', 'pendidikan_terakhir', 'asrama_id', 'kobong_id', 'tingkat_id', 'kelas_id', 'tgl_masuk', 'himpunan', 'dewan_id', 'pesantren_sebelumnya', 'foto', 'status'
    ];

    public function asrama()
    {
    	return $this->belongsTo(Asrama::class, 'asrama_id', 'id');
    }

    public function kobong()
    {
    	return $this->belongsTo(Kobong::class, 'kobong_id', 'id');
    }

    public function tingkat()
    {
    	return $this->belongsTo(Tingkat::class, 'tingkat_id', 'id');
    }

    public function kelas()
    {
    	return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function dewan()
    {
    	return $this->belongsTo(DewanKyai::class, 'dewan_id', 'id');
    }

    public function province()
    {
        return $this->belongsTo('\App\Location\Province', 'provinsi', 'id');
    }

    public function regency()
    {
        return $this->belongsTo('\App\Location\Regency', 'kabupaten_kota', 'id');
    }

    public function district()
    {
        return $this->belongsTo('\App\Location\District', 'kecamatan', 'id');
    }

    public function village()
    {
        return $this->belongsTo('\App\Location\Village', 'kelurahan', 'id');
    }
}
