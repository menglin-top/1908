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

<h2 style="color:red">登陆页面</h2>

<form class="form-horizontal" role="form" action="{{url('deng/dengdo')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="username" id="firstname">
    </div>
    <b style="color: red">{{session('msg')}}</b>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-8">
      <input type="password" class="form-control" name="pwd" id="lastname" >
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">登陆</button>
    </div>
  </div>
</form>