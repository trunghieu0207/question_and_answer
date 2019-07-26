@extends('master')
@section('content')
<div class="container mt-5">
	<div class="card shadow">
		@foreach($question as $val)
		<div class="row px-3 pt-3">
			<div class="col-sm-1"><img src="{{asset('img/avatar')}}/{{$question->user->avatar}}" class="test rounded-circle align-middle"></div>
			<div class="col-sm-11">
				
				<div class="font-weight-bold" style="color:#787878; font-size: 25px">{{$val->user->fullname}}
				</div>	
				<div>
					<small class="text-muted" style="color:#5488c7;">
						<i class="fa fa-calendar" aria-hidden="true"> </i> {{$val->created_at}} 
					</small>	
				</div>
				<br>
			</div>
			<div class="col-sm-12 d-flex justify-content-sm-between">
				<h3>{{$question->title}}</h3>
				<span class="badge badge-info" style="height: 20px">{{$val->categories->name}}</span>	
			</div>
			<div class="col-sm-12">			
				<p>{{$question->content}}</p>
				<div class="row" style="width: 300px; color:#787878; font-size: 20px; margin-bottom: 10px">
					<div class="col-sm">
						<i class="fa fa-thumbs-up"></i>
						{{$val->total_like}}
					</div>
					<div class="col-sm">
						<i class="fa fa-thumbs-down"></i>
						{{$val->total_dislike}}
					</div>
					<div class="col-sm">
						<i class="fa fa-reply"></i>
						{{$val->total_answer}}
					</div>
				</div>
			</div>			
		</div>
		@endforeach
	</div>
	
	<div class="card shadow" style="margin-top: 20px; margin-bottom: 20px;" >
		
		<div class="card-body">
			<form>
				
				<textarea id="MyID" rows="2"></textarea>
				<i class="fa fa-paperclip fa-lg float-left"></i>
				<button type="button" class="btn btn-primary float-right" >Submit</button>
			</form>
		</div>		
	</div>

</div>
@include('layout.js')
<script type="text/javascript">
	
	var simplemde = new SimpleMDE({ 
		element: document.getElementById("MyID") 
	});

</script>

@endsection