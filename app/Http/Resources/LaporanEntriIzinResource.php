<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LaporanEntriIzinResource extends Resource
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
            'nis' => $this->santri['nis'],
            'nama_santri' => $this->santri['nama_santri'],
            'tujuan' => $this->tujuan,
            'alasan' => $this->alasan,
            'status' => $this->status == 'belum_kembali' ? '<span class="badge badge-sm badge-danger">Belum Kembali</span>' : $this->status == 'sudah_kembali' ? '<span class="badge badge-sm badge-danger">Belum Kembali</span>' : '',
            'kategori' => $this->kategori == 'dekat' ? '<span class="badge badge-sm badge-info">Dekat</span>' : '<span class="badge badge-sm badge-danger">Jauh</span>',
            'created_at' => date('d-m-Y H:i:s', strtotime($this->created_at)),
            'tgl_berakhir_izin' => $this->tgl_berakhir_izin == null ? '-' : date('d-m-Y', strtotime($this->tgl_berakhir_izin))
        ];
    }
}
