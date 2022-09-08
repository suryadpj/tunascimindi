<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\Datatables;
use Validator;
use App\Models\sliderdepan;
use App\Models\user;

class SliderDepanController extends Controller
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
    public function index(request $request)
    {
        $data_user = Auth::user();
        if(request()->ajax())
        {
            return datatables()->of(DB::table('sliderdepan')
            ->leftJoin('users','users.ID','sliderdepan.IDUser')
            ->leftJoin('segmen','segmen.ID','sliderdepan.segmen')
            ->select('sliderdepan.*',DB::raw('DATE_FORMAT(sliderdepan.created_at,"%d %M %Y") as tglbuat'),'users.name','segmen.segmen_name')
            ->where('sliderdepan.deleted','0')
            ->OrderBy('sliderdepan.ID','desc'))
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
                $kolom .= "Segmen : ".$data->segmen_name;
                return $kolom;
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                if($data->img_src != "")
                {
                    $button .= '<button type="button" class="btn btn-default"><a style="color:black" href="data_file/sliderdepan/'.$data->img_src.'" title="Download"><i title="Download" class="fas fa-download"></i></a></button>';
                }
                    $button .= '<button type="button" name="edit" id="'.$data->ID.'" class="edit btn btn-primary btn-sm"><i title="Rubah Data" class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="'.$data->ID.'" class="delete btn btn-danger btn-sm"><i title="Rubah Data" class="fas fa-trash"></i></button>';
                return $button;})
            ->rawColumns(['action','kolom_kedua','kolom_ketiga'])
            ->make(true);
        }
        return view('slider.sliderdepan');
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
            'segmen'    =>  'required',
            'judul'     =>  'required',
            'file'      =>  'mimes:jpg,jpeg,png|max:102400',
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
        $tujuan_upload = '../../storage/app/public/files/slider/halamandepan/';
        $path = 'storage/app/public/files/slider/halamandepan/';
        $nama_file_uniq = time()."-".$nama_file;
        // upload file
        $file->move($tujuan_upload,$nama_file_uniq);

        // $name = $request->file('file')->getClientOriginalName();

        // $path = $request->file('file')->store('public/files/slider/halamandepan');

        $segmen = $request->segmen;
        $judul = $request->judul;
        $data_user = Auth::user();


        $save = new sliderdepan;

        $save->IDUser       = $data_user->id;
        $save->segmen       = $segmen;
        $save->img_src      = $path.$nama_file_uniq;
        $save->img_name     = $nama_file_uniq;
        $save->alt          = $judul;
        $save->deleted      = 0;
        $save->save();

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
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
        sliderdepan::where('ID',$id)->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
