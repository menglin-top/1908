<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Bootstrap 实例 - 水平表单</title>
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
  <script src="/static/js/jquery.min.js"></script>
  <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>

<h2 style="color:red">列表修改页面</h2>

<form class="form-horizontal" role="form" action="{{url('/people/update/'.$user->p_id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">名字</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="username" id="firstname" value="{{$user->username}}" placeholder="请输入名字">
    </div>
    <b style="color: red">{{$errors->first('username')}}</b>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">年龄</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="age" id="lastname" value="{{$user->age}}" placeholder="年龄">
    </div>
    <b style="color: red">{{$errors->first('age')}}</b>

  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">身份证号</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="card" id="lastname" value="{{$user->card}}" placeholder="身份证号">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">头像</label>
    <div class="col-sm-8">
      <img src="{{env('UPLOAD_URL')}}{{$user->head}}" width="50" height="50">
      <input type="file" class="form-control" name="head"  id="lastname">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">是否湖北人</label>
    <div class="radio">
    <label>
        <input type="radio" name="is_hubei" id="optionsRadios1" value="1" @if($user->is_hubei==1) checked @endif> 是
    </label>
   
    <label>
        <input type="radio" name="is_hubei" id="optionsRadios1" value="2" @if($user->is_hubei==2) checked @endif> 否
    </label>
  </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">编辑</button>
    </div>
  </div>
</form>