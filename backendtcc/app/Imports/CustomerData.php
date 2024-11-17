<?php

namespace App\Imports;

use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class CustomerData implements ToModel, WithStartRow, WithCalculatedFormulas
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

        //define membership
        switch($row['18'])
        {
            case "PLATINUM" : $membership=1; break;
            case "GOLD" : $membership=2; break;
            case "SILVER" : $membership=3; break;
            case "BRONZE" : $membership=4; break;
            case "NEW MEMBER" : $membership=5; break;
            default : $membership=5;
        }

        //define status
        switch($row['17'])
        {
            case "Inactive" : $statuse = 2; break;
            case "Loyal" : $statuse = 3; break;
            case "Aktif" : $statuse = 1; break;
            case "Pasif" : $statuse = 5; break;
            case "New" : $statuse = 4; break;
            default : $statuse = 4;
        }
        //define empty date
        if($row['6'] == "" || isset($row['6'])) {$tglssc = NULL; } else {$tgllahir = $row['6']; }
        if($row['12'] == "" || isset($row['13'])) {$tglssc = NULL; } else {$tglssc = $row['13']; }
        if($row['13'] == "" || isset($row['14'])) {$tglstnk = NULL; } else {$tglstnk = $row['14']; }

        return new customer([
            'IDUser'                    => $data_user->id,
            'vincode'                   => $row['1'],
            'no_polisi'                 => $row['2'],
            'nama_pelanggan'            => $row['3'],
            'phone1'                    => $row['4'],
            'phone2'                    => $row['5'],
            'tanggal_lahir'             => $tgllahir,
            'domisili'                  => $row['7'],
            'hobi'                      => $row['8'],
            'food_drink'                => $row['9']." - ".$row['10'],
            'terlibat_ssc'              => $row['11'],
            'tanggal_pengerjaan_ssc'    => $tglssc,
            'masa_berlaku_stnk'         => $tglstnk,
            'unit'                      => $row['14'],
            'tahun'                     => $row['15'],
            '1stcome'                   => $row['16'],
            'status'                    => $statuse,
            'membership'                => $membership,
        ]);
    }
}
