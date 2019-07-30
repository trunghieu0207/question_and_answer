@extends('layout.master')
@section('css')

@endsection
@section('js')

@endsection
@section('content')

<div class="container mt-5">
	<div class="card shadow">

		<div class="card-header">
			<h3>Edit topic</h3>
		</div>

		<div class="card-body">
			<form method="post" action="{{url('edittopic')}}" id="addquestion" enctype="multipart/form-data">
				@csrf
				<!-- Start topic title -->
				<input type="text" name="id" hidden value="{{$question->id}}">
				<div class="form-group">
					<h5>Topic title</h5>
					<input type="text" class="form-control" id="exampleFormControlInput1" name="title" required
					placeholder="Subject of your topic (limit of 100 characters)" maxlength="100" value="{{ $question->title }}">
				</div>
				<!-- End topic title-->

				<!-- Category -->
				<div class="form-group">
					<h5>Category</h5>
					<select class="form-control col-sm-3" id="exampleFormControlSelect1" name="category">
						@foreach($categories as $category)
						@if($question->category_id==$category->_id)
						<option value="{{$category->_id}}" selected="selected">{{$category->name}}</option>
						@else
						<option value="{{$category->_id}}">{{$category->name}}</option>
						@endif
						@endforeach
					</select>
				</div>
				<!-- End category-->

				<!-- Content -->
				<label for="exampleFormControlInput1">
					<h5>Content</h5>
				</label>
				<div class="row">
					<div class="col-sm-4">
						<div class="file-loading">
							<input id="fuMain" name="attachment" type="file">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="form-group">
							<textarea id="MyID" rows="3" name="content">{{ $question->content }}</textarea>
						</div>
					</div>
				</div>
				<!-- End content-->

				<button type="button" onclick="checkContent()" class="btn btn-primary float-right">Update</button>

			</form>
		</div>

	</div>
</div>

@endsection