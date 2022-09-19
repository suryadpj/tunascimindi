<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\cr7;
use App\Imports\Cr7Data;

class Cr7Controller extends Controller
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
            return datatables()->of(cr7::
            leftJoin('users','users.id','cr7data.IDUser')
            ->select('cr7data.*',DB::raw('DATE_FORMAT(cr7data.eta,"%d %M %Y") as tglbuat'),'users.name')
            ->where('cr7data.deleted','0'))
            ->filter(function ($data) use ($request) {
                if ($request->nopolisi) {
                    $data->where('no_polisi', 'like', "%{$request->get('nopolisi')}%");
                }
                if ($request->keterangan) {
                    $data->where('keterangan', 'like', "%{$request->get('keterangan')}%");
                }
                if ($request->statuspart) {
                    $data->where('status_part', 'like', "%{$request->get('statuspart')}%");
                }
                if ($request->eta) {
                    $data->where('eta', 'like', "%{$request->get('eta')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                switch($data->status_part)
                {
                    case 1 : $statuspart = "Order"; break;
                    case 2 : $statuspart = "Part partial"; break;
                    case 3 : $statuspart = "Part ready"; break;
                    default : $statuspart = '-';
                }
                $kolom = $statuspart;
                $kolom .= "<br>";
                if($data->eta)
                {
                    $kolom .= "Estimasi : ".$data->tglbuat;
                }
                return $kolom;
            })
            // ->addColumn('kolom_ketiga', function($data) use($data_user){
            //     $kolom = "km : ".$data->kilometer;
            //     $kolom .= "<br>";
            //     $kolom .= "Job : ".$data->lookup_job;
            //     $kolom .= "<br>";
            //     $kolom .= "Ops Desc : ".$data->operation_desc;
            //     return $kolom;
            // })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua'])
            ->make(true);
        }
        return view('cr7.cr7',['user' => $data_user]);
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
        Excel::import(new Cr7Data, $request->file('file')->store('temp'));
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
        //
    }
}
