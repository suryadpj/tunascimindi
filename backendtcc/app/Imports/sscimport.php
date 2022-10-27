<?php

namespace App\Imports;

use App\Models\customer;
use App\Models\sscdata;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class sscimport implements ToModel, WithStartRow, WithCalculatedFormulas
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
        if($row['0'] != "")
        {
        $data_user = Auth::user();
        switch($row['2'])
        {
            case "ALREADY RECALL" : $status = '1'; break;
            case "Dalam Pekerjaan" : $status = '2'; break;
            case "Done" : $status = '3'; break;
            case "Cancel" : $status = '4'; break;
            default : $status='0';
        }

        return new sscdata([
            'vincode'              => $row['0'],
            'ssc'              => $row['1'],
            'repair_date'    => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['3']),
            'status'    => $status,
            'keterangan' => $row['4'],
            'IDUser' => 1,
        ]);
        }
    }
}
