<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Login;
class DengController extends Controller
{
    public function deng(){
    	return view('deng.deng');
    }
    public function dengdo(Request $request){
    	$user=request()->except('_token');
    	$user['pwd']=md5($user['pwd']);

    	$deng=Login::where($user)->first();
    	if($deng){
    		session(['loginuser'=>$deng]);
    		$request->session()->save();
    		return redirect('/title');
    	}
    	return redirect('deng')->with('msg','没有此用户');
    }
}
