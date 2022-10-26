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
use App\Imports\CustomerData;

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
            if($data_user->admin == 1 || $data_user->admin == 0)
            {
                return datatables()->of(customer::
                leftJoin('users','users.id','customerdata.IDUser')
                ->select('customerdata.*',DB::raw('DATE_FORMAT(customerdata.created_at,"%d %M %Y") as tglbuat'),'users.name')
                ->where('customerdata.deleted','0')
                ->where('customerdata.terlibat_ssc','!=',''))
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
                ->addColumn('kolom_kedua', function($data) use($data_user){
                    $kolom = $data->phone1;
                    if($data->phone2 != 0)
                    {
                        $kolom .= "<br>";
                        $kolom .= $data->phone2;
                    }
                    return $kolom;
                })
                ->addColumn('kolom_ketiga', function($data) use($data_user){
                    $kolom = $data->unit;
                    $kolom .= " ";
                    $kolom .= $data->tahun;
                    return $kolom;
                })
                ->addColumn('kolom_keempat', function($data) use($data_user){
                    switch($data->membership)
                    {
                        case 0 : return "New Member"; break;
                        case 1 : return "Platinum"; break;
                        case 2 : return "Gold"; break;
                        case 3 : return "Silver"; break;
                        case 4 : return "Bronze"; break;
                        case 5 : return "New Member"; break;
                    }
                })
                ->addColumn('kolom_kelima', function($data) use($data_user){
                    return "sales";
                })
                ->addColumn('action', function($data) use($data_user){
                    $button = '<div class="btn-group">';
                        $button .= '<button type="button" name="edit" id="'.$data->ID.'" class="edit btn btn-info btn-sm"><i title="Rubah Data" class="fas fa-pen-to-square"></i></button>';
                        $button .= '&nbsp';
                        $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Hapus Data" class="fas fa-trash"></i></button>';
                    return $button;})
                ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat'])
                ->make(true);
            }
            elseif($data_user->admin == 2)
            {
                return datatables()->of(customer::
                leftJoin('users','users.id','customerdata.IDUser')
                ->select('customerdata.*',DB::raw('DATE_FORMAT(customerdata.created_at,"%d %M %Y") as tglbuat'),'users.name')
                ->where('customerdata.deleted','0')
                ->where('customerdata.IDSales',$data_user->id)
                ->where('customerdata.terlibat_ssc','!=',''))
                ->filter(function ($data) use ($request) {
                    if ($request->namapelanggan) {
                        $data->where('nama_pelanggan', 'like', "%{$request->get('namapelanggan')}%");
                    }
                    if ($request->nomorrangka) {
                        $data->where('vincode', 'like', "%{$request->get('nomorrangka')}%");
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
                ->addColumn('kolom_kedua', function($data) use($data_user){
                    $kolom = $data->phone1;
                    if($data->phone2 != 0)
                    {
                        $kolom .= "<br>";
                        $kolom .= $data->phone2;
                    }
                    return $kolom;
                })
                ->addColumn('kolom_ketiga', function($data) use($data_user){
                    $kolom = $data->unit;
                    $kolom .= " ";
                    $kolom .= $data->tahun;
                    return $kolom;
                })
                ->addColumn('kolom_keempat', function($data) use($data_user){
                    switch($data->membership)
                    {
                        case 0 : return "New Member"; break;
                        case 1 : return "Platinum"; break;
                        case 2 : return "Gold"; break;
                        case 3 : return "Silver"; break;
                        case 4 : return "Bronze"; break;
                        case 5 : return "New Member"; break;
                    }
                })
                ->addColumn('action', function($data) use($data_user){
                    $button = '<div class="btn-group">';
                        $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                    return $button;})
                ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat'])
                ->make(true);}
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
        $data = customer::where('ID',$id)->select('*','1stcome as pertamadatang')->first();
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
            'nama_pelanggan'  =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'terlibat_ssc'              => $request->terlibat_ssc,
        );
        if(!empty($request->tanggal_pengerjaan_ssc))
        {
            $form_data = array_merge($form_data, ['tanggal_pengerjaan_ssc' => $request->tanggal_pengerjaan_ssc]);
        }

        DB::table('customerdata')->where('ID',$request->hidden_id2)->update($form_data);

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
