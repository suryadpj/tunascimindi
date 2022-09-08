<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\sliderdepan;
use App\Models\profil;
use App\Models\user;

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
            $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
            $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
            return view('profilefirst',['datae' => $data,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
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
            $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
            $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
            return view('home',['sb' => $segmen_service_berkala,'gr' => $segmen_general_repair,'bp' => $segmen_body_paint,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count,]);
        }
    }
}
