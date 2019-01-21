<?php

namespace App\Http\Controllers;

use App\Semester;
use Yajra\Datatables\Datatables;
use App\Http\Resources\SemesterSelect2Resource;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pendidikan.semester.semester');
    }

    public function getSemesterDataTables(Datatables $datatables)
    {
        return $datatables->of(Semester::with('periode')->get())
                ->addColumn('action', function($var){
                    return '
                    <a href="#/aktifkan_semester/'. $var->id .'" class="btn btn-xs btn-info" title="Aktifkan semester"><i class="icon wb-check"></i></a>
                    <a href="#/edit/semester/'.$var->id.'" class="btn btn-xs btn-warning" title="Edit"><i class="icon wb-edit"></i></a>
                    <a href="#/hapus/semester/'. $var->id .'" class="btn btn-xs btn-danger" title="Hapus"><i class="icon wb-trash"></i></a>
                    ';
                })
                ->editColumn('status', function($btn){
                    if ($btn->status == 'aktif') {
                        return '<span class="badge badge-success">Aktif</span>';
                    }else if($btn->status == 'tidak_aktif'){
                        return '<span class="badge badge-dark">Tidak Aktif</span>';
                    }else{
                        return '<span class="badge badge-warning">Belum di set</span>';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
    }

    public function semesterSelect2()
    {
        return SemesterSelect2Resource::collection(Semester::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tingkat_semester' => 'required',
            'periode_id' => 'required',
        ]);

        $validator = Semester::where('tingkat_semester', $request->tingkat_semester)
                    ->where('periode_id', $request->periode_id)
                    ->count();
        if ($validator > 0) {
            $message = 'fail';
        }else{
            $semester = Semester::create([
                'tingkat_semester' => $request->tingkat_semester,
                'periode_id' => $request->periode_id,
                'status' => 'tidak_aktif'
            ]);

            $message = 'success';
        }

        return response()->json(['message' => $message]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Semester::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tingkat_semester' => 'required',
            'periode_id' => 'required',
        ]);

        $semester = Semester::find($id)->update([
            'tingkat_semester' => $request->tingkat_semester,
            'periode_id' => $request->periode_id,
            'status' => 'tidak_aktif'
        ]);

        return response()->json(['message' => 'success']);
    }

    public function statusActive($id)
    {
        $default = Semester::where('status', 'aktif')->update(['status' => 'tidak_aktif']);
        $setActive = Semester::find($id)->update(['status' => 'aktif']);
        return response()->json(['message' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $semester = Semester::find($id)->delete();

        return response()->json(['message' => 'success']);
    }
}
