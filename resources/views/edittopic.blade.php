<!DOCTYPE html>
<html>
<head>
	
	<title>Edit topic</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	@include('layout.css')
</head>
<body style="background-image: linear-gradient(60deg, #64b3f4 0%, #c2e59c 100%); background-repeat: no-repeat; background-attachment: fixed;">
	@include('layout.header')
	<div class="container mt-5">
		<div class="card shadow">
			<div class="card-header">
				<h3>Edit topic</h3>
			</div>
			<div class="card-body">
				<form method="post" action="{{action('QuestionController@update', $id)}}">
					@csrf
					<div class="form-group">
						<h5>Topic title</h5>
						<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Subject of your topic" name="title" value="{{$question->title}}">
					</div>
					<br>
					<div class="form-group">
						<h5>Category</h5>
						<select class="form-control col-sm-3" id="exampleFormControlSelect1" name="category">
							<option hidden >Choose the category</option>
							@foreach($categories as $category)
							@if($question->category_id==$category->_id)
							<option value="{{$category->_id}}" selected="selected">{{$category->name}}</option>
							@else
							<option value="{{$category->_id}}">{{$category->name}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<br>
					<label for="exampleFormControlInput1"><h5>Content</h5></label>
					<i class="fa fa-paperclip fa-lg float-right"></i>
					<textarea id="MyID" rows="3" name="content">{{$question->content}}</textarea>
					<button type="submit" class="btn btn-primary float-right" >Save changes</button>
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
</body>
</html>