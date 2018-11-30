<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Tingkat;

class KelasResource extends Resource
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
            'nama_kelas' => $this->nama_kelas,
            'tingkat' => $this->tingkat,
            'lokal' => $this->lokal,
            'tingkat_id' => $this->tingkat($this->tingkat_id),
            'jk' => $this->jk,
            'guru_id' => $this->guru,
            'badal_id' => $this->badal,
        ];
    }

    public function tingkat($id)
    {
        return Tingkat::find($id);
    }
}
