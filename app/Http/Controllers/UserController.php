<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	echo '八荒';
    }

    public function show(){
    	echo '这里是商品详情页';
    }

    public function add(){
    	return view('user.add');
    }

    public function adddo(Request $request){
    	$data=$request->all();
    	dd($data);
    }
}
