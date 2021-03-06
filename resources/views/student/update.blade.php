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

<form class="form-horizontal" role="form" action="{{url('/student/update/'.$stu->s_id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">学生姓名</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="s_name" id="firstname" placeholder="请输入学生姓名" value="{{$stu->s_name}}">
    </div>
    <b style="color: red">{{$errors->first('s_name')}}</b>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">性别</label>
    <div class="radio">
    <label>
        <input type="radio" name="sex" id="optionsRadios1" value="1" @if($stu->sex=='1') checked @endif> 男
    </label>
   
    <label>
        <input type="radio" name="sex" id="optionsRadios1" value="2" @if($stu->sex=='2') checked @endif> 女
    </label>
  </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">班级</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="class" id="firstname" placeholder="请输入学生班级" value="{{$stu->class}}">
    </div>
  </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">成绩</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="mark" id="lastname" placeholder="年龄" value="{{$stu->mark}}">
    </div>
    <b style="color: red">{{$errors->first('mark')}}</b>
  </div>

  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">照片</label>
    <div class="col-sm-8">
      <img src="{{env('UPLOAD_URL')}}{{$stu->img}}" width="50" height="50">
      <input type="file" class="form-control" name="img" id="lastname">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">编辑</button>
    </div>
  </div>
</form>