<?php

namespace App\Imports;

use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithValidation;

class DOImport implements ToModel, WithStartRow, WithCalculatedFormulas, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $data_user = Auth::user();

        $cek = DB::table('customerdata')->where('vincode',$row['1'])->count();
        if($cek  == 0 && $row['1'] != "")
        {
            return new customer([
                'IDUser'                    => $data_user->id,
                'vincode'                   => $row['1'],
                'no_polisi'                 => $row['2'],
                'nama_pelanggan'            => $row['3'],
                'phone1'                    => 0,
                'phone2'                    => 0,
                'tanggal_lahir'             => NULL,
                'domisili'                  => NULL,
                'hobi'                      => NULL,
                'food_drink'                => NULL,
                'terlibat_ssc'              => NULL,
                'unit'                      => $row['4'],
                'tahun'                     => $row['5'],
                '1stcome'                   => NULL,
                'status'                    => NULL,
                'membership'                => NULL,
                'gbsb'                      => 0,
                'tcare'                     => 0,
                'kategori'                  => 1,
            ]);
        }
        elseif($cek  == 0 && $row['1'] == "")
        {
        }
        else
        {

        }

    }
    public function rules(): array
    {
        return [
            '1' => 'required',
            // '1' => 'unique:users',
        ];
    }
}
