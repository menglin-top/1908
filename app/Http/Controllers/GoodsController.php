<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use Validator;
use Illuminate\Validation\Rule;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_name = request()->goods_name??'';
        $where = [];
        if($goods_name){
            $where[]=['goods_name','like',"%$goods_name%"];
        }
        $pageSize = config('app.pageSize');
        $data = Goods::where($where)->paginate($pageSize);
        return view('goods.index',['data'=>$data],['goods_name'=>$goods_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goods.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //   'goods_name'=>'regex:/^[\{4e00}-\x{9fa5}A-Za-z0-9_-]+$/u',
        //    'goods_price' => 'required|integer|between:1,10',
        //    'goods_item' => 'required|integer|between:1,20',
        //    'goods_num' => 'required|integer|between:1,10',
        // ],[
        //     'goods_name.regex'=>'名字需中文数字组成',
        //     'goods_price.required'=>'商品价格不能为空',
        //     'goods_price.integer'=>'商品价格必须为数字',
        //     'goods_price.between'=>'商品价格在1-10位数之间',
        //     'goods_num.required'=>'商品库存不能为空',
        //     'goods_num.integer'=>'商品库存必须为数字',
        //     'goods_num.between'=>'商品库存在1-10位数之间',
        //     'goods_item.required'=>'商品货号不能为空',
        //     'goods_item.integer'=>'商品货号必须为数字',
        //     'goods_item.between'=>'商品货号在1-20位数之间',
        // ]);
        // if ($validator->fails()) { 
        //     return redirect('goods/create')
        //         ->withErrors($validator)
        //         ->withInput(); 
        // }

        $data = $request->except('_token');
        if($request->hasFile('goods_img')){
            $data['goods_img'] = upload('goods_img');
        }
        if($data['goods_imgs']){
            $photo=Moreuploads('goods_imgs');
            $data['goods_imgs'] = implode('|',$photo);
        }
        $res = Goods::create($data);
        if($res){
            return redirect('/goods');
        }
    }
   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Goods::find($id);
        return view('goods.update',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Goods::destroy($id);
        if($res){
            return redirect('goods');
        }
    }
}
