<?php

namespace App\Imports;

use App\Models\customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class membershipimport implements ToModel, WithStartRow, WithCalculatedFormulas
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
            switch($row['2'])
            {
                case "PLATINUM" : $member="1"; break;
                case "GOLD" : $member="2"; break;
                case "SILVER" : $member="3"; break;
                case "BRONZE" : $member="4"; break;
                case "NEW" : $member="5"; break;
            }
            if($row['1'] != "")
            {
                $form_data = array(
                    'membership'  => $member,
                );
                DB::table('customerdata')->where('vincode',$row['1'])->update($form_data);
            }
        }
    }
}
