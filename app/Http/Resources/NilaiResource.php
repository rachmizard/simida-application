<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Santri;

class NilaiResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'nama_santri' => $this->nama_santri,
            'kelas' => $this->kelas['nama_kelas'],
            'asrama' => $this->asrama['ngaran']['nama'],
            'status_nilai' => $this->status($this->id)
        ];
    }

    public function santri($id)
    {
        return Santri::find($id);
    }

    public function status($id)
    {
        // Check in nilai's table
        return 'Lotkin';
    }
}
