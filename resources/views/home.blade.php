<!DOCTYPE html>
<html>
<head>
	@include('layout.css')
	<title>Homepage</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	<style type="text/css" media="screen">
		.pv-archiveText {
			white-space: nowrap;
			text-overflow: ellipsis;
			overflow: hidden;
			width: 90%;
		}
	</style>
</head>
<body style="background-image: linear-gradient(60deg, #64b3f4 0%, #c2e59c 100%); background-repeat: no-repeat; background-attachment: fixed;">
	@include('layout.header')
	<main>
		<div class="container mt-5">
			<div class="card shadow">
				<div class="card-header text-center">
					<h3>Newest questions</h3>
				</div>
				<div class="card-body p-0">
					@foreach($questions as $question)
					<div class="row px-3 pt-3">
						<div class="col-sm-1"><img src="img/avatar/{{$question->user->avatar}}" class="test rounded-circle align-middle"></div>
						<div class="col-sm-11">
							<small class="font-weight-bold" style="color:#5488c7;">{{$question->user->fullname}}</small>
							<small class="text-muted" style="color:#5488c7;">{{$question->created_at}}</small>
							<br>
							
							<div class="float-left"><h5>{{$question->title}}</h5></div>
							<small class="float-right border rounded-pill text-primary bg-light p-2 font-weight-bold">{{$question->categories->name}}</small>
							<br>
							<br>
							<p class="pv-archiveText">{{$question->content}}</p>
							<div class="row" style="width: 300px">
								<div class="col-sm">
									<i class="fa fa-thumbs-up"></i>
									{{$question->total_like}}
								</div>
								<div class="col-sm">
									<i class="fa fa-thumbs-down"></i>
									{{$question->total_dislike}}
								</div>
								<div class="col-sm">
									<i class="fa fa-reply"></i>
									{{$question->total_answer}}
								</div>
							</div>
						</div>

					</div>
					<hr>
					@endforeach
				</div>
			</div>
		</div>
	</main>
	<script>
		/*function truncateText(selector, maxLength) {
			var element = document.querySelector(selector),
			truncated = element.innerText;

			if (truncated.length > maxLength) {
				truncated = truncated.substr(0,maxLength) + '...';
			}
			return truncated;
		}

		document.querySelector('.content').innerText = truncateText('.content', 50);*/
	</script>
	@include('layout.js')
</body>
</html>