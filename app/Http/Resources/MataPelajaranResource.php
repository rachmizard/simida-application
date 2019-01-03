<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MataPelajaranResource extends Resource
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
            'nama_mata_pelajaran' => $this->nama_mata_pelajaran, 
            'tingkat_id' => $this->tingkat['nama_tingkatan'], 
            // 'kelas_id' => $this->kelas['nama_kelas'], 
        ];
    }
}
