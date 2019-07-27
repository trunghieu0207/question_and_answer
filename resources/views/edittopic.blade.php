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
				<form method="post" action="{{action('QuestionController@update', $id)}}" class="needs-validation" novalidate>
					@csrf
					<div class="form-group">
						<h5>Topic title</h5>
						<input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Subject of your topic" name="title" value="{{$question->title}}" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please enter the topic title!</div>
					</div>
					<br>
					<div class="form-group">
						<h5>Category</h5>
						<select class="form-control col-sm-3" id="exampleFormControlSelect1" name="category" required>
							<option hidden >Choose the category</option>
							@foreach($categories as $category)
							@if($question->category_id==$category->_id)
							<option value="{{$category->_id}}" selected="selected">{{$category->name}}</option>
							@else
							<option value="{{$category->_id}}">{{$category->name}}</option>
							@endif
							@endforeach
						</select>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please choose the category!</div>
					</div>
					<br>
					<div class="form-group">
						<label for="exampleFormControlInput1"><h5>Content</h5></label>
						<i class="fa fa-paperclip fa-lg float-right"></i>
						<textarea id="MyID" rows="3" name="content">{{$question->content}}</textarea>
						<div id="required_content" style="font-size: 14px;color: red;"></div>
					</div>
					<button type="submit" class="btn btn-primary float-right" onclick="CheckContent()" >Save changes</button>
				</form>
			</div>
		</div>
	</div>
	@include('layout.js')
	<script type="text/javascript">

		var simplemde = new SimpleMDE({ 
			element: document.getElementById("MyID") 
		});
		
		function CheckContent()
		{
			if(simplemde.value()=="")
			{
				document.getElementById("required_content").innerHTML="Please enter the content!";
			}
		}


// Disable form submissions if there are invalid fields
(function() {
	'use strict';
	window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
    	form.addEventListener('submit', function(event) {
    		if (form.checkValidity() === false) {
    			event.preventDefault();
    			event.stopPropagation();
    		}
    		form.classList.add('was-validated');
    	}, false);
    });
}, false);
})();
</script>
</body>
</html>