<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Validator;

class KritikSaranController extends Controller
{
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
        return view('kritiksaran',['profil' => $profil,'brosur' => $segmen_brosur,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
    }
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'jasa'                  =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data_user = Auth::user();

        $form_data = array(
            'IDUser'    =>  $data_user->id,
            'jasa'      =>  $request->jasa,
            'kritik'    =>  $request->kritik,
            'saran'     =>  $request->saran,
            'status'    =>  0,
        );

        DB::table('kritiksaran')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
}
