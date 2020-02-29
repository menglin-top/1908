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
<h1>编辑管理员</h1>

<form action="{{url('/index/update/'.$data->id)}}"  method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">账号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入账号" name="account" value="{{$data->account}}">
				  <b style="color:red">{{$errors->first('account')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="firstname" 
				   placeholder="请输入密码" name="pwd" value="{{$data->pwd}}">
					<b style="color:red">{{$errors->first('pwd')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="inputfile" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-10">
			<img src="{{env('UPLOAD_URL')}}{{$data->img}}" width="50" height="50">
			<input type="file" id="inputfile" name="img">
		</div>
	</div>
	
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入手机号" name="num" value="{{$data->num}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入邮箱" name="mail" value="{{$data->mail}}">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>
