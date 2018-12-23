<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SantriExportResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'nis' => $this->nis, 
            'nik' => $this->nik, 
            'nama_santri' => $this->nama_santri, 
            'tgl_lahir' => $this->tgl_lahir, 
            'jenis_kelamin' => $this->jenis_kelamin, 
            'provinsi' => $this->province['name'], 
            'kabupaten_kota' => $this->regency['name'], 
            'kecamatan' => $this->district['name'], 
            'kelurahan' => $this->village['name'], 
            'alamat' => $this->alamat, 
            'kode_pos' => $this->kode_pos, 
            'nama_ortu' => $this->nama_ortu, 
            'nama_wali' => $this->nama_wali, 
            'no_telp' => $this->no_telp, 
            'pendidikan_terakhir' => $this->pendidikan_terakhir, 
            'asrama_id' => $this->asrama['ngaran']['nama'], 
            'kobong_id' => $this->kobong['nama_kobong'], 
            'tingkat_id' => $this->tingkat['nama_tingkatan'], 
            'kelas_id' => $this->kelas['nama_kelas'], 
            'tgl_masuk' => $this->tgl_masuk, 
            'himpunan' => $this->himpunan, 
        ];
    }
}
