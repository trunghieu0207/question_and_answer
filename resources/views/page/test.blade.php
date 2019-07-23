<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
</head>
<body>
	@if (Session::has('id'))
		<div class="alert alert-danger"> {{Session::get('id')}} </div>
	@endif
	<h2>Thanh cong</h2>
	<button type="button" class="btn btn-primary"> <a href="{{url('logout')}} "> Logout</a></button>
</body>
</html>