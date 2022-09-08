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

class CustomerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            if($data_user->admin == 1)
            {
                return datatables()->of(customer::
                leftJoin('users','users.id','customerdata.IDUser')
                ->select('customerdata.*',DB::raw('DATE_FORMAT(customerdata.created_at,"%d %M %Y") as tglbuat'),'users.name')
                ->where('customerdata.deleted','0'))
                ->filter(function ($data) use ($request) {
                    if ($request->namapelanggan) {
                        $data->where('nama_pelanggan', 'like', "%{$request->get('namapelanggan')}%");
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
                ->make(true);
            }
            elseif($data_user->admin == 2)
            {
                return datatables()->of(customer::
                leftJoin('users','users.id','customerdata.IDUser')
                ->select('customerdata.*',DB::raw('DATE_FORMAT(customerdata.created_at,"%d %M %Y") as tglbuat'),'users.name')
                ->where('customerdata.deleted','0')
                ->where('customerdata.IDSales',$data_user->id))
                ->filter(function ($data) use ($request) {
                    if ($request->namapelanggan) {
                        $data->where('nama_pelanggan', 'like', "%{$request->get('namapelanggan')}%");
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
        return view('customer.customerdata',['user' => $data_user]);
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
        Excel::import(new CustomerData, $request->file('file')->store('temp'));
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
        customer::where('ID',$id)->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
    public function updatesales(request $request)
    {
        customer::whereIn('ID',array($request->hidden_id))->update(['IDSales' => $request->IDSales]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
