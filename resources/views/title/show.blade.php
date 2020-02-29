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

<h2 style="color:red">详情页面</h2>

<h3>文章名称:</h3><p>{{$title->head}}</p>
<h3>浏览量：</h3><p>{{$count}}</p>
