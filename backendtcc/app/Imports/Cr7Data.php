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
        switch($row['42'])
        {
            case "Order" : $statusparte = 1; break;
            case "Part partial" : $statusparte = 2; break;
            case "Part ready" : $statusparte = 3; break;
            default : $statusparte = 0;
        }
        if($row['43'] == "" || isset($row['44'])) {$tgleta = NULL; } else {$tgleta = $row['43']; }

        if($row['41'] != "")
        {
            return new cr7([
                'IDUser'                    => $data_user->id,
                'no_polisi'                 => $row['2'],
                'keterangan'                => $row['41'],
                'status_part'               => $statusparte,
                'eta'                       => $tgleta,
                'deleted'                   => 0
            ]);
        }
    }
}
