<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Carbon\Carbon;

class RiwayatSyariahPerSantriResource extends Resource
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
            'santri_id' => $this->santri['id'],
            'santri' => $this->santri['nama_santri'],
            'kelas' => $this->santri['kelas']['nama_kelas'],
            'asrama' => $this->santri['asrama']['ngaran']['nama'],
            'bulan' => Carbon::parse($this->tgl_pemasukan)->format('F'),
            'tgl_pemasukan' => Carbon::parse($this->tgl_pemasukan)->format('d-m-Y'),
            'jenis_pemasukan' => $this->jenis_pemasukan,
            'tgl_transaksi' => Carbon::parse($this->created_at)->format('d-m-Y H:i:s'),
            'nominal' => $this->jumlah_pemasukan
        ];
    }
}
