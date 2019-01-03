<?php

namespace App\Exports;

use App\MataPelajaran;
use App\Http\Resources\MataPelajaranResource;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class MataPelajaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function collection()
    {
        return MataPelajaranResource::collection(MataPelajaran::all());
    }

    public function headings(): array
    {
    	return [
    		'id',
    		'nama_mata_pelajaran', 
    		'tingkat'
    		// 'kelas', 
    	];
    }
}
