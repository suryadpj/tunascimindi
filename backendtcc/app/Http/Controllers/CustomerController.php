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
            if($data_user->admin == 1 || $data_user->admin == 0)
            {
                return datatables()->of(customer::
                leftJoin('users','users.id','customerdata.IDUser')
                ->select('customerdata.*',DB::raw('DATE_FORMAT(customerdata.created_at,"%d %M %Y") as tglbuat'),'users.name')
                ->where('customerdata.deleted','0'))
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
                ->where('customerdata.IDSales',$data_user->id))
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
            'vincode'                   => $request->vincode,
            'no_polisi'                 => $request->no_polisi,
            'nama_pelanggan'            => $request->nama_pelanggan,
            'phone1'                    => $request->phone1,
            'phone2'                    => 0,
            'domisili'                  => $request->domisili,
            'hobi'                      => $request->hobi,
            'food_drink'                => $request->food_drink,
            'terlibat_ssc'              => $request->terlibat_ssc,
            'unit'                      => $request->unit,
            'tahun'                     => $request->tahun,
            '1stcome'             => $request->pertamadatang,
            'status'                    => $request->status,
            'membership'                => $request->memebrship,
            'gbsb'                      => $request->gbsb,
            'tcare'                     => $request->tcare,
        );
        if(!empty($request->tanggal_lahir))
        {
            $form_data = array_merge($form_data, ['tanggal_lahir' => $request->tanggal_lahir]);
        }
        if(!empty($request->tanggal_pengerjaan_ssc))
        {
            $form_data = array_merge($form_data, ['tanggal_pengerjaan_ssc' => $request->tanggal_pengerjaan_ssc]);
        }
        if(!empty($request->masa_berlaku_stnk))
        {
            $form_data = array_merge($form_data, ['masa_berlaku_stnk' => $request->masa_berlaku_stnk]);
        }

        DB::table('customerdata')->where('ID',$request->hidden_id2)->update($form_data);

        return response()->json(['success' => 'Data berhasil dirubah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = customer::find($id)->select('*','1stcome as pertamadatang')->first();
        return response()->json(['data' => $data]);
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
        return response()->json(['success' => 'Data berhasil dirubah.']);
    }
}
