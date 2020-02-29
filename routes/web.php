<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//正则约束
Route::get('/haha/{id}/{name}',function($goods_id,$goods_name){
	echo '商品id:';
	echo $goods_id;
	echo '商品名称:';
	echo $goods_name;
})->where(['name'=>'[a-zA-Z]+']);

//登陆  执行登陆
// Route::get('/login','LoginController@login');
// Route::post('/login/logindo','LoginController@logindo');

//增删该查  是否湖北外来人员
Route::prefix('people')->middleware('checklogin')->group(function(){
	Route::get('create','PeopleController@create');
	Route::post('store','PeopleController@store');
	Route::get('/','PeopleController@index');
	Route::get('edit/{id}','PeopleController@edit');
	Route::post('update/{id}','PeopleController@update');
	Route::get('destroy/{id}','PeopleController@destroy');
});


//增删改查  学生成绩
Route::prefix('student')->group(function(){
	Route::get('create','StudentController@create');
	Route::post('store','StudentController@store');
	Route::get('/','StudentController@index');
	Route::get('edit/{id}','StudentController@edit');
	Route::post('update/{id}','StudentController@update');
	Route::get('destroy/{id}','StudentController@destroy');
});

//增删改查  商品品牌
Route::prefix('brand')->group(function(){
	Route::get('create','BrandController@create');
	Route::post('store','BrandController@store');
	Route::get('/','BrandController@index');
	Route::get('edit/{id}','BrandController@edit');
	Route::post('update/{id}','BrandController@update');
	Route::get('destroy/{id}','BrandController@destroy');
});

//登陆 文章
Route::get('/deng','DengController@deng');
Route::post('/deng/dengdo','DengController@dengdo');
//增删改查  文章
Route::prefix('title')->middleware('checkdeng')->group(function(){
	Route::get('create','TitleController@create');
	Route::post('store','TitleController@store');

	Route::get('/','TitleController@index');
	Route::get('destroy/{id}','TitleController@destroy');
	Route::get('edit/{id}','TitleController@edit');
	Route::get('show/{id}','TitleController@show');
	Route::post('update/{id}','TitleController@update');
	Route::post('checkOnly','TitleController@checkOnly');
});

//增删改查  无限极分类
Route::prefix('cate')->group(function(){
	Route::get('create','CateController@create');
	Route::post('store','CateController@store');
	Route::get('/','CateController@index');
	Route::get('edit/{id}','CateController@edit');
	Route::post('update/{id}','CateController@update');
	Route::get('destroy/{id}','CateController@destroy');
	Route::post('ajaxtest','CateController@ajaxtest');
});

//增删改查  商品
Route::prefix('goods')->group(function(){
	Route::get('create','GoodsController@create');
	Route::post('store','GoodsController@store');

	Route::get('/','GoodsController@index');
	Route::get('destroy/{id}','GoodsController@destroy');
	Route::get('edit/{id}','GoodsController@edit');
	Route::post('update/{id}','GoodsController@update');
	//Route::post('checkOnly','GoodsController@checkOnly');
});

//增删改查 管理员
Route::prefix('index')->group(function(){
	Route::get('create','IndexController@create');
	Route::post('store','IndexController@store');

	Route::get('/','IndexController@index');
	Route::get('destroy/{id}','IndexController@destroy');
	Route::get('edit/{id}','IndexController@edit');
	Route::post('update/{id}','IndexController@update');
});


//又是有一个项目，带给我是苦恼，在我无聊的时候
Route::get('/','Index\FrontController@index');
Route::get('/send','Index\LoginController@ajaxsend');
Route::view('/login','front.login');
Route::post('/logindo','Index\LoginController@logindo');
Route::view('/reg','front.reg');
Route::post('/regdo','Index\LoginController@regdo');
//发送邮件
Route::get('/sendemail','Index\LoginController@sendEmail');
