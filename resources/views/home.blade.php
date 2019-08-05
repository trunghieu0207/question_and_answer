
@extends('layout.master')
@section('title','Homepage')
@section('content')

<main>
	<div class="container mt-5">
		<div class="card shadow">
			<div class="card-header text-center">
				<h3><i class="fa fa-angle-double-left"></i> Newest questions <i class="fa fa-angle-double-right"></i></h3>
			</div>
			<div class="card-body p-0">
				@foreach($questions as $question)
				<div class="row px-3 pt-3">
					<div class="col-sm-1"><img src="{{asset('images/avatars')}}/{{$question->user->avatar}}" class="test rounded-circle align-middle"></div>
					<div class="col-sm-11">
							<a href="/personalinfomation/{{ $question->user->_id }}">
								<small class="font-weight-bold" style="color:#5488c7;">{{$question->user->fullname}}</small>
							</a>
						<small class="text-muted" style="color:#5488c7;">
							{{$question->date}}
						</small>
						<br>

						<div class="float-left" style="max-width:900px"><a href="viewtopic/{{ $question->id }}"><h5>{{$question->title}}</h5></a></div>
						<small class="float-right border rounded-pill text-primary bg-light p-2 font-weight-bold">{{$question->category->name}}</small>

						<br>
						<br>
						<p class="pv-archiveText">{{$question->content}}</p>
						<div class="row" style="width: 250px; color:gray;">
							<div class="col-3">
								<i class="fa fa-thumbs-up"></i>
								{{$question->total_like}}
							</div>
							<div class="col-3">
								<i class="fa fa-thumbs-down"></i>
								{{$question->total_dislike}}
							</div>
							<div class="col-3">
								<i class="fa fa-reply"></i>
								{{$question->total_answer}}

							</div>
						</div>
					</div>

				</div>
				<hr>
				@endforeach
				<div class="row px-3 pt-3 justify-content-sm-center">{!! $questions->links() !!}</div>
			</div>
		</div>
	</div>
</main>
@endsection
