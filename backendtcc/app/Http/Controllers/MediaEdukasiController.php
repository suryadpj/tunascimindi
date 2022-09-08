<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Validator;
use App\Models\user;
use App\Models\brosuredukasi;

class MediaEdukasiController extends Controller
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
            return datatables()->of(DB::table('brosuredukasi')
            ->leftJoin('users','users.ID','brosuredukasi.IDUser')
            ->select('brosuredukasi.*',DB::raw('DATE_FORMAT(brosuredukasi.created_at,"%d %M %Y") as tglbuat'),'users.name')
            ->where('brosuredukasi.deleted','0')
            ->OrderBy('brosuredukasi.ID','desc'))
            ->filter(function ($data) use ($request) {
                if (!empty($request->has('judul'))) {
                    $data->where('alt', 'like', "%{$request->get('judul')}%");
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                if($data->img_src != "")
                {
                    $button .= '<button type="button" class="btn btn-default"><a style="color:black" href="data_file/dokumen/brosur/'.$data->img_src.'" title="Download"><i title="Download" class="fas fa-download"></i></a></button>';
                }
                    $button .= '<button type="button" name="edit" id="'.$data->ID.'" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('mediaedukasi.mediaedukasi');
    }

    public function store(request $request)
    {

        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'judul'     =>  'required',
            'file'      =>  'mimes:pdf|max:102400|required',
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
        $tujuan_upload = '../../storage/app/public/files/dokumen/mediaedukasi/';
        $path = 'storage/app/public/files/dokumen/mediaedukasi/';
        $nama_file_uniq = time()."-".$nama_file;
        // upload file
        $file->move($tujuan_upload,$nama_file_uniq);

        // $name = $request->file('file')->getClientOriginalName();

        // $path = $request->file('file')->store('public/files/slider/halamandepan');

        $segmen = $request->segmen;
        $judul = $request->judul;
        $penjelasan = $request->penjelasan;
        $data_user = Auth::user();


        $save = new brosuredukasi;

        $save->IDUser       = $data_user->id;
        $save->img_src      = $path.$nama_file_uniq;
        $save->img_name     = $nama_file_uniq;
        $save->alt          = $judul;
        $save->penjelasan   = $penjelasan;
        $save->deleted      = 0;
        $save->save();

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }
}
