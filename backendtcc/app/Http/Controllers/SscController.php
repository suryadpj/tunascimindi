<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\customer;
use App\Models\sscdata;
use App\Imports\sscimport;

class SscController extends Controller
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
                return datatables()->of(customer::
                leftJoin('sscdata','sscdata.vincode','customerdata.vincode')
                ->select('sscdata.*',DB::raw('DATE_FORMAT(sscdata.created_at,"%d %M %Y") as tglbuat'),'customerdata.nama_pelanggan','customerdata.no_polisi','customerdata.phone1','customerdata.domisili','customerdata.unit','customerdata.membership')
                ->where('sscdata.deleted','0'))
                ->filter(function ($data) use ($request) {
                    if ($request->namapelanggan) {
                        $data->where('nama_pelanggan', 'like', "%{$request->get('namapelanggan')}%");
                    }
                    if ($request->nomorrangka) {
                        $data->where('vincode', 'like', "%{$request->get('nomorrangka')}%");
                    }
                    if ($request->nomorhp) {
                        $data->where('phone1', 'like', "%{$request->get('nomorhp')}%")->orWhere('phone2', 'like', "%{$request->get('nomorhp')}%");
                    }
                    if ($request->domisili) {
                        $data->where('domisili', 'like', "%{$request->get('domisili')}%");
                    }
                    if ($request->kendaraan) {
                        $data->where('unit', 'like', "%{$request->get('kendaraan')}%");
                    }
                    if ($request->membership) {
                        $data->where('membership', '=', $request->get('membership'));
                    }
                })
                ->addColumn('kolom_status', function($data) use($data_user){
                    switch($data->status)
                    {
                        case 0 : return "-"; break;
                        case 1 : return "Waiting"; break;
                        case 2 : return "Dalam Pekerjaan"; break;
                        case 3 : return "Done"; break;
                        case 4 : return "Cancel"; break;
                    }
                })
                ->addColumn('kolom_kedua', function($data) use($data_user){
                    $kolom = $data->phone1;
                    if($data->phone2 != 0)
                    {
                        $kolom .= "<br>";
                        $kolom .= $data->phone2;
                    }
                    return $kolom;
                })
                ->addColumn('action', function($data) use($data_user){
                    $button = '<div class="btn-group">';
                        $button .= '<button type="button" name="edit" id="'.$data->ID.'" class="edit btn btn-info btn-sm"><i title="Rubah Data" class="fas fa-pen-to-square"></i></button>';
                        $button .= '&nbsp';
                        $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Hapus Data" class="fas fa-trash"></i></button>';
                    return $button;})
                ->rawColumns(['action','kolom_kedua','kolom_status'])
                ->make(true);
        }
        return view('ssc.ssc',['user' => $data_user]);
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
        Excel::import(new sscimport, $request->file('file')->store('temp'));
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
        $data = DB::table('sscdata')->leftjoin('customerdata','customerdata.vincode','sscdata.vincode')->where('sscdata.ID',$id)->select('sscdata.*','customerdata.nama_pelanggan','customerdata.no_polisi')->first();
        return response()->json(['data' => $data]);
    }
    public function updatedata(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'vincode'         =>  'required',
            'no_polisi'       =>  'required',
            'ssc'             =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $shark = sscdata::find($request->hidden_id2);
        $shark->ssc       = $request->ssc;
        if(!empty($request->tanggal_ssc))
        {
            $shark->repair_date      = $request->tanggal_ssc;
        }
        $shark->save();

        return response()->json(['success' => 'Data berhasil dirubah']);
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
        customer::where('ID',$id)->update(['terlibat_ssc' => NULL,'tanggal_pengerjaan_ssc' => null]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
