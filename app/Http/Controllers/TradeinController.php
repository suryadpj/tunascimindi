<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\profil;
use Validator;

class TradeinController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
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
        $segmen_brosur = DB::table('brosurecatalog')->where('deleted',0)->get();
        return view('tradein',['brosur' => $segmen_brosur,'datae' => $data,'profil' => $profil,'lastservice' => $lastservice,'lastservicecount' => $lastservicecount,'cr7data' => $cr7data,'cr7count' => $cr7count]);
    }

    public function merk()
    {
        $merk = DB::table('tradeincar')->select('merk')->where('deleted',0)->groupby('merk')->get();
        return view('merk',['merk' => $merk]);
    }

    public function model($id)
    {
        $model = DB::table('tradeincar')->select('merk','model')->where('merk',$id)->where('deleted',0)->groupby('merk','model')->get();
        return view('tradeinmodel2',['model' => $model]);
    }
    public function year($id,$id2)
    {
        $year = DB::table('tradeincar')->select('merk','model','tahun')->where('deleted',0)->where('merk',$id)->where('model',$id2)->groupby('merk','model','tahun')->get();
        $yearone = DB::table('tradeincar')->select('merk','model','tahun')->where('deleted',0)->where('merk',$id)->where('model',$id2)->groupby('merk','model','tahun')->first();
        return view('tradeinyear',['year' => $year,'yearone' => $yearone]);
    }
    public function variants($id,$id2,$id3)
    {
        $variants = DB::table('tradeincar')->select('merk','model','tahun','type')->where('deleted',0)->where('merk',$id)->where('model',$id2)->where('tahun',$id3)->groupby('merk','model','tahun','type')->get();
        $variantsone = DB::table('tradeincar')->select('merk','model','tahun','type')->where('deleted',0)->where('merk',$id)->where('model',$id2)->where('tahun',$id3)->groupby('merk','model','tahun','type')->first();
        return view('tradeinvariants',['variants' => $variants,'variantsone' => $variantsone]);
    }
    public function transmisi($id,$id2,$id3,$id4)
    {
        $transmisi = DB::table('tradeincar')->select('merk','model','tahun','type','transmisi')->where('deleted',0)->where('merk',$id)->where('model',$id2)->where('tahun',$id3)->where('type',$id4)->groupby('merk','model','tahun','type','transmisi')->get();
        $transmisione = DB::table('tradeincar')->select('merk','model','tahun','type','transmisi')->where('deleted',0)->where('merk',$id)->where('model',$id2)->where('tahun',$id3)->where('type',$id4)->groupby('merk','model','tahun','type','transmisi')->first();
        return view('tradeintransmisi',['transmisi' => $transmisi,'transmisione' => $transmisione]);
    }
    public function detail($id,$id2,$id3,$id4)
    {
        $transmisi = DB::table('tradeincar')->select('model','tahun','type','transmisi')->where('deleted',0)->where('model',$id2)->where('tahun',$id3)->where('type',$id4)->groupby('model','tahun','type','transmisi')->get();
        $transmisione = DB::table('tradeincar')->select('model','tahun','type','transmisi')->where('deleted',0)->where('model',$id2)->where('tahun',$id3)->where('type',$id4)->groupby('model','tahun','type','transmisi')->first();
        return view('tradeintransmisi',['transmisi' => $transmisi,'transmisione' => $transmisione]);
    }
    public function tradeinfinal($id)
    {
        $price = DB::table('tradeincar')->where('deleted',0)->where('ID',$id)->first();
        $insert = DB::table('tradeindata')->where('deleted',0)->where('IDUser',Auth::user()->id)->orderBy('ID','desc')->first();
        return view('tradeinfinal',['price' => $price,'tradeinput' => $insert]);
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
            'merk'        =>  'required',
            'model'        =>  'required',
            'year'     =>  'required',
            'variant'             =>  'required',
            'transmition'             =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $data_user = Auth::user();

        $form_data = array(
            'IDUser'                =>  $data_user->id,
            'merk'        =>  $request->merk,
            'model'        =>  $request->model,
            'year'     =>  $request->year,
            'varian'              =>  $request->variant,
            'transmisi'              =>  $request->transmition,
            'IDUserFollowUp'                =>  0,
            'deleted'               =>  0,
        );

        DB::table('tradeindata')->insert($form_data);

        $harga = DB::table('tradeincar')->where('merk',$request->merk)->where('model',$request->model)->where('tahun',$request->year)->where('type',$request->variant)->where('transmisi',$request->transmition)->first();

        return response()->json(['success' => $harga->ID]);
    }

    public function tradeinspesial(request $request)
    {

        $data_user = Auth::user();

        $form_data = array(
            'location'        =>  $request->location,
        );

        DB::table('tradeindata')->where('ID',$request->id)->update($form_data);
        return response()->json(['success' => 'data berhasil disimpan']);

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
