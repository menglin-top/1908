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
	<input type="text" name="head" placeholder="请输入文章标题" value="{{$head}}">
	<input type="submit" value="搜索">
</form>

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>文章编号</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>是否重要</th>
			<th>是否显示</th>
			<th>图片</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($title as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->t_id}}</td>
			<td>{{$v->head}}</td>
			<td>{{$v->type}}</td>
			<td>{{$v->is_zhong}}</td>
			<td>{{$v->is_show==1?'√':'×'}}</td>
			<td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width="50" height="50">@endif</td>
			<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
			<td>
				<a href="{{url('title/edit/'.$v->t_id)}}" class="btn btn-info">编辑</a> |
				<a href="{{url('title/show/'.$v->t_id)}}" class="btn btn-info">详情</a> |
				<a href="javascript:;" class="btn btn-danger" 
					onclick="del({{$v->t_id}})">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="7">{{$title->appends(['head'=>$head])->links()}}</td></tr>
	</tbody>
</table>

</body>
<script>

function del(id){
	if(!id){
		return;
	}
	if(confirm('是否删除?')){
		$.get('/title/destroy/'+id,function(res){
			if(res.code=='00000'){
				location.reload();
			}
		},'json')
	}

}
</script>