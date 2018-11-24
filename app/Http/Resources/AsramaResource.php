<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\DataNamaAsrama;

class AsramaResource extends Resource
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
            'nama_asrama' => $this->nama, // relationship nanti;
            'kategori' => $this->kategori, // relationship nanti;
        ];
    }
}
