<?php

namespace App\Imports;

use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class gbsbtcareimport implements ToModel, WithStartRow, WithCalculatedFormulas
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
        if($row['1'] != "")
        {
            if($row['2'] == "GBSB")
            {
                $form_data = array(
                    'tcare' => 0,
                    'gbsb'  => 1,
                );
            }
            elseif($row['2'] == "TCARE")
            {
                $form_data = array(
                    'gbsb'  => 0,
                    'tcare' => 1,
                );
            }
            DB::table('customerdata')->where('vincode',$row['1'])->update($form_data);
        }
    }
}
