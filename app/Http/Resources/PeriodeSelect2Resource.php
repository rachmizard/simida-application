<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PeriodeSelect2Resource extends Resource
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
            'text' => $this->nama_periode
        ];
    }
}
