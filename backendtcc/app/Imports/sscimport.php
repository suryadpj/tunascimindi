<?php

namespace App\Imports;

use App\Models\customer;
use Illuminate\Support\Facades\Auth;
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
        $form_data = array(
            'terlibat_ssc'              => $row['2'],
            'tanggal_pengerjaan_ssc'    => $row['3']
        );

        return DB::table('customerdata')->where('vincode',$row['1'])->update($form_data);
    }
}
