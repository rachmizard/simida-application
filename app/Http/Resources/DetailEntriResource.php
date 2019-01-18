<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Carbon\Carbon;

class DetailEntriResource extends Resource
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
            'santri' => $this->santri,
            'kategori' => $this->kategori,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'tgl_berakhir_izin' => $this->status == 'belum_kembali' ? '' : $this->tgl_berakhir_izin,
            'status' => $this->status,
            'jam_berakhir' => $this->jam_berakhir,
        ];
    }
}
