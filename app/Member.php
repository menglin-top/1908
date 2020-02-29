<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table="member";
    protected $primaryKey='u_id';
    public $timestamps=false;
    //黑名单
    protected $guarded=[];
}
