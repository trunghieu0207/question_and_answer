@extends('master')
@section('content')
<div class="container mt-5">
	<div class="card shadow">
		<div class="row px-3 pt-3">
			<div class="col-sm-1"><img src="{{asset('img/avatar')}}/{{$question->user->avatar}}" class="test rounded-circle align-middle"></div>
			<div class="col-sm-11">
				<div class="font-weight-bold" style="color:#787878; font-size: 25px">{{$question->user->fullname}}
					@if (Session::get('id')==$question->user_id)
					<i class="float-right fa fa-trash" aria-hidden="true" style="margin-right:10px; font-size: 120%; "></i>   
					<i class="float-right fa fa-pencil-square-o" aria-hidden="true" style="margin-right:10px; font-size:120%"></i>
				  	@endif
				</div>	
				<div>
					<small class="text-muted" style="color:#5488c7;">
						<i class="fa fa-calendar" aria-hidden="true"> </i> {{$question->created_at}} 
					</small>	
				</div>
				<br>
			</div>
			<div class="col-sm-12 d-flex justify-content-sm-between">
				<h3>{{$question->title}}</h3>
				<span class="badge badge-info" style="height: 20px">{{$question->categories->name}}</span>	
			</div>
			<div class="col-sm-12">			
				<p>{{$question->content}}</p>
				<div class="row" style="width: 300px; color:#787878; font-size: 20px; margin-bottom: 10px">
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
	</div>
	@if (Auth::check())
    <div class="card shadow" style="margin-top: 20px;" >
		
		<div class="card-body">
			<form>
				
				<textarea id="MyID" rows="2"></textarea>
				<i class="fa fa-paperclip fa-lg float-left"></i>
				<button type="button" class="btn btn-primary float-right" >Submit</button>
			</form>
		</div>		
	</div>
	@endif
	<div class="card shadow" style="margin-top: 20px; margin-bottom: 20px; " >
		<div class="card-header">
			<h3>Answer</h3>
		</div>
		@foreach($answers as $answer)
		<div class="row px-3 pt-3">
			
			<div class="col-sm-1">
				<img src="{{asset('img/avatar')}}/{{$answer->user->avatar}}" class="test rounded-circle align-middle">
				<br>
				<br>
				@if ($question->best_answer_id == $answer->_id)
					<div class="d-flex" style="justify-content :center; align-items:center;  font-size:200%; color:#66ad1f">
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				@endif
				
			</div>
			<div class="col-sm-11">
				@if (Session::get('id')==$answer->user_id)
				<div class="font-weight-bold" style="color:#787878; font-size: 20px">{{$answer->user->fullname}}   
					<i class="float-right fa fa-pencil-square-o" aria-hidden="true" style="margin-right:10px; font-size:120%"></i>				 
				</div>
				@endif	
				<div>
					<small class="text-muted" style="color:#5488c7;">
						<i class="fa fa-calendar" aria-hidden="true"> </i> {{$answer->created_at}} 
					</small>	
				</div>
				<br>
				<p>{{$answer->content}}</p>
				<div class="row" style=" color:#787878; font-size: 20px ; margin-bottom: 10px">
					<div class="col-sm-1">
						<i class="fa fa-thumbs-up"></i>
						{{$answer->total_like}}
					</div>
					<div class="col-sm-1">
						<i class="fa fa-thumbs-down"></i>
						{{$answer->total_dislike}}
					</div>
					@if (Session::get('id')==$question->user_id)
					<div class="col-sm-10 d-flex justify-content-sm-end">
						<a href="{{asset('bestanswer')}}/{{$answer->_id}}"><button type="button" class="float-right btn btn-success">Best Answer</button></a>
					</div>
					@endif
				</div>	
			</div>			
		</div>	
		<hr>
		@endforeach	
	</div>

</div>
@include('layout.js')
<script type="text/javascript">
	
	var simplemde = new SimpleMDE({ 
		element: document.getElementById("MyID") 
	});

</script>

@endsection