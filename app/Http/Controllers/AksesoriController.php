<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Models\slideraksesoris;
use App\Models\aksesoris;

class AksesoriController extends Controller
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
        $segmen_aksesoris = slideraksesoris::where('segmen',6)->where('deleted',0)->get();
        $dataakses = aksesoris::where('deleted',0)->get();
        $dataaksescount = aksesoris::where('deleted',0)->count();
        $profil = DB::table('customerdata')
                    ->select('*',DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                    ->where('vincode',$data_user->nomor_rangka)->first();
        $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
        $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
        $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
        $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
        $segmen_brosur = DB::table('brosurecatalog')->where('deleted',0)->get();
        return view('aksesoris',['brosur' => $segmen_brosur,'dataakses' => $dataakses,'dataaksescount' => $dataaksescount,'slideraks' => $segmen_aksesoris,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
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
            // 'tanggal'   =>  'required',
            // 'waktu'     =>  'required',
            'hidden_id' =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data_user = Auth::user();

        $form_data = array(
            'IDUser'            =>  $data_user->id,
            'segmen'            =>  4,
            'IDParent'          =>  $request->hidden_id,
            // 'tanggal'           =>  $request->tanggal,
            // 'waktu'             =>  $request->waktu,
            'keterangan'        =>  $request->catatan,
            'status'            =>  1,
            'IDUserEksekusi'    =>  0,
            'deleted'           =>  0,
        );

        DB::table('reservasi')->insert($form_data);

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
        $data = aksesoris::where('ID',$id)->first();
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
        //
    }
}
