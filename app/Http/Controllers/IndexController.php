<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Index;
use Validator;
use Illuminate\Validation\Rule;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize=config('app.pageSize');
        $account=request()->account??'';
        $where=[];
        if($account){
            $where[]=['account','like',"%$account%"];
        }
        $data=Index::where($where)->paginate($pageSize);
        return view('index.index',['data'=>$data,'account'=>$account]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');

         //验证
        $validator = Validator::make($data,[
            'account' => 'unique:index|regex:/^[x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'pwd' => 'required',
        ],[
            'account.unique'=>'标题已存在',
            'account.regex'=>'标题必须由中文，英文，数字字符组成,在2~12位之间',
            'pwd.required' =>'文章分类不能为空',
        ]);
        if ($validator->fails()) { 
            return redirect('index/create')
                ->withErrors($validator)
                ->withInput(); 
        }

        if($request->hasFile('img')){
            $data['img'] = upload('img');
        }
        $res=Index::insert($data);
        if($res){
            return redirect('index');
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
        $data=Index::find($id);
        return view('index.update',['data'=>$data]);
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
        $data=$request->except('_token');
        if($request->hasFile('img')){
            $data['img']=upload('img');
        }
        $res=Index::where('id',$id)->update($data);
        if($res!==false){
            return redirect('index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Index::destroy($id);
        if($res){
            return redirect('index');
        }
    }
}
