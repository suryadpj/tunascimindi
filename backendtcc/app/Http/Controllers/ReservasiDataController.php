<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Models\customer;
use App\Models\reservasidata;

class ReservasiDataController extends Controller
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
            return datatables()->of(reservasidata::
            leftJoin('users','users.id','reservasi.IDUser')
            ->leftJoin('customerdata','customerdata.vincode','users.nomor_rangka')
            ->leftJoin('promo','promo.ID','reservasi.IDParent')
            ->select('reservasi.*',DB::raw('DATE_FORMAT(reservasi.tanggal,"%d %M %Y") as tglbuat'),'name','customerdata.no_polisi','promo.alt','promo.penjelasan')
            ->where('reservasi.deleted','0')
            ->where('segmen',3))
            ->filter(function ($data) use ($request) {
                // if ($request->nomorrangka) {
                //     $data->where('nomor_rangka', 'like', "%{$request->get('nomorangka')}%");
                // }
                if ($request->namapelanggan) {
                    $data->where('users.name', 'like', "%{$request->get('namapelanggan')}%");
                }
                if ($request->tanggalreservasi) {
                    $data->where('reservasi.tanggal', 'like', "%{$request->get('tanggalreservasi')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                switch($data->segmen)
                {
                    case 1 :  return "Promo"; break;
                    case 2 :  return "Tes Drive"; break;
                    case 3 :  return "Booking Service"; break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_ketiga', function($data) use($data_user){
                $kolom = $data->tglbuat;
                $kolom .= "<br>";
                $kolom .= $data->waktu;
                return $kolom;
            })
            ->addColumn('kolom_keempat', function($data) use($data_user){
                switch($data->segmen)
                {
                    case 1 :  return $data->alt." <br> ".$data->penjelasan; break;
                    case 2 :  return "Tes Drive"; break;
                    case 3 :  return "Booking Service"; break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_kelima', function($data) use($data_user){
                switch($data->status)
                {
                    case 1 :  return "Menunggu respon"; break;
                    case 2 :  return "Dihubungi"; break;
                    case 3 :  return "Done"; break;
                    case 4 :  return "Cancel"; break;
                    default : return "-";
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat','kolom_kelima'])
            ->make(true);
        }
        return view('reservasi.reservasi',['user' => $data_user]);
    }
    public function datasales(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            return datatables()->of(reservasidata::
            leftJoin('users','users.id','reservasi.IDUser')
            ->leftJoin('customerdata','customerdata.vincode','users.nomor_rangka')
            ->leftJoin('promo','promo.ID','reservasi.IDParent')
            ->select('reservasi.*',DB::raw('DATE_FORMAT(reservasi.tanggal,"%d %M %Y") as tglbuat'),'name','customerdata.no_polisi','promo.alt','promo.penjelasan')
            ->where('reservasi.deleted','0')
            ->whereIn('segmen', [5, 6, 7]))
            ->filter(function ($data) use ($request) {
                // if ($request->nomorrangka) {
                //     $data->where('nomor_rangka', 'like', "%{$request->get('nomorangka')}%");
                // }
                if ($request->namapelanggan) {
                    $data->where('users.name', 'like', "%{$request->get('namapelanggan')}%");
                }
                if ($request->tanggalreservasi) {
                    $data->where('reservasi.tanggal', 'like', "%{$request->get('tanggalreservasi')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                switch($data->segmen)
                {
                    case 1 :  return "Promo"; break;
                    case 2 :  return "Tes Drive"; break;
                    case 3 :  return "Booking Service"; break;
                    case 4 :  return "Aksesoris"; break;
                    case 5 :  return "Referensi Kendaraan"; break;
                    case 6 :  return "Informasi"; break;
                    case 7 :  return "Promo Sales"; break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_ketiga', function($data) use($data_user){
                if($data->segmen == 1 || $data->segmen == 7)
                {
                    $kolom = $data->tglbuat;
                    $kolom .= "<br>";
                    $kolom .= $data->waktu;
                    return $kolom;
                }
                elseif($data->segmen == 5 || $data->segmen == 6)
                {
                    $kolom = "Nama: ".$data->nama;
                    $kolom .= "<br>";
                    $kolom = "Nomor HP: ".$data->nomorhp;
                    return $kolom;
                }
            })
            ->addColumn('kolom_keempat', function($data) use($data_user){
                switch($data->segmen)
                {
                    case 1 :  return $data->alt." <br> ".$data->penjelasan; break;
                    case 2 :  return "Tes Drive"; break;
                    case 3 :  return $data->keterangan; break;
                    case 4 :  return $data->keterangan; break;
                    case 5 :  return "PIC SALES : ".$data->keterangan; break;
                    case 6 :  return $data->keterangan; break;
                    case 7 :  return $data->alt." <br> ".$data->penjelasan; break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_kelima', function($data) use($data_user){
                switch($data->status)
                {
                    case 1 :  return "Menunggu respon"; break;
                    case 2 :  return "Dihubungi"; break;
                    case 3 :  return "Done"; break;
                    case 4 :  return "Cancel"; break;
                    default : return "-";
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat','kolom_kelima'])
            ->make(true);
        }
        return view('reservasi.reservasisales',['user' => $data_user]);
    }
    public function databengkel(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            return datatables()->of(reservasidata::
            leftJoin('users','users.id','reservasi.IDUser')
            ->leftJoin('customerdata','customerdata.vincode','users.nomor_rangka')
            ->leftJoin('promo','promo.ID','reservasi.IDParent')
            ->leftJoin('job_sbe','job_sbe.ID','reservasi.IDParent')
            ->select('reservasi.*',DB::raw('DATE_FORMAT(reservasi.tanggal,"%d %M %Y") as tglbuat'),'name','customerdata.no_polisi','promo.alt','promo.penjelasan','job_sbe.km')
            ->where('reservasi.deleted','0')
            ->whereIn('segmen', [1, 3]))
            ->filter(function ($data) use ($request) {
                // if ($request->nomorrangka) {
                //     $data->where('nomor_rangka', 'like', "%{$request->get('nomorangka')}%");
                // }
                if ($request->namapelanggan) {
                    $data->where('users.name', 'like', "%{$request->get('namapelanggan')}%");
                }
                if ($request->tanggalreservasi) {
                    $data->where('reservasi.tanggal', 'like', "%{$request->get('tanggalreservasi')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                switch($data->segmen)
                {
                    case 1 :  return "Promo"; break;
                    case 2 :  return "Tes Drive"; break;
                    case 3 :  return "Booking Service"; break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_ketiga', function($data) use($data_user){
                $kolom = $data->tglbuat;
                $kolom .= "<br>";
                $kolom .= $data->waktu;
                return $kolom;
            })
            ->addColumn('kolom_keempat', function($data) use($data_user){
                switch($data->segmen)
                {
                    case 1 :  return $data->alt." <br> ".$data->penjelasan; break;
                    case 2 :  return "Tes Drive"; break;
                    case 3 :  if($data->km == 0) { return "Job : Oil Change"; } else { return "Job KM: ".$data->km; } break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_kelima', function($data) use($data_user){
                switch($data->status)
                {
                    case 1 :  return "Menunggu respon"; break;
                    case 2 :  return "Dihubungi"; break;
                    case 3 :  return "Done"; break;
                    case 4 :  return "Cancel"; break;
                    default : return "-";
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat','kolom_kelima'])
            ->make(true);
        }
        return view('reservasi.reservasibengkel',['user' => $data_user]);
    }
    public function dataaksesoris(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            return datatables()->of(reservasidata::
            leftJoin('users','users.id','reservasi.IDUser')
            ->leftJoin('customerdata','customerdata.vincode','users.nomor_rangka')
            ->leftJoin('aksesoris','aksesoris.ID','reservasi.IDParent')
            ->select('reservasi.*',DB::raw('DATE_FORMAT(reservasi.tanggal,"%d %M %Y") as tglbuat'),'name','customerdata.no_polisi','aksesoris.alt','aksesoris.penjelasan')
            ->where('reservasi.deleted','0')
            ->where('segmen',4))
            ->filter(function ($data) use ($request) {
                // if ($request->nomorrangka) {
                //     $data->where('nomor_rangka', 'like', "%{$request->get('nomorangka')}%");
                // }
                if ($request->namapelanggan) {
                    $data->where('users.name', 'like', "%{$request->get('namapelanggan')}%");
                }
                if ($request->tanggalreservasi) {
                    $data->where('reservasi.tanggal', 'like', "%{$request->get('tanggalreservasi')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                switch($data->segmen)
                {
                    case 1 :  return "Promo"; break;
                    case 2 :  return "Tes Drive"; break;
                    case 3 :  return "Booking Service"; break;
                    case 4 :  return "Aksesoris"; break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_ketiga', function($data) use($data_user){
                $kolom = $data->tglbuat;
                $kolom .= "<br>";
                $kolom .= $data->waktu;
                return $kolom;
            })
            ->addColumn('kolom_keempat', function($data) use($data_user){
                $kolom = "Pembelian Aksesoris: ".$data->alt;
                $kolom .= "<br>";
                $kolom .= "Catatan: ".$data->keterangan;
                return $kolom;
            })
            ->addColumn('kolom_kelima', function($data) use($data_user){
                switch($data->status)
                {
                    case 1 :  return "Menunggu respon"; break;
                    case 2 :  return "Dihubungi"; break;
                    case 3 :  return "Done"; break;
                    case 4 :  return "Cancel"; break;
                    default : return "-";
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga','kolom_keempat','kolom_kelima'])
            ->make(true);
        }
        return view('reservasi.reservasiaksesoris',['user' => $data_user]);
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
        $data_user = Auth::user();
        $data = explode(',',$request->hidden_id);
        reservasidata::whereIn('ID',$data)->update(['status' => $request->statusreservasi,'IDuserEksekusi' => $data_user->id]);
        return response()->json(['success' => 'Data berhasil dirubah.']);
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
        $data_user = Auth::user();
        reservasidata::whereIn('ID',array($id))->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
