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
        $hitungpkb = DB::table('pkbdata')->where('deleted',0)->count();
        $hitungreservasi = DB::table('reservasi')->where('deleted',0)->count();
        $hitungtradein = DB::table('tradeindata')->where('deleted',0)->count();
        return view('home',['user' => $hitunguser, 'pkb' => $hitungpkb, 'reservasi' => $hitungreservasi, 'tradein' => $hitungtradein]);
    }
}
