<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Title;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Cache::flush();
        $head=request()->head??'';
        $where=[];
        if($head){
            $where[]=['head','like',"%$head%"];
        }
        $page=request()->page??1;
        $title=Redis::get('title_'.$page.'_'.$head);
        //dump($title);
        if(!$title){
            echo 'Db获取';
             $pageSize=config('app.pageSize');
             $title=Title::where($where)->paginate($pageSize);
             //序列化
             $title=serialize($title);
             Redis::setex('title_'.$page.'_'.$head,20,$title);

        }
        //反序列化
        $title=unserialize($title);
        return view('title.index',['title'=>$title,'head'=>$head]);
    }

    //ajax验证
    public function checkOnly(){
        $head=request()->head;
        $where=[];
        if($head){
            $where[]=['head','=',$head];
        }
        $t_id=request()->t_id;
        if($t_id){
            $where[]=['t_id','!=',$t_id];
        }
        $count=Title::where($where)->count();
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('title.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->except('_token');
        //验证
        $validator = Validator::make($data,[
            'head' => 'required|unique:title|regex:/^[x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'type' => 'required',
            'is_zhong' => 'required',
            'is_show' =>'required',
        ],[
            'head.required'=>'标题不能为空',
            'head.unique'=>'标题已存在',
            'head.regex'=>'标题必须由中文，英文，数字字符组成,在2~12位之间',
            'type.required' =>'文章分类不能为空',
            'is_zhong.required'=>'重要性不能为空',
            'is_show.required'=>'是否展示不能为空',
        ]);
        if ($validator->fails()) { 
            return redirect('title/create')
                ->withErrors($validator)
                ->withInput(); 
        }

        $data['add_time']=time();
        //判断文件上传
        if($request->hasFile('img')){
            $data['img']=upload('img');
        }

        $res=Title::insert($data);
        if($res){
            return redirect('title');
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
         //访问量
        $count=Redis::setnx('num_'.$id,1);
        if(!$count){
            $count=Redis::incr('num_'.$id);
        }
        $title=Title::find($id);
        return view('title.show',['title'=>$title,'count'=>$count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $title=Title::find($id);
        return view('title.update',['title'=>$title]);
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
        $title=request()->except('_token');
        //验证
        $validator = Validator::make($title,[
            'head' => [
                'required',
                'unique:title',
                'regex:/^[x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                Rule::unique('title')->ignore($id,'t_id'),
            ],
            'type' => 'required',
            'is_zhong' => 'required',
            'is_show' =>'required',
        ],[
            'head.required'=>'标题不能为空',
            'head.unique'=>'标题已存在',
            'head.regex'=>'标题必须由中文，英文，数字字符组成,在2~12位之间',
            'type.required' =>'文章分类不能为空',
            'is_zhong.required'=>'重要性不能为空',
            'is_show.required'=>'是否展示不能为空',
        ]);
        if ($validator->fails()) { 
            return redirect('title/edit/'.$id)
                ->withErrors($validator)
                ->withInput(); 
        }

         //文件上传
        if($request->hasFile('img')){
            $title['img']=upload('img');
        }

        $res=Title::where('t_id',$id)->update($title);
        if($res!==false){
            return redirect('title');
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
        $res=Title::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
