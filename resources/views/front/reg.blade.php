@extends('layouts.shop')
@section('title','商品注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('regdo')}}" method="post">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="mobile" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <button type="button" id="xin">获取验证码</button></div>
       <div class="lrList"><input type="text" name="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="text"  name="repwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit"  value="立即注册" />
      </div>
     </form><!--reg-login/-->


<script>
  $(document).on('click','#xin',function(){
    var mobile=$('input[name="mobile"]').val();
    if(!mobile){
      alert('请输入手机号或邮箱');
    }
    $.get(
      '/send',
      {mobile:mobile},
      function(res){
        if(res.code=='00000'){
          alert('发送成功');
        }
      },
      'json'
    );
  });
</script>
@endsection