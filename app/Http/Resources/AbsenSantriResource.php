<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\Resource;
use App\Absen;
use App\Kegiatan;

class AbsenSantriResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        $checkStatus = Absen::whereSantriId($this->id)->whereKegiatanId($request->kegiatan_id)->whereDate('created_at', \Carbon\Carbon::parse($request->created_at)->format('Y-m-d'))->count();
        if ($checkStatus > 0) {
            $status = 'sudah';
        }else{
            $status = 'belum';
        }
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'nama_santri' => $this->nama_santri,
            'kelas' => $this->kelas,
            'kegiatan' => $this->kegiatan($request->kegiatan_id),
            'keterangan' => $this->keterangan($this->id, $request->kegiatan_id, $request->created_at),
            'action' => $status
        ];
    }

    public function keterangan($santri_id, $kegiatan_id, $tglAbsensi)
    {
        return Absen::whereSantriId($santri_id)->whereKegiatanId($kegiatan_id)->whereDate('created_at', \Carbon\Carbon::parse($tglAbsensi)->format('Y-m-d'))->first();
    }

    public function kegiatan($id)
    {
        return Kegiatan::whereId($id)->first();
    }
}
