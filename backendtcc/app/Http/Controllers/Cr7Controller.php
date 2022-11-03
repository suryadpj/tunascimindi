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
            leftJoin('customerdata','customerdata.no_polisi','cr7data.no_polisi')
            ->select('cr7data.*',DB::raw('DATE_FORMAT(cr7data.created_at,"%d %M %Y") as tglbuat'),'customerdata.nama_pelanggan','customerdata.vincode','customerdata.no_polisi as no_polisi2')
            ->where('cr7data.deleted','0')
            ->wherenotnull('customerdata.no_polisi'))
            ->filter(function ($data) use ($request) {
                if ($request->nopolisi) {
                    $data->where('cr7data.no_polisi', 'like', "%{$request->get('nopolisi')}%");
                }
                if ($request->keterangan) {
                    $data->where('keterangan', 'like', "%{$request->get('keterangan')}%");
                }
                if ($request->eta) {
                    $data->where('created_at', 'like', "%{$request->get('eta')}%");
                }
            })
            ->addColumn('keterangan', function($data) use($data_user){
                $kolom = "1 : ".$data->cr71;
                if($data->cr72 != "")
                {
                    $kolom .= "<br>2 : ".$data->cr72;
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
            ->rawColumns(['action','keterangan'])
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
