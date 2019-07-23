<!DOCTYPE html>
<html>
<head>
	@include('layout.css')
	<title>Homepage</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
	@include('layout.header')
		<main>
			<div class="container mt-5">
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
		@include('layout.js')
</body>
</html>