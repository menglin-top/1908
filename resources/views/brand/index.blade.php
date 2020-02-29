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

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>编号</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌描述</th>
			<th>品牌LOGO</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($brand as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->b_id}}</td>
			<td>{{$v->b_name}}</td>
			<td>{{$v->address}}</td>
			<td>{{$v->desc}}</td>
			<td>@if($v->logo)<img src="{{env('UPLOAD_URL')}}{{$v->logo}}" width="50" height="50">@endif</td>
			<td>
				<a href="{{url('brand/edit/'.$v->b_id)}}" class="btn btn-info">编辑</a> |
				<a href="{{url('brand/destroy/'.$v->b_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>