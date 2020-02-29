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
	<input type="text" name="username" value="{{$username}}">
	<input type="submit" value="搜索">
</form>

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>编号</th>
			<th>名称</th>
			<th>年龄</th>
			<th>身份证号</th>
			<th>头像</th>
			<th>添加时间</th>
			<th>是否湖北</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->p_id}}</td>
			<td>{{$v->username}}</td>
			<td>{{$v->age}}</td>
			<td>{{$v->card}}</td>
			<td>@if($v->head)<img src="{{env('UPLOAD_URL')}}{{$v->head}}" width="50" height="50">@endif</td>
			<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
			<td>{{$v->is_hubei==1?'√':'×'}}</td>
			<td>
				<a href="{{url('people/edit/'.$v->p_id)}}" class="btn btn-info">编辑</a> |
				<a href="{{url('people/destroy/'.$v->p_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	</tbody>
	<tr><td colspan="7">{{$data->appends(['username'=>$username])->links()}}</td></tr>
</table>

</body>