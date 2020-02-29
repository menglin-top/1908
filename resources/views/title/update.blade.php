<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"> 
  <title>Bootstrap 实例 - 水平表单</title>
  <link rel="stylesheet" href="/static/css/bootstrap.min.css">  
  <script src="/static/js/jquery.min.js"></script>
  <script src="/static/js/bootstrap.min.js"></script>
  <meta name="csrf-token" content="{{  csrf_token()  }}">

</head>
<body>

<h2 style="color:red">列表添加页面</h2>

<form class="form-horizontal" role="form" action="{{url('/title/update/'.$title->t_id)}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">文章标题</label>
    <div class="col-sm-8">
      <input type="text" class="form-control" name="head" id="firstname" placeholder="文章标题" value="{{$title->head}}">
      <b style="color: red">{{$errors->first('head')}}</b>
    </div>
    
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">文章分类</label>
    <div class="col-sm-8">
      
      <select name="type" class="form-control" value="{{$title->type}}">
          <option value="">--请选择--</option>
          <option value="娱乐新闻">娱乐新闻</option>
          <option value="军事新闻">军事新闻</option>
          <option value="国际新闻">国际新闻</option>
      </select>
    </div>
    <b style="color: red">{{$errors->first('type')}}</b>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">文章重要性</label>
   <div class="radio">
    <label>
        <input type="radio" name="is_zhong" id="optionsRadios1" value="普通" @if($title->is_zhong=='普通') checked @endif> 普通
    </label>
    <label>
        <input type="radio" name="is_zhong" id="optionsRadios1" value="置顶" @if($title->is_zhong=='置顶') checked @endif> 置顶
    </label>
  </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">是否显示</label>
   <div class="radio">
    <label>
        <input type="radio" name="is_show" id="optionsRadios1" value="1" @if($title->is_show==1) checked @endif> 显示
    </label>
    <label>
        <input type="radio" name="is_show" id="optionsRadios1" value="2" @if($title->is_show==2) checked @endif> 不显示
    </label>
  </div>
  </div>
  <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">图片</label>
    <div class="col-sm-8">
        <img src="{{env('UPLOAD_URL')}}{{$title->img}}" width="50" height="50">      
        <input type="file" class="form-control" name="img" id="lastname">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-default">编辑</button>
    </div>
  </div>
</form>
<script>
  $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
  var t_id={{$title->t_id}};
  $(document).on('click','.btn',function(){
    var headflag=true;
    $(this).next().html('');
    //标题验证
    var head=$('input[name="head"]').val();
    var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
    if(!reg.test(head)){
      $(this).next().html('文章标题内容由中文数字字符组成且不能为空');
      return;
    }
    //验证唯一性
    $.ajax({
      type:'post',
      async:false,
      url:"/title/checkOnly",
      data:{head:head,t_id:t_id},
      dataType:'json',
      success:function(res){
        if(res.count>0){
          $('input[name="head"]').next().html('标题已存在');
          headflag=false;
        }
      }
    });

    if(!headflag){
      return;
    }
    //form提交
    $('form').submit();
  })


  $('input[name="head"]').blur(function(){
    $(this).next().html('');
    var head=$(this).val();
    var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
    if(!reg.test(head)){
      $(this).next().html('文章标题内容由中文数字字符组成且不能为空');
      return;
    }

    
    $.ajax({
      type:'post',
      async:false,
      url:"/title/checkOnly",
      data:{head:head,t_id:t_id},
      dataType:'json',
      success:function(res){
        if(res.count>0){
          $('input[name="head"]').next().html('标题已存在');
        }
      }
    });

  })
</script>