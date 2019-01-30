<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Santri;
use App\Nilai;
use App\MataPelajaran;


class NilaiResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $requestAll = $request->all();

        return [
            'id' => $this->id,
            'nis' => $this->nis,
            'nama_santri' => $this->nama_santri,
            'kelas' => $this->kelas['nama_kelas'],
            'kelas_id' => $this->kelas_id,
            'asrama' => $this->asrama['ngaran']['nama'],
            'status_nilai' => $this->status($this->id, $requestAll['kelas_id'], $requestAll['tingkat_id'], $requestAll['periode_id'], $requestAll['semester_id'])
        ];
    }

    public function santri($id)
    {
        return Santri::find($id);
    }

    public function status($id, $kelas_id, $tingkat_id, $periode_id, $semester_id)
    {
        // Check in nilai's table

        $results = 'Belum';

        $getAndCount = MataPelajaran::whereTingkatId($id)->count();

        $checkIfExist = Nilai::where('periode_id', $periode_id)
                            ->where('semester_id', $semester_id)
                            ->where('santri_id', $id)
                            // ->where('kelas_id', $kelas_id)
                            ->count();

        if ($checkIfExist > $getAndCount) {
            $results = 'Sudah';
        }

        return $results;
    }
}
