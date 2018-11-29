<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SantriResource extends Resource
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
          'nis' =>  $this->nis,
          'nik' =>  $this->nik,
          'nama_santri' =>  $this->nama_santri,
          'tgl_lahir' =>  $this->tgl_lahir,
          'jenis_kelamin' => $this->jenis_kelamin,
          'provinsi' =>  $this->provinsi,
          'kabupaten_kota' =>  $this->kabupaten_kota,
          'kecamatan' =>  $this->kecamatan,
          'kelurahan' =>  $this->kelurahan,
          'alamat' =>  $this->alamat,
          'kode_pos' =>  $this->kode_pos,
          'nama_ortu' =>  $this->nama_ortu,
          'nama_wali' =>  $this->nama_wali,
          'no_telp' =>  $this->no_telp,
          'pendidikan_terakhir' => $this->pendidikan_terakhir,
          'asrama_id' =>  $this->asrama->ngaran,
          'kobong_id' =>  $this->kobong($this->kobong_id),
          'tingkat_id' =>  $this->tingkat,
          'kelas_id' =>  $this->kelas($this->kelas_id),
          'tgl_masuk' =>  $this->tgl_masuk,
          'himpunan' =>  $this->himpunan,
          'dewan_id' =>  $this->dewan_id,
          'pesantren_sebelumnya' =>  $this->pesantren_sebelumnya,
          'foto' =>  $this->foto,
          'created_at' =>  $this->created_at,
          'updated_at' =>  $this->updated_at,
        ];
    }

    public function kobong($id)
    {
        return \App\Kobong::with('asrama.ngaran')->find($id);
    }

    public function kelas($id)
    {
        return \App\Kelas::with('tingkatKelas')->find($id);
    }
}

