@extends('master')
@section('content')
<div class="container mt-5">
	<div class="card shadow">
		<div class="row px-3 pt-3">
			<div class="col-sm-1"><img src="img/avatar/{{$question->user->avatar}}" class="test rounded-circle align-middle"></div>
			<div class="col-sm-11">
				<div class="font-weight-bold" style="color:#787878; font-size: 25px">{{$question->user->fullname}}
					<i class="float-right fa fa-trash" aria-hidden="true" style="margin-right:10px; font-size: 120%; "></i>   
					<i class="float-right fa fa-pencil-square-o" aria-hidden="true" style="margin-right:10px; font-size:120%"></i>
				  	
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
	<div class="card shadow">
		<div class="row px-3 pt-3">
			<div class="col-sm-1"><img src="img/avatar/{{$question->user->avatar}}" class="test rounded-circle align-middle"></div>
			<div class="col-sm-11">
				<div class="font-weight-bold" style="color:#787878; font-size: 20px">{{$answer->user->fullname}}   
					<i class="float-right fa fa-pencil-square-o" aria-hidden="true" style="margin-right:10px; font-size:120%%"></i>
				  	
				</div>	
				<div>
					<small class="text-muted" style="color:#5488c7;">
						<i class="fa fa-calendar" aria-hidden="true"> </i> {{$answer->created_at}} 
					</small>	
				</div>
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
					<div class="col-sm-10 d-flex justify-content-sm-end">
						<button type="button" class="float-right btn btn-success">Best Answer</button>
					</div>
					
				</div>
				
			</div>
		</div>
			
		
			
	</div>
</div>

@endsection