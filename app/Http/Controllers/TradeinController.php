<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Profil;

class TradeinController extends Controller
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
        $data = profil::leftjoin('users','users.nomor_rangka','customerdata.vincode')->select('customerdata.*','users.name','users.email','users.phone','users.nomor_rangka','users.address','users.city')->where('customerdata.vincode',$data_user->nomor_rangka)->first();
        $lastservice = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->first();
        $lastservicecount = DB::table('pkbdata')->where('nomor_rangka',$data_user->nomor_rangka)->orderBy('pkb_date','desc')->count();
        $cr7data = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->first();
        $cr7count = DB::table('cr7data')->where('no_polisi',$profil->no_polisi)->orderBy('ID','desc')->count();
        return view('tradein',['datae' => $data,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
    }

    public function model()
    {
        $model = DB::table('tradeincar')->select('model')->where('deleted',0)->groupby('model')->get();
        return view('tradeinmodel2',['model' => $model]);
    }
    public function year($id)
    {
        $year = DB::table('tradeincar')->select('model','tahun')->where('deleted',0)->where('model',$id)->groupby('model','tahun')->get();
        $yearone = DB::table('tradeincar')->select('model','tahun')->where('deleted',0)->where('model',$id)->groupby('model','tahun')->first();
        return view('tradeinyear',['year' => $year,'yearone' => $yearone]);
    }
    public function variants($id,$id2)
    {
        $variants = DB::table('tradeincar')->select('model','tahun','type')->where('deleted',0)->where('model',$id)->where('tahun',$id2)->groupby('model','tahun','type')->get();
        $variantsone = DB::table('tradeincar')->select('model','tahun','type')->where('deleted',0)->where('model',$id)->where('tahun',$id2)->groupby('model','tahun','type')->first();
        return view('tradeinvariants',['variants' => $variants,'variantsone' => $variantsone]);
    }
    public function transmisi($id,$id2,$id3)
    {
        $transmisi = DB::table('tradeincar')->select('model','tahun','type','transmisi')->where('deleted',0)->where('model',$id)->where('tahun',$id2)->where('type',$id3)->groupby('model','tahun','type','transmisi')->get();
        $transmisione = DB::table('tradeincar')->select('model','tahun','type','transmisi')->where('deleted',0)->where('model',$id)->where('tahun',$id2)->where('type',$id3)->groupby('model','tahun','type','transmisi')->first();
        return view('tradeintransmisi',['transmisi' => $transmisi,'transmisione' => $transmisione]);
    }
    public function detail($id,$id2,$id3,$id4)
    {
        $transmisi = DB::table('tradeincar')->select('model','tahun','type','transmisi')->where('deleted',0)->where('model',$id2)->where('tahun',$id3)->where('type',$id4)->groupby('model','tahun','type','transmisi')->get();
        $transmisione = DB::table('tradeincar')->select('model','tahun','type','transmisi')->where('deleted',0)->where('model',$id2)->where('tahun',$id3)->where('type',$id4)->groupby('model','tahun','type','transmisi')->first();
        return view('tradeintransmisi',['transmisi' => $transmisi,'transmisione' => $transmisione]);
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
        //
    }
}
