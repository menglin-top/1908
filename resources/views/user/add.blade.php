<form action="{{route('do')}}" method="post">
@csrf
	名称:<input type="text" name='name'/><br><br>
	年龄:<input type="number" name="age"/><br><br>
	<input type="submit" value="添加">
</form>