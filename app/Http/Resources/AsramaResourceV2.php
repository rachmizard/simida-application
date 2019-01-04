<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AsramaResourceV2 extends Resource
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
            'asrama_id' => $this->id,
            'nama_asrama' => $this->ngaran['nama'], // relationship nanti;
            'kategori' => $this->kategori_asrama, // relationship nanti;
        ];
    }
}
