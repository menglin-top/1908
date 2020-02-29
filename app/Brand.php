<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table="brand";
    protected $primaryKey='b_id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
