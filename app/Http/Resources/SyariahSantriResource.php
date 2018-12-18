<?php

namespace App\Http\Resources;

use App\Pemasukan;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\Resource;

class SyariahSantriResource extends Resource
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
        $requestMonth = date('m', strtotime($request->bulan));
        $tgl = Carbon::parse($request->bulan)->format('Y-m-d');
        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'santri_id' => $this->id,
            'nama_santri' => $this->nama_santri,
            'kelas' => $this->kelas['nama_kelas'],
            'asrama' => $this->asrama['ngaran']['nama'],
            'status_pembayaran' => $this->statusPembayaran($this->id, $requestMonth),
            'bulan' => $tgl,
            'foto' => $this->foto
        ];
    }

    public function statusPembayaran($id, $requestMonth)
    {
        $validator = Pemasukan::whereSantriId($id)->whereJenisPemasukan('syariah')->whereMonth('tgl_pemasukan', $requestMonth)->first();
        if (count($validator) > 0) {
            return 'Sudah';
        }else{
            return 'Belum';
        }
    }
}
