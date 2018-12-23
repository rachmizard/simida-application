<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class SantriYangBelumPunyaKelasResource extends Resource
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
            'nama_santri' => $this->nama_santri,
            'tgl_masuk' => Carbon::parse($this->tgl_masuk)->format('d F Y'),
            'status' => $this->status,
            'alamat' => $this->alamat,
        ];
    }
}
