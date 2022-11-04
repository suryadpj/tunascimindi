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

class TradeInController extends Controller
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
            return datatables()->of(DB::table('tradeindata')
            ->leftJoin('users','users.id','tradeindata.IDUser')
            ->leftJoin('customerdata','customerdata.vincode','users.nomor_rangka')
            ->select('tradeindata.*',DB::raw('DATE_FORMAT(tradeindata.created_at,"%d %M %Y") as tglbuat'),DB::raw('DATE_FORMAT(tradeindata.created_at,"%m/%d/%Y %H:%i:%s") as dibuat'),'users.name','users.phone','users.nomor_rangka','customerdata.no_polisi')
            ->where('tradeindata.deleted','0'))
            ->filter(function ($data) use ($request) {
                if ($request->nomorrangka) {
                    $data->where('nomor_rangka', 'like', "%{$request->get('nomorangka')}%");
                }
                if ($request->nomorplat) {
                    $data->where('no_polisi', 'like', "%{$request->get('nomorplat')}%");
                }
                if ($request->tanggalreservasi) {
                    $data->where('tradeindata.created_at', 'like', "%{$request->get('tanggalreservasi')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                $show = $data->model." - ".$data->varian;
                switch($data->transmisi)
                {
                    case 1 : $show .= " - MT";
                    case 2 : $show .= " - AT";
                    default : '-';
                }

                return $show;

            })
            ->addColumn('hitung', function($data) use($data_user){
                switch($data->location)
                {
                    case 1 : return "Di Rumah"; break;
                    case 2 : return "Di Bengkel"; break;
                    default : return 'Tidak memilih';
                }

            })
            ->addColumn('kolom_status', function($data) use($data_user){
                switch($data->status)
                {
                    case 1 :  return "Menunggu respon"; break;
                    case 2 :  return "Dihubungi"; break;
                    case 3 :  return "Done"; break;
                    case 4 :  return "Cancel"; break;
                    default : return "Menunggu respon";
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua'])
            ->make(true);
        }
        return view('tradein.tradein',['user' => $data_user]);
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
        DB::table('tradeindata')->whereIn('ID',$data)->update(['status' => $request->statustradein,'IDUserFollowUp' => $data_user->id]);
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
        DB::table('tradeindata')->whereIn('ID',array($id))->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
