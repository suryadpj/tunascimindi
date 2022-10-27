<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cr7 extends Model
{
    use HasFactory;
    protected $table = 'cr7data';
    protected $primaryKey='no_polisi';
    protected $fillable = ['IDUser','no_polisi','cr71','cr72','deleted'];
}
