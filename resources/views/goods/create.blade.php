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
<h1>添加商品</h1>
@if ($errors->any()) 
<div class="alert alert-danger"> 
<ul>@foreach ($errors->all() as $error) 
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif
<form action="{{url('/goods/store')}}"  method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入名字" name="goods_name">
				  <b style="color:red">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入年龄" name="goods_item">
					<b style="color:red">{{$errors->first('goods_item')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入身份证号" name="goods_price">
				   <b style="color:red">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="inputfile" class="col-sm-2 control-label">商品缩略图</label>
		<div class="col-sm-10">
			<input type="file" id="inputfile" name="goods_img">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入身份证号" name="goods_num">
				   <b style="color:red">{{$errors->first('goods_num')}}</b>
		</div>
	</div>
	<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="radio">
			<label>
				<input type="radio" name="is_best" id="optionsRadios1" value="1" >是
			</label>
			<label>
				<input type="radio" name="is_best" id="optionsRadios1" value="2" checked>否
			</label>
		</div>
	</div>
	<div class="form-group">
			<label for="firstname" class="col-sm-2 control-label">是否热销</label>
		<div class="radio">
			<label>
				<input type="radio" name="is_hot" id="optionsRadios1" value="1" >是
			</label>
			<label>
				<input type="radio" name="is_hot" id="optionsRadios1" value="2" checked>否
			</label>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入身份证号" name="goods_detail">
		</div>
	</div>
	<div class="form-group">
		<label for="inputfile" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" id="inputfile" name="goods_imgs[]" multiple="multiple">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>
