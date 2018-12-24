<?php

namespace App\Exports;

use App\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class JadwalKegiatanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {
        return Kegiatan::select(['id', 'nama_kegiatan', 'mulai_kegiatan', 'akhir_kegiatan', 'periode'])->get();
    }

    public function headings(): array
    {
    	return [
    		'id', 'nama_kegiatan', 'mulai_kegiatan', 'akhir_kegiatan', 'periode'
    	];
    }
}
