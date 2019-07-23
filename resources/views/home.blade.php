<!DOCTYPE html>
<html>
<head>
	@include('layout.css')
	<title>Homepage</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
	<header id="tt-header">
		<div class="tt-desktop-menu">
			<nav class="navbar navbar-expand-lg navbar-dark bg-light static-top">
				<div class="container">
					<a class="navbar-brand" href="{{route('home-page')}}">
						<img src="{{asset('img/resource/logo2a.png')}}" alt="" style="width:70px ">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<h1 style="font-weight: bold;margin-right: 30px">TechSolution</h1>
					<nav class="navbar navbar-expand-sm bg-light navbar-dark">
						<form class="form-inline" action="/action_page.php">
							<input class="form-control mr-sm-3" type="text" placeholder="Search">
							<button class="btn btn-outline-dark" type="submit">Search</button>
						</form>
					</nav>
					<a class="navbar-brand" href="#">
						<img src="image/iconfinder_Contat_Us_40-Notification_4211863.png" alt="">
					</a>
					<div class="col-auto ml-auto">
						<div class="tt-account-btn">
							<a href="{{route('sign-in')}}" class="btn btn-success" style="margin-right: 30px">Sign in</a>

							<a href="{{route('getSignUp')}}" class="btn btn-primary">Sign up</a>
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

							<td id="title"><img src="img/avatar/{{$question->user_id}}" class="test rounded-circle align-middle">{{$question->title}}</td>
							
							<td class="center-block text-center">{{$question->categories->name}}</td>
							<td class="center-block text-center">915</td>
							<td class="center-block text-center">128</td>
							<td class="center-block text-center">512</td>
						</tr>    
						@endforeach  

					</tbody>
				</table>
			</div>
		</main>
		@include('layout.js')
</body>
</html>