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
		<input type="text" name="s_name" value="{{$s_name}}" placeholder="请输入名字">
		<input type="text" name="class" value="{{$class}}" placeholder="请输入班级">
		<input type="submit" value="搜索">	
	</form>

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>编号</th>
			<th>学生姓名</th>
			<th>学生性别</th>
			<th>班级</th>
			<th>成绩</th>
			<th>照片</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->s_id}}</td>
			<td>{{$v->s_name}}</td>
			<td>{{$v->sex==1?'男':'女'}}</td>
			<td>{{$v->class}}</td>
			<td>{{$v->mark}}</td>
			<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50">@endif</td>
			<td>
				<a href="{{url('student/edit/'.$v->s_id)}}" class="btn btn-info">编辑</a> 
				<a href="{{url('student/destroy/'.$v->s_id)}}" class="btn btn-danger">删除</a>
			</td>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="7">{{$data->appends(['s_name'=>$s_name,'class'=>$class])->links()}}</td></tr>
	</tbody>
</table>

</body>