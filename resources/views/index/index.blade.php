<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Bootstrap 实例 - 水平表单</title>
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
  <script src="/static/js/jquery.min.js"></script>
  <script src="/static/js/bootstrap.min.js"></script>
</head>
<h2 style="color:pink">列表展示页面</h2>

<body>

<form>
	<input type="text" name="account" value="{{$account}}">
	<input type="submit" value="搜索">
</form>

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>编号</th>
			<th>账号</th>
			<th>头像</th>
			<th>手机号</th>
			<th>邮箱</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->id}}</td>
			<td>{{$v->account}}</td>
			<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50">@endif</td>
			<td>{{$v->num}}</td>
			<td>{{$v->mail}}</td>
			<td>
				<a href="{{url('index/edit/'.$v->id)}}" class="btn btn-info">编辑</a> |
				<a href="{{url('index/destroy/'.$v->id)}}" class="btn btn-danger">删除</a>|
			</td>
		</tr>
		@endforeach
	</tbody>
	<tr>
		<td colspan="7">{{$data->appends(['account'=>$account])->links()}}</td>
	</tr>
</table>

</body>