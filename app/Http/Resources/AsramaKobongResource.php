<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AsramaKobongResource extends Resource
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
            'asrama_id' => $this->asrama,
            'nama_kobong' => $this->nama_kobong,
            'roisam_kobong' => $this->roisam_kobong
        ];
    }
}
