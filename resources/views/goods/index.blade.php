<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="static/css/bootstrap.min.css">  
	<script src="static/js/jquery.min.js"></script>
	<script src="static/js/bootstrap.min.js"></script>
</head>
<body>
<h1>商品展示列表</h1>
<form>
	<input type="text" name="goods_name" value="{{$goods_name}}" placeholder="请输入用户名">
	<input type="submit" value="搜索">
</form>
<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>商品id</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>商品价格</th>
			<th>商品缩略图</th>
			<th>商品库存</th>
			<th>是否精品</th>
			<th>是否热销</th>
			<th>商品详情</th>
			<th>商品相册</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_item}}</td>
			<td>{{$v->goods_price}}</td>
			<td>@if($v->goods_img)<img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width="50" height="50">@endif</td>
			<td>{{$v->goods_num}}</td>
			<td>{{$v->is_best==1?'√':'×'}}</td>
			<td>{{$v->is_hot==1?'√':'×'}}</td>
			<td>{{$v->goods_detail}}</td>
			<td>
				@if($v->goods_imgs)
				@php $photo=explode('|',$v->goods_imgs); @endphp
				@foreach($photo as $vv)
				<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="50" height="50">
				@endforeach
				@endif
			</td>
			<td><a href="{{url('goods/edit/'.$v->goods_id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a></td>
		</tr>
		@endforeach
		<tr><td colspan="7">{{$data->appends(['goods_name'=>$goods_name])->links()}}</td></tr>
	</tbody>
</table>

</body>
</html>