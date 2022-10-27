<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sscdata extends Model
{
    use HasFactory;
    protected $table='sscdata';
    protected $primaryKey = 'ID';
    protected $fillable = ['IDUser','vincode','ssc','repair_date','status','keterangan','deleted'];
}
