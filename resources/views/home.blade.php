@extends('layout.master')
@section('title','Homepage')
@section('content')

<main>
	<div class="container mt-5">
		<div class="card shadow">
			<div class="card-header text-center">
				<h3>Newest questions</h3>
			</div>
			<div class="card-body p-0">
				@foreach($questions as $question)
				<div class="row px-3 pt-3">
					<div class="col-sm-1"><img src="{{asset('images/avatars')}}/{{$question->user->avatar}}" class="test rounded-circle align-middle"></div>
					<div class="col-sm-11">
						<small class="font-weight-bold" style="color:#5488c7;">{{$question->user->fullname}}</small>
						<small class="text-muted" style="color:#5488c7;">{{$question->created_at}}</small>
						<br>

						<div class="float-left"><a href="viewtopic/{{ $question->id }}"><h5>{{$question->title}}</h5></a></div>
						<small class="float-right border rounded-pill text-primary bg-light p-2 font-weight-bold">{{$question->category->name}}</small>

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
@endsection
