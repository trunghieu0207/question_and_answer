<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="js/main.js" type="text/javascript" charset="utf-8" async defer></script>
</head>
<body>
	<header id="tt-header">
		<div class="tt-desktop-menu">
			<nav class="navbar navbar-expand-lg navbar-dark bg-light static-top">
				<div class="container">
					<a class="navbar-brand" href="#">
						<img src="image/iconfinder_user_help_1902262.png" alt="">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<h1 style="font-weight: bold;margin-right: 30px">Q&A system</h1>
					<nav class="navbar navbar-expand-sm bg-light navbar-dark">
						<form class="form-inline" action="/action_page.php">
							<input class="form-control mr-sm-3" type="text" placeholder="Search">
							<button class="btn" type="submit">Search</button>
						</form>
					</nav>
					<a class="navbar-brand" href="#">
						<img src="image/iconfinder_Contat_Us_40-Notification_4211863.png" alt="">
					</a>
					<div class="col-auto ml-auto">
						<div class="tt-account-btn">
							<a href="page-login.html" class="btn btn-success" style="margin-right: 30px">Sign in</a>

							<a href="page-signup.html" class="btn btn-primary">Sign up</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<main>
			<div class="container">
				<br/>
				<table class="table">
					<thead>
						<tr>
							<th>Topic</th>
							<th class="center-block text-center">Category</th>
							<th class="center-block text-center">Likes</th>
							<th class="center-block text-center">Dislikes</th>
							<th class="center-block text-center">Replies</th>
						</tr>
					</thead>
					<tbody>
						@foreach($questions as $question)
						<tr style="background-color: #E0F7FA">

							<td id="title"><div class="test rounded-circle align-middle"></div>{{$question->title}}</td>
							<td class="center-block text-center">{{$question->categories->name}}</1></td>
							<td class="center-block text-center">915</td>
							<td class="center-block text-center">128</td>
							<td class="center-block text-center">512</td>
						</tr>    
						@endforeach  

					</tbody>
				</table>
			</div>
		</main>
</body>
</html>