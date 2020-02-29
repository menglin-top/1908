<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s_name=request()->s_name??'';
        $class=request()->class??'';
        $where=[];
        if($s_name){
            $where[]=['s_name','like',"%$s_name%"];
        }
        if($class){
            $where[]=['class','like',"%$class%"];
        }
        $pageSize=config('app.pageSize');
        $data=DB::table('student')->where($where)->paginate($pageSize);
        return view('student.index',['data'=>$data,'s_name'=>$s_name,'class'=>$class]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('student.create');
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

        $validator = Validator::make($data,[
            's_name' => 'required|unique:student|regex:/^[x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'sex' => 'integer',
            'mark'=> 'required|integer|between:1,100',
        ],[
            's_name.required'=>'名字不能为空',
            's_name.regex'=>'名字必须由中文，英文，数字字符组成,在2~12位之间',
            'mark.required'=>'成绩不能为空',
            'mark.integer'=>'成绩必须是数字',
            'mark.between'=>'成绩不能超过100',
        ]);
        if ($validator->fails()) { 
            return redirect('student/create')
                ->withErrors($validator)
                ->withInput(); 
        }

        //文件上传
        if($request->hasFile('img')){
            $data['img']=$this->upload('img');
        }
        $res=DB::table('student')->insert($data);
        if($res){
            return redirect('/student');
        }
    }

    //文件上传
    public function upload($filename){
        if(request()->file($filename)->isValid()){
            //接收值
            $img=request()->file($filename);
            //上传
            $store_result=$img->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
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
        $stu=DB::table('student')->where('s_id',$id)->first();
        return view('student/update',['stu'=>$stu]);
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
        $stu=$request->except('_token');

        //验证
        
        $validator = Validator::make($stu,[
            's_name' => [
                'unique:student',
                'regex:/^[\{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                Rule::unique('student')->ignore($id,'s_id'),
            ],
            'mark'=> 'required|integer|between:1,100',
        ],[
            's_name.unique'=>'名字已存在',
            's_name.regex'=>'名字必须由中文，英文，数字字符组成,在2~12位之间',
            'mark.required'=>'成绩不能为空',
            'mark.integer'=>'成绩必须是数字',
            'mark.between'=>'成绩不能超过100',
        ]);
        if ($validator->fails()) { 
            return redirect('student/edit/'.$id)
                ->withErrors($validator)
                ->withInput(); 
        }
        
        //图片上传
        if($request->hasFile('img')){
            $stu['img']=$this->upload('img');
        }
        $res=DB::table('student')->where('s_id',$id)->update($stu);
        if($res!==false){
            return redirect('student');
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
        $res=DB::table('student')->where('s_id',$id)->delete();
        if($res){
            return redirect('student');
        }
    }
}
