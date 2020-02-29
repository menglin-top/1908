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

<form class="form-horizontal" role="form" action="{{url('/brand/update/'.$brand->b_id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="b_name" id="firstname" placeholder="品牌名称" value="{{$brand->b_name}}">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="address" id="lastname" placeholder="品牌网址" value="{{$brand->address}}">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">品牌描述</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="desc" id="lastname" placeholder="品牌描述" value="{{$brand->desc}}">
    </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
    <div class="col-sm-8">
      <img src="{{env('UPLOAD_URL')}}{{$brand->logo}}" width="50" height="50">
      <input type="file" class="form-control" name="logo" id="lastname">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">修改</button>
    </div>
  </div>
</form>