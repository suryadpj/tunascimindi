<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ReservasiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data_user = Auth::user();
        $reservasi = DB::table('reservasi')
                    ->leftjoin('promo','promo.ID','reservasi.IDParent')
                    ->leftjoin('aksesoris','aksesoris.ID','reservasi.IDParent')
                    ->leftJoin('job_sbe as a','a.ID','reservasi.IDParent')
                    ->leftJoin('cr7data as b','b.ID','reservasi.IDParent')
                    ->select('reservasi.*','promo.alt','aksesoris.alt as aksesorisp','a.km','a.job',DB::raw('DATE_FORMAT(reservasi.tanggal,"%d %M %Y") as tgl'),'b.cr71','b.cr72')
                    ->where('reservasi.IDUser',$data_user->id)
                    ->whereIn('reservasi.segmen',['1','2','3','4','7','8'])
                    ->where('reservasi.deleted',0)
                    ->orderBy('reservasi.tanggal','desc')->get();
        $profil = DB::table('customerdata')
                    ->select('*',DB::raw('DATE_FORMAT(customerdata.masa_berlaku_stnk,"%d %M %Y") as berlakustnk'),DB::raw('DATE_FORMAT(customerdata.tanggal_pengerjaan_ssc,"%d %M %Y") as pengerjaanssc'))
                    ->where('vincode',$data_user->nomor_rangka)->first();
        $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
        $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
        $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
        $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
        $segmen_brosur = DB::table('brosurecatalog')->where('deleted',0)->get();
        return view('reservasi',['brosur' => $segmen_brosur,'reservasi' => $reservasi,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
    }

    public function show($id)
    {
        $data=DB::table('reservasi')
        ->leftjoin('job_sbe','job_sbe.ID','reservasi.IDParent')
        ->leftjoin('promo','promo.ID','reservasi.IDParent')
        ->leftjoin('aksesoris','aksesoris.ID','reservasi.IDParent')
        ->where('reservasi.ID',$id)
        ->select('reservasi.*',DB::raw('DATE_FORMAT(reservasi.tanggal,"%d %M %Y") as tgl'),'job_sbe.km','job_sbe.job','promo.alt','aksesoris.alt as aksesorisp')
        ->first();
        return response()->json(['data' => $data]);
    }

}
