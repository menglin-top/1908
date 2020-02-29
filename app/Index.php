<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index extends Model
{
    protected $table="index";
    protected $primaryKey='id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
