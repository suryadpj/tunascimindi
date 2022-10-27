<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    protected $table = 'customerdata';
    protected $primaryKey = 'ID';
    protected $fillable = ['IDUser','vincode','no_polisi','nama_pelanggan','phone1','phone2','tanggal_bayar','domisili','hobi','food_drink','terlibat_ssc','tanggal_pengerjaan_ssc','masa_berlaku_stnk','unit','tahun','1stcome','status','membership','deleted'];
}
