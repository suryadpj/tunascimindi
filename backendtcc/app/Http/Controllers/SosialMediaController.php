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
use App\Imports\sosmed;

class SosialMediaController extends Controller
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
            return datatables()->of(DB::table('sosialmedia')
            ->select('sosialmedia.*')
            ->where('sosialmedia.deleted','0'))
            ->filter(function ($data) use ($request) {
                if ($request->nama_sosmed) {
                    $data->where('nama', 'like', "%{$request->get('nama_sosmed')}%");
                }
            })
            ->addColumn('action', function($data) use($data_user){
                $button = '<div class="btn-group">';
                    $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-info btn-sm"><i title="Rubah Data" class="fas fa-pen-to-square"></i></button>';
                    $button .= '&nbsp';
                return $button;})
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('socialmedia.sosialmedia',['user' => $data_user]);
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
        $data = DB::table('sosialmedia')->where('id',$id)->select('*')->first();
        return response()->json(['data' => $data]);
    }
    public function updatedata(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
        ];
        $rules = array(
            'link'         =>  'required',
        );

        $error = Validator::make($request->all(), $rules,$messages);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'link'                   => $request->link,
        );

        DB::table('sosialmedia')->where('ID',$request->hidden_id2)->update($form_data);

        return response()->json(['success' => 'Data berhasil dirubah']);
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
        DB::table('sosialmedia')->where('ID',$id)->update(['deleted' => 1]);
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }
}
