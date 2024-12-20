<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\sliderdepan;
use App\Models\profil;
use App\Models\user;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_user = Auth::user();
        if($data_user->profilefirst == 0)
        {
            $data_user = Auth::user();
            $profil = DB::table('customerdata')
                        ->select('*',DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                        ->where('vincode',$data_user->nomor_rangka)->first();
            $data = profil::leftjoin('users','users.nomor_rangka','customerdata.vincode')->select('customerdata.*','users.name','users.email','users.phone','users.nomor_rangka','users.address','users.city')->where('customerdata.vincode',$data_user->nomor_rangka)->first();
            $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
            $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
            if($lastservicecount > 0)
            {
                $nextservice = DB::table('job_sbe')->where('km','>',$lastservice->jobkm)->orderBy('km','asc')->first();
                $countnextservice = DB::table('job_sbe')->where('km','>',$lastservice->jobkm)->orderBy('km','asc')->count();
                if($countnextservice == 0)
                {
                    $nextservice = 0;
                }
            }
            else
            {
                $nextservice = 0;
            }
            $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
            $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
            $segmen_brosur = DB::table('brosurecatalog')->where('deleted',0)->get();
            $sosialmedia = DB::table('sosialmedia')->where('deleted',0)->get();
            return view('profilefirst',['sosmed' => $sosialmedia,'brosur' => $segmen_brosur,'datae' => $data,'profil' => $profil,'nextserv' => $nextservice,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
        }
        else
        {
            $segmen_service_berkala = sliderdepan::where('segmen',1)->where('deleted',0)->get();
            $segmen_general_repair = sliderdepan::where('segmen',2)->where('deleted',0)->get();
            $segmen_body_paint = sliderdepan::where('segmen',3)->where('deleted',0)->get();
            $profil = DB::table('customerdata')
                        ->select('*',DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                        ->where('vincode',$data_user->nomor_rangka)->first();
            $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
            $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
            if($lastservicecount > 0)
            {
                if($lastservice->jobkm == "-" || $lastservice->jobkm == "")
                {
                    $nextservice = DB::table('job_sbe')->where('km',0)->orderBy('km','asc')->first();
                }
                else
                {
                    $nextservice = DB::table('job_sbe')->where('km','>',$lastservice->jobkm)->orderBy('km','asc')->first();
                    $countnextservice = DB::table('job_sbe')->where('km','>',$lastservice->jobkm)->orderBy('km','asc')->count();
                    if($countnextservice == 0)
                    {
                        $nextservice = 0;
                    }
                }
            }
            else
            {
                $nextservice = DB::table('job_sbe')->where('km',0)->orderBy('km','asc')->first();
                $lastservice="0";
            }
            $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
            $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
            $segmen_brosur = DB::table('brosurecatalog')->where('deleted',0)->get();
            $sosialmedia = DB::table('sosialmedia')->where('deleted',0)->get();
            return view('home',['sosmed' => $sosialmedia,'brosur' => $segmen_brosur,'sb' => $segmen_service_berkala,'gr' => $segmen_general_repair,'nextserv' => $nextservice,'bp' => $segmen_body_paint,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count,]);
        }
    }
    public function tcare()
    {
        $data_user = Auth::user();
        $profil = DB::table('customerdata')
                    ->select('*',DB::raw('"Promo Bengkel" as promo'),DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                    ->where('vincode',$data_user->nomor_rangka)->first();
        $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
        $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
        $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
        $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
        return view('tcare',['profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
    }
    public function gbsb()
    {
        $data_user = Auth::user();
        $profil = DB::table('customerdata')
                    ->select('*',DB::raw('"Promo Bengkel" as promo'),DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                    ->where('vincode',$data_user->nomor_rangka)->first();
        $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
        $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
        $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
        $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
        return view('gbsb',['profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
    }

    public function booknow(request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'tanggal_bn'   =>  'required',
            'time_bn'     =>  'required',
            'job_bn'     =>  'required',
            'hidden_id'     =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data_user = Auth::user();

        $form_data = array(
            'IDUser'            =>  $data_user->id,
            'segmen'            =>  3,
            'IDParent'          =>  $request->hidden_id,
            'tanggal'           =>  $request->tanggal_bn,
            'waktu'             =>  $request->time_bn,
            'keterangan'        =>  $request->keterangan_bn,
            'status'            =>  1,
            'IDUserEksekusi'    =>  0,
            'deleted'           =>  0,
        );

        DB::table('reservasi')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
    public function cr7booknow(request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'tanggal_cr7'   =>  'required',
            'time_cr7'     =>  'required',
            'job_cr7'     =>  'required',
            'hidden_id2'     =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data_user = Auth::user();

        $form_data = array(
            'IDUser'            =>  $data_user->id,
            'segmen'            =>  8,
            'IDParent'          =>  $request->hidden_id2,
            'tanggal'           =>  $request->tanggal_cr7,
            'waktu'             =>  $request->time_cr7,
            'keterangan'        =>  $request->keterangan_cr7,
            'status'            =>  1,
            'IDUserEksekusi'    =>  0,
            'deleted'           =>  0,
        );

        DB::table('reservasi')->insert($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
}
