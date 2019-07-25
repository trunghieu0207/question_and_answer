<!DOCTYPE html>
<html>
<head>
	@include('layout.css')
	<title>Homepage</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body style="background-image: linear-gradient(60deg, #64b3f4 0%, #c2e59c 100%); background-repeat: no-repeat; background-attachment: fixed;">
	@include('layout.header')
		<main>
			<div class="container mt-5">
				<div class="card shadow">
				<div class="card-body p-0">
				<table class="table h-100">
					<thead class="bg-secondary text-light" >
						<tr class="align-middle">
							<th class="center-block align-middle">Topic</th>
							<th class="center-block text-center align-middle">Category</th>
							<th class="center-block text-center align-middle">Likes</th>
							<th class="center-block text-center align-middle">Dislikes</th>
							<th class="center-block text-center align-middle">Replies</th>
						</tr>
					</thead>
					<tbody>
						
						@foreach($questions as $question)
						<tr style="background-color: #E0F7FA">

							<td id="title"><img src="img/avatar/{{$question->user->avatar}}" class="test rounded-circle align-middle">{{$question->title}}</td>
							
							<td class="center-block text-center">{{$question->categories->name}}</td>
							<td class="center-block text-center">915</td>
							<td class="center-block text-center">128</td>
							<td class="center-block text-center">512</td>
						</tr>    
						@endforeach  

					</tbody>
				</table>
				</div>
				</div>
			</div>
		</main>
		@include('layout.js')
</body>
</html>