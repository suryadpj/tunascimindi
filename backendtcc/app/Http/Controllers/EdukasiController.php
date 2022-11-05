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

class EdukasiController extends Controller
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
            return datatables()->of(DB::table('brosuredukasi')
            ->leftJoin('users','users.ID','brosuredukasi.IDUser')
            ->select('brosuredukasi.*',DB::raw('DATE_FORMAT(brosuredukasi.created_at,"%d %M %Y") as tglbuat'),'users.name')
            ->where('brosuredukasi.deleted','0'))
            ->filter(function ($data) use ($request) {
                if (!empty($request->has('judul'))) {
                    $data->where('alt', 'like', "%{$request->get('judul')}%");
                }
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
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('mediaedukasi.mediaedukasi');
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = brosuredukasi::find($id);
        return response()->json(['data' => $data]);
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
    public function update(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'judul'     =>  'required',
            'penjelasan'     =>  'required',
            'file'      =>  'mimes:pdf|max:102400',
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $file = $request->file('file');
        if($file != "")
        {
            $nama_file  = $file->getClientOriginalName();
            // ekstensi file
            $ekstensi   = $file->getClientOriginalExtension();
            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = '../../storage/app/public/files/dokumen/mediaedukasi/';
            $path = 'storage/app/public/files/dokumen/mediaedukasi/';
            $nama_file_uniq = time()."-".$nama_file;
            // upload file
            $file->move($tujuan_upload,$nama_file_uniq);
        }

        $form_data = array(
            'alt' => $request->judul,
            'penjelasan' => $request->penjelasan,
        );
        if(!empty($file))
        {
            $form_data = array_merge($form_data, ['img_src' => $path.$nama_file_uniq,'img_name' => $nama_file_uniq,]);
        }

        brosuredukasi::where('ID',$request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Data berhasil ditambahkan.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        brosuredukasi::where('ID',$id)->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
