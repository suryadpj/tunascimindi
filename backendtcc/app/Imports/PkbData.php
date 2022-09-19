<?php

namespace App\Imports;

use App\Models\pkb;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PkbData implements ToModel, WithStartRow, WithCalculatedFormulas
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
        $definepkbdate = explode('.',$row['7']);
        if($row['2'] != "")
        {
            return new pkb([
                'IDUser'                    => $data_user->id,
                'nomor_rangka'                   => $row['2'],
                'lookup_job'                 => $row['4'],
                'pkb_no'            => $row['6'],
                'pkb_date'                    => $definepkbdate[2]."-".$definepkbdate[1]."-".$definepkbdate[0],
                'operation_desc'                    => $row['12'],
                'service_category'                  => $row['30'],
                'kilometer'                   => $row['38'],
                'deleted'                    => 0,
            ]);
        }
    }
}
