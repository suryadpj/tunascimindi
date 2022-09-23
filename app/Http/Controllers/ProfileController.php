<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\user;
use App\Models\profil;
use Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_user = Auth::user();
        $profil = DB::table('customerdata')
                    ->select('*',DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                    ->where('vincode',$data_user->nomor_rangka)->first();
        $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
        $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
        $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
        $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
        $segmen_brosur = DB::table('brosurecatalog')->where('deleted',0)->get();
        return view('profile',['brosur' => $segmen_brosur,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
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
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'nama'          =>  'required',
            'email'         =>  'required',
            'tanggallahir'  =>  'required',
            'nomorhp'       =>  'required',
            'alamat'        =>  'required',
            'kota'          =>  'required',
            'hobi'          =>  'required',
            'fooddrink'     =>  'required',
            'hidden_id'     =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file = $request->file('file');
        if($file)
        {
            $nama_file  = $file->getClientOriginalName();
            // ekstensi file
            $ekstensi   = $file->getClientOriginalExtension();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = '../storage/app/public/files/foto/profile/';
            $path = 'storage/app/public/files/foto/profile/';
            $nama_file_uniq = time()."-".$nama_file;
            // upload file
            $file->move($tujuan_upload,$nama_file_uniq);
        }

        $data_user = Auth::user();

        $userdata = array(
            'email'                =>  $request->email,
            'name'                =>  $request->nama,
            'address'                =>  $request->alamat,
            'phone'                =>  $request->nomorhp,
            'city'                =>  $request->kota,
            'profilefirst'                =>  1,
        );
        if(!empty($file))
        {
            $userdata = array_merge($userdata, ['fotoprofil' => $nama_file_uniq,'fotoprofilpath' => $path.$nama_file_uniq]);
        }

        DB::table('users')->where('nomor_rangka',$request->hidden_id)->update($userdata);

        $customerdata = array(
            'tanggal_lahir'                =>  $request->tanggallahir,
            'hobi'                =>  $request->hobi,
            'food_drink'                =>  $request->fooddrink,
            'domisili'                =>  $request->kota,
            'no_polisi'                =>  $request->nopolisi,
        );

        if(!empty($request->masastnk))
        {
            $customerdata = array_merge($customerdata, ['masa_berlaku_stnk' => $request->masastnk]);
        }

        DB::table('customerdata')->where('vincode',$request->hidden_id)->update($customerdata);

        return response()->json(['success' => 'Data berhasil di update.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = profil::leftjoin('users','users.nomor_rangka','customerdata.vincode')->select('customerdata.*',DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk, "%d %M %Y") as masaberlakustnk'),'users.name','users.email','users.phone','users.address','users.city','users.nomor_rangka')->where('customerdata.vincode',$id)->first();
        return response()->json(['data' => $data]);
    }

    public function profilefirst()
    {
        $data_user = Auth::user();
        $profil = DB::table('customerdata')
                    ->select('*',DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                    ->where('vincode',$data_user->nomor_rangka)->first();
        $data = profil::leftjoin('users','users.nomor_rangka','customerdata.vincode')->select('customerdata.*','users.name','users.email','users.phone','users.nomor_rangka','users.address','users.city')->where('customerdata.vincode',$data_user->nomor_rangka)->first();
        $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
        $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
        $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
        $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
        return view('profilefirst',['datae' => $data,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = profil::leftjoin('users','users.nomor_rangka','customerdata.nomor_rangka')->select('customerdata.*','users.name','users.email','users.phone','users.nomor_rangka')->where('customerdata.vincode',$id)->first();
        return response()->json(['data' => $data]);
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
