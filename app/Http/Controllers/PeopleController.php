<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Validation\Rule;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$data=DB::table('people')->select('*')->get();
        $username=request()->username??'';
        $where=[];
        if($username){
            $where[]=['username','like',"%$username%"];
        }
        $pageSize=config('app.pageSize');
        $data=People::orderby('p_id','desc')->where($where)->paginate($pageSize);
        return view('people.index',['data'=>$data,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([ 
        //     'username' => 'required|unique:people|max:12|min:2',
        //     'age' => 'required|integer|min:1|max:3',
        //     'card'=> 'required|integer:18|unique:people',
        // ],[
        //     'username.required'=>'名字不能为空',
        //     'username.unique'=>'名字已存在',
        //     'username.max'=>'名字最长不能超过12',
        //     'username.min'=>'名字最短不能少于2位',
        //     'age.required'=>'年龄不能为空',
        //     'age.integer'=>'年龄必须为数字',
        //     'age.min'=>'年龄必须大于一位',
        //     'age.max'=>'年龄必须小于三位',
        //     'card.required'=>'身份证号不能为空',
        //     'card.integer'=>'身份证号必须18位',
        //     'card.unique'=>'身份证号已存在',
        // ]);

        $data=$request->except('_token');

        $validator = Validator::make($data,[
            'username' => 'required|unique:people|regex:/^[x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            'age' => 'required|integer|min:1|max:99',
        ],[
            'username.required'=>'名字不能为空',
            'username.unique'=>'名字已存在',
            'username.regex'=>'名字必须由中文，英文，数字字符组成,在2~12位之间',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.min'=>'年龄必须大于一位',
            'age.max'=>'年龄必须小于三位',
        ]);
        if ($validator->fails()) { 
            return redirect('people/create')
                ->withErrors($validator)
                ->withInput(); 
        }


        //判断有无文件上传
        if ($request->hasFile('head')) {
            $data['head']=$this->upload('head');
        }
        $data['add_time']=time();
        //$res=Db::table('people')->insert($data);
        $res=People::insert($data);
        if($res){
            return redirect('/people');
        }
    }


    //文件上传
    public function upload($filename){
        //判断上传过程有无错误
        if(request()->file($filename)->isValid()){
            //接收值
            $photo=request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    /**
     * Display the specified resource.
     *列表展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=DB::table('people')->where('p_id',$id)->first();
        return view('people.update',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=$request->except('_token');

        //验证
        $validator = Validator::make($user,[
            'username' => [
                'unique:people',
                'regex:/^[\{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
                Rule::unique('people')->ignore($id,'p_id'),
            ],
            'age' => 'required|integer|min:1|max:99',
        ],[
            'username.unique'=>'名字已存在',
            'username.regex'=>'名字必须由中文，英文，数字字符组成,在2~12位之间',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.min'=>'年龄必须大于一位',
            'age.max'=>'年龄必须小于三位',
        ]);
         if ($validator->fails()) { 
            return redirect('people/edit/'.$id)
                ->withErrors($validator)
                ->withInput(); 
        }

        if ($request->hasFile('head')) {
            $user['head']=$this->upload('head');
        }
        $res=DB::table('people')->where('p_id',$id)->update($user);
        if($res!==false){
            return redirect('people');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=DB::table('people')->where('p_id',$id)->delete();
        if($res){
            return redirect('people');
        }
    }
}
