<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class NewRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.registernew');
    }

    public function store(request $request)
    {
        $messages = [
            'required' => ':attribute wajib diinput',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'numeric' => ':attribute harus diisi angka',
            'confirmed' => ':attribute tidak sama, ulangi kembali',
        ];
        $rules = array(
            'nama' => ['required', 'string', 'max:255'],
            'nomorhp' => ['required'],
            'nomor_rangka' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        );

        $error = Validator::make($request->all(), $rules,$messages);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $cek = DB::table('customerdata')->where('vincode',$request->nomor_rangka)->count();
        if($cek > 0)
        {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->nomorhp,
                'nomor_rangka' => $request->nomor_rangka,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return response()->json(['success' => 'Data berhasil ditambahkan.']);
        }
        else
        {
            return response()->json(['tidakada' => "Nomor rangka tidak terdaftar / tidak sesuai"]);
        }

    }
}
