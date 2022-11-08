<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $hitunguser = DB::table('customerdata')->where('deleted',0)->count();
        $hitunglogin = DB::table('users')->where('deleted',0)->count();
        $hitungpkb = DB::table('pkbdata')->where('deleted',0)->count();
        $hitungreservasi = DB::table('reservasi')->where('deleted',0)->count();
        $hitungtradein = DB::table('tradeindata')->where('deleted',0)->count();
        $countsegmen = DB::table('customerdata')->select(DB::raw('SUM(IF(customerdata.membership=1,1,0)) as platinum'),DB::raw('SUM(IF(customerdata.membership=2,1,0)) as gold'),DB::raw('SUM(IF(customerdata.membership=3,1,0)) as silver'),DB::raw('SUM(IF(customerdata.membership=4,1,0)) as bronze'),DB::raw('SUM(IF(customerdata.status=1,1,0)) as aktif'),DB::raw('SUM(IF(customerdata.status=2,1,0)+IF(customerdata.status=0,1,0)+IF(customerdata.status=NULL,1,0)) as inactive'),DB::raw('SUM(IF(customerdata.status=3,1,0)) as loyal'),DB::raw('SUM(IF(customerdata.status=4,1,0)) as new'),DB::raw('SUM(IF(customerdata.status=5,1,0)) as pasif'))->where('deleted',0)->first();
        $countreservasi = DB::table('reservasi')->select('segmen',DB::raw('COUNT(id) as booking'),DB::raw('SUM(IF(reservasi.status>1,1,0)) as konfirmasi'))->where('created_at','like','%-11-%')->where('deleted',0)->groupBy('segmen')->get();
        return view('home',['hitungsegmen' => $countsegmen,'hitungreserv' => $countreservasi,'user' => $hitunguser,'logincount' => $hitunglogin, 'pkb' => $hitungpkb, 'reservasi' => $hitungreservasi, 'tradein' => $hitungtradein]);
    }
}
