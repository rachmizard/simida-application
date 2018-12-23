<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GuruExportResource extends Resource
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
            'tingkat_id' => $this->tingkat['nama_tingkatan'],
            'nama_guru' => $this->nama_guru,
            'kelas_id' => $this->kelas['nama_kelas'] == null ? 'Kosong' : $this->kelas['nama_kelas']
        ];
    }
}
