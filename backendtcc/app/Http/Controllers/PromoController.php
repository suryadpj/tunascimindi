<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Validator;
use App\Models\user;
use App\Models\sliderpromo;
use App\Models\promo;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            return datatables()->of(DB::table('sliderpromo')
            ->leftJoin('users','users.ID','sliderpromo.IDUser')
            ->leftJoin('segmen','segmen.ID','sliderpromo.segmen')
            ->select('sliderpromo.*',DB::raw('DATE_FORMAT(sliderpromo.created_at,"%d %M %Y") as tglbuat'),'users.name','segmen.segmen_name')
            ->where('sliderpromo.deleted','0')
            ->OrderBy('sliderpromo.ID','desc'))
            ->filter(function ($data) use ($request) {
                if (!empty($request->has('judul'))) {
                    $data->where('alt', 'like', "%{$request->get('judul')}%");
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                $kolom = '<i>'.$data->name.'</i>';
                $kolom .= "<br>";
                $kolom .= "dibuat pada : ".$data->tglbuat;
                return $kolom;
            })
            ->addColumn('kolom_ketiga', function($data) use($data_user){
                $kolom = '<i>'.$data->alt.'</i>';
                $kolom .= "<br>";
                $kolom .= "Segmen : Promo";
                return $kolom;
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                if($data->img_src != "")
                {
                    $button .= '<button type="button" class="btn btn-default"><a style="color:black" href="../data_file/slider/promo/'.$data->img_src.'" title="Download"><i title="Download" class="fas fa-download"></i></a></button>';
                }
                    $button .= '<button type="button" name="edit" id="'.$data->ID.'" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga'])
            ->make(true);
        }
        return view('slider.sliderpromo');
    }

    public function promo(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            return datatables()->of(DB::table('promo')
            ->leftJoin('users','users.ID','promo.IDUser')
            ->select('promo.*',DB::raw('DATE_FORMAT(promo.created_at,"%d %M %Y") as tglbuat'),'users.name')
            ->where('promo.deleted','0')
            ->OrderBy('promo.ID','desc'))
            ->filter(function ($data) use ($request) {
                if (!empty($request->has('judul'))) {
                    $data->where('alt', 'like', "%{$request->get('judul')}%");
                }
            })
            ->addColumn('kategori', function($data) use($data_user){
                switch($data->kategori)
                {
                    case 1 : return "Promo Service"; break;
                    case 2 : return "Promo Sales"; break;
                    default : return "-";
                }
            })
            ->addColumn('kolom_kedua', function($data) use($data_user){
                $kolom = '<i>'.$data->alt.'</i>';
                $kolom .= "<br>";
                $kolom .= "Jumlah like : ".$data->like;
                return $kolom;
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                if($data->img_src != "")
                {
                    $button .= '<button type="button" class="btn btn-default"><a style="color:black" href="../../'.$data->img_src.'" title="Download"><i title="Download" class="fas fa-download"></i></a></button>';
                }
                    $button .= '<button type="button" name="edit" id="'.$data->ID.'" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua'])
            ->make(true);
        }
        return view('promo.promo');
    }

    public function storepromo(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'rekomendasi'   =>  'required',
            'judul'         =>  'required',
            'penjelasan'    =>  'required',
            'file'          =>  'mimes:jpg,jpeg,png|max:102400|required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file = $request->file('file');
        $nama_file  = $file->getClientOriginalName();
        // ekstensi file
        $ekstensi   = $file->getClientOriginalExtension();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = '../../storage/app/public/files/dokumen/promo/';
        $path = 'storage/app/public/files/dokumen/promo/';
        $nama_file_uniq = time()."-".$nama_file;
        // upload file
        $file->move($tujuan_upload,$nama_file_uniq);

        // $name = $request->file('file')->getClientOriginalName();

        // $path = $request->file('file')->store('public/files/slider/halamandepan');

        $rekomendasi = $request->rekomendasi;
        $kategori = $request->kategori;
        $judul = $request->judul;
        $penjelasan = $request->penjelasan;
        $data_user = Auth::user();


        $save = new promo;

        $save->IDUser       = $data_user->id;
        $save->jempol       = $rekomendasi;
        $save->kategori     = $kategori;
        $save->img_src      = $path.$nama_file_uniq;
        $save->img_name     = $nama_file_uniq;
        $save->alt          = $judul;
        $save->penjelasan   = $penjelasan;
        $save->deleted      = 0;
        $save->like         = 0;
        $save->save();

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
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
            'segmen'    =>  'required',
            'judul'     =>  'required',
            'file'      =>  'mimes:jpg,jpeg,png|max:102400|required',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file = $request->file('file');
        if($file)
        {
            $nama_file  = $file->getClientOriginalName();
            // ekstensi file
            $ekstensi   = $file->getClientOriginalExtension();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = '../../storage/app/public/files/slider/promo/';
            $path = 'storage/app/public/files/slider/promo/';
            $nama_file_uniq = time()."-".$nama_file;
            // upload file
            $file->move($tujuan_upload,$nama_file_uniq);
        }
        else
        {
            $nama_file_uniq = "";
            $path = "";
        }

        // $name = $request->file('file')->getClientOriginalName();

        // $path = $request->file('file')->store('public/files/slider/halamandepan');

        $segmen = $request->segmen;
        $judul = $request->judul;
        $data_user = Auth::user();


        $save = new sliderpromo;

        $save->IDUser       = $data_user->id;
        $save->segmen       = $segmen;
        $save->img_src      = $path.$nama_file_uniq;
        $save->img_name     = $nama_file_uniq;
        $save->alt          = $judul;
        $save->deleted      = 0;
        $save->save();

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }

    public function show($id)
    {
        $data = promo::where('ID',$id)->select('*')->first();
        return response()->json(['data' => $data]);
    }

    public function edit(request $request)
    {

        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'rekomendasi'   =>  'required',
            'judul'         =>  'required',
            'penjelasan'    =>  'required',
            // 'file'          =>  'mimes:jpg,jpeg,png|max:102400|required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file = $request->file('file');
        if($file)
        {
            $nama_file  = $file->getClientOriginalName();
            // ekstensi file
            $ekstensi   = $file->getClientOriginalExtension();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = '../../storage/app/public/files/dokumen/promo/';
            $path = 'storage/app/public/files/dokumen/promo/';
            $nama_file_uniq = time()."-".$nama_file;
            // upload file
            $file->move($tujuan_upload,$nama_file_uniq);

        }
        else
        {
            $nama_file_uniq = "";
            $path = "";
        }

        $rekomendasi = $request->rekomendasi;
        $kategori = $request->kategori;
        $judul = $request->judul;
        $penjelasan = $request->penjelasan;
        $data_user = Auth::user();

        $form_data = array(
            'alt'           => $judul,
            'penjelasan'    => $penjelasan,
            'jempol'        => $rekomendasi,
            'kategori'      => $kategori,
        );
        if(!empty($nama_file_uniq))
        {
            $form_data = array_merge($form_data, ['img_src' => $path.$nama_file_uniq,'img_name' => $nama_file_uniq]);
        }

        DB::table('promo')->where('ID',$request->hidden_id   )->update($form_data);

        return response()->json(['success' => 'Data berhasil dirubah']);
    }
    public function destroy($id)
    {
        promo::where('ID',$id)->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
