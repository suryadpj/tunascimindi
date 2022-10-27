<?php

namespace App\Imports;

use App\Models\cr7;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class Cr7Data implements ToModel, WithStartRow, WithCalculatedFormulas
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

        if($row['3'] != "")
        {
            $cek = cr7::find($row['3']);
            if(!$cek)
            {
                return new cr7([
                    'IDUser'                    => $data_user->id,
                    'no_polisi'                 => $row['3'],
                    'cr71'                      => $row['8'],
                    'cr72'                      => $row['9'],
                    'deleted'                   => 0
                ]);
            }
        }
    }
}
