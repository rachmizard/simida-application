<?php

namespace App\Exports;

use App\Santri;
use App\Http\Resources\SantriExportResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class SantriExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {
        return SantriExportResource::collection(Santri::select(['id',
								'nis',
								'nik',
								'nama_santri',
								'tgl_lahir',
								'jenis_kelamin',
								'provinsi',
								'kabupaten_kota',
								'kecamatan',
								'kelurahan',
								'alamat',
								'kode_pos',
								'nama_ortu',
								'nama_wali',
								'no_telp',
								'pendidikan_terakhir',
								'asrama_id',
								'kobong_id',
								'tingkat_id',
								'kelas_id',
								'tgl_masuk',
								'himpunan',
								])->get());
    }

    public function headings(): array
    {
    	return [
    		'ID',
        	'NIS', 
        	'NIK', 
        	'NAMA SANTRI', 
        	'TANGGAL LAHIR', 
        	'JENIS KELAMIN', 
        	'PROVINSI', 
        	'KABUPATEN', 
        	'KECAMATAN', 
        	'KELURAHAN', 
        	'ALAMAT', 
        	'KODE POS', 
        	'NAMA ORTU', 
        	'NAMA WALI', 
        	'NO TELP', 
        	'PENDIDIKAN TERAKHIR', 
        	'ASRAMA', 
        	'KOBONG', 
        	'TINGKAT', 
        	'KELAS', 
        	'TANGGAL MASUK', 
        	'HIMPUNAN'
    	];
    }
}
