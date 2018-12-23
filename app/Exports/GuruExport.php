<?php

namespace App\Exports;

use App\Guru;
use App\Http\Resources\GuruExportResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class GuruExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {
        return GuruExportResource::collection(Guru::select(['tingkat_id', 'nama_guru', 'kelas_id'])->get());
    }

    public function headings(): array
    {
    	return [
    		'TINGKAT', 
    		'NAMA GURU', 
    		'WALI KELAS'
    	];
    }

}
