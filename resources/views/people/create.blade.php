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

<h2 style="color:red">列表添加页面</h2>

@if ($errors->any()) 
<div class="alert alert-danger">
 <ul>@foreach ($errors->all() as $error) 
    <li>{{ $error }}</li> 
    @endforeach
  </ul> 
</div> 
@endif

<form class="form-horizontal" role="form" action="{{url('people/store')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">名字</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="username" id="firstname" placeholder="请输入名字">
    </div>
    <b style="color: red">{{$errors->first('username')}}</b>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">年龄</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="age" id="lastname" placeholder="年龄">
    </div>
    <b style="color: red">{{$errors->first('age')}}</b>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">身份证号</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="card" id="lastname" placeholder="身份证号">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">头像</label>
    <div class="col-sm-8">
      <input type="file" class="form-control" name="head" id="lastname">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">是否湖北人</label>
    <div class="radio">
    <label>
        <input type="radio" name="is_hubei" id="optionsRadios1" value="1" > 是
    </label>
   
    <label>
        <input type="radio" name="is_hubei" id="optionsRadios1" value="2" checked> 否
    </label>
  </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">添加</button>
    </div>
  </div>
</form>