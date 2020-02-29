<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;

class LoginController extends Controller
{
    public function login(){
    	return view('login.login');
    }

    public function logindo(Request $request){
    	$user=$request->except('_token');
    	$user['pwd']=md5($user['pwd']);
    	$admin=Admin::where($user)->first();

    	if($admin){
    		session(['adminuser'=>$admin]);
    		$request->session()->save();
    		return redirect('/people');
    	}
    	return redirect('login')->with('msg','没有此用户');
    }
}
