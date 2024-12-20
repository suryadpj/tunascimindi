<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\User;
use App\Models\customer;
use App\Imports\CustomerData;

class UserDataController extends Controller
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
        return datatables()->of(user::
        leftJoin('customerdata','customerdata.vincode','users.nomor_rangka')
        ->select('users.*',DB::raw('DATE_FORMAT(users.created_at,"%d %M %Y") as tglbuat'),'customerdata.ID as idcustomer','customerdata.no_polisi','customerdata.vincode','customerdata.nama_pelanggan','customerdata.phone1','customerdata.domisili','customerdata.phone2','customerdata.tahun','customerdata.tanggal_lahir','customerdata.hobi','customerdata.food_drink','customerdata.unit','customerdata.membership')
        ->where('users.deleted',0))
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
                $button .= '<button type="button" name="edit" id="'.$data->idcustomer.'" class="edit btn btn-info btn-sm"><i title="Rubah Data" class="fas fa-pen-to-square"></i></button>';
                $button .= '&nbsp';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i title="Hapus Data" class="fas fa-trash"></i></button>';
            return $button;})
        ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat'])
        ->make(true);
        }
        return view('register.userregister',['user' => $data_user]);
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
        $res=User::where('id',$id)->delete();
        // user::where('id',$id)->update(['deleted' => 1, 'password' => Hash::make("dihapus")]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
