<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Santri;
use App\Semester;
use App\Periode;
use App\Tingkat;
use App\Kelas;
use App\MataPelajaran;

class NilaiExport implements FromView
{

	private $semester;

	private $periode;

	private $tingkat;

	private $kelas;

	public function __construct($semesterId, $periodeId, $tingkatId, $kelasId)
	{	
		$this->semester = $semesterId;
		$this->periode = $periodeId;
		$this->tingkat = $tingkatId;
		$this->kelas = $kelasId;
	}

    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {

        $semesters = Semester::orderBy('tingkat_semester', 'DESC')->get();

        $periodes = Periode::orderBy('nama_periode', 'ASC')->get();

        $tingkats = Tingkat::all();

        $kelass = Kelas::all();

        $mapelByTingkat = MataPelajaran::whereTingkatId($this->tingkat)->get();

        $total_bobot = MataPelajaran::whereTingkatId($this->tingkat)->sum('bobot');

        // recent search will be saved

        $semester = $this->semester;
        $periode = $this->periode;
        $tingkat = $this->tingkat;
        $kelas = $this->kelas;

        $santri = Santri::orderBy('nama_santri', 'ASC')->whereTingkatId($this->tingkat)
                        ->whereKelasId($this->kelas)
                        ->get();


        return view('pendidikan.nilai.export-nilai', compact('santri', 'semesters', 'periodes', 'tingkats', 'kelass', 'mapelByTingkat', 'semester', 'periode', 'tingkat', 'kelas', 'total_bobot'));
    }
}


