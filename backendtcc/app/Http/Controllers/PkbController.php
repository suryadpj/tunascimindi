<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\pkb;
use App\Imports\PkbData;

class PkbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            return datatables()->of(pkb::
            leftJoin('users','users.id','pkbdata.IDUser')
            ->select('pkbdata.*',DB::raw('DATE_FORMAT(pkbdata.pkb_date,"%d %M %Y") as tglbuat'),'users.name')
            ->where('pkbdata.deleted','0'))
            ->filter(function ($data) use ($request) {
                if ($request->nomorrangka) {
                    $data->where('nomor_rangka', 'like', "%{$request->get('nomorangka')}%");
                }
                if ($request->pkbdate) {
                    $data->where('pkb_date', 'like', "%{$request->get('pkbdate')}%");
                }
                if ($request->nomorkpb) {
                    $data->where('pkb_no', 'like', "%{$request->get('nomorkpb')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                $kolom = "nomor rangka : ".$data->nomor_rangka;
                $kolom .= "<br>";
                $kolom .= "nomor PKB : ".$data->pkb_no;
                return $kolom;
            })
            ->addColumn('kolom_ketiga', function($data) use($data_user){
                $kolom = "km : ".$data->kilometer;
                $kolom .= "<br>";
                $kolom .= "Job : ".$data->lookup_job;
                $kolom .= "<br>";
                $kolom .= "Ops Desc : ".$data->operation_desc;
                return $kolom;
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga'])
            ->make(true);
        }
        return view('pkb.pkb',['user' => $data_user]);
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
        Excel::import(new PkbData, $request->file('file')->store('temp'));
        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pkb::where('ID',$id)->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
