<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\customer;
use App\Models\kritiksaran;

use Illuminate\Http\Request;

class KritikSaranController extends Controller
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
            return datatables()->of(kritiksaran::
            leftJoin('users','users.id','kritiksaran.IDUser')
            ->select('kritiksaran.*',DB::raw('DATE_FORMAT(kritiksaran.created_at,"%d %M %Y") as tglbuat'),'name'))
            ->filter(function ($data) use ($request) {
                // if ($request->nomorrangka) {
                //     $data->where('nomor_rangka', 'like', "%{$request->get('nomorangka')}%");
                // }
                if ($request->namapelanggan) {
                    $data->where('users.name', 'like', "%{$request->get('namapelanggan')}%");
                }
                if ($request->tanggalreservasi) {
                    $data->where('kritiksaran.created_at', 'like', "%{$request->get('tanggalreservasi')}%");
                }
            })
            ->addColumn('kolom_kelima', function($data) use($data_user){
                switch($data->status)
                {
                    case 1 :  return "Menunggu respon"; break;
                    case 2 :  return "Dihubungi"; break;
                    case 3 :  return "Done"; break;
                    case 4 :  return "Cancel"; break;
                    default : return "-";
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat','kolom_kelima'])
            ->make(true);
        }
        return view('kritik_saran.kritiksaran',['user' => $data_user]);
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
        //
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
