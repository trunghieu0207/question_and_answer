<!DOCTYPE html>
<html>
<head>
	<title>Add topic</title>
	<link rel="stylesheet" href="{{asset('css/style.css')}}">
	@include('layout.css')
</head>
<body style="background-image: linear-gradient(60deg, #64b3f4 0%, #c2e59c 100%); background-repeat: no-repeat; background-attachment: fixed;">
	@include('layout.header')
	<div class="container mt-5">
		<div class="card shadow">
			<div class="card-header">
				<h3>Add new topic</h3>
			</div>
			<div class="card-body">
				<form method="post" action="{{url('addtopic')}}" class="needs-validation" novalidate>
					@csrf
					<div class="form-group">
						<h5>Topic title</h5>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="title" required placeholder="Subject of your topic (limit of 100 characters)" maxlength = "100">
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please enter the topic title!</div>
					</div>
					<div class="form-group">
						<h5>Category</h5>
						<select class="form-control col-sm-3" id="exampleFormControlSelect1" name="category" required>
							<option value="" selected disabled>Choose the category</option>
							@foreach($categories as $category)
							<option value="{{$category->_id}}">{{$category->name}}</option>
							@endforeach
						</select>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please choose the category!</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1"><h5>Content</h5></label>
						<i class="fa fa-paperclip fa-lg float-right"></i>
						<textarea id="MyID" rows="3" name="content" required></textarea>
						<div id="required_content" style="font-size: 14px;color: red;"></div>
					</div>
					<button type="submit" class="btn btn-primary float-right" onclick="CheckContent()" >Create topic</button>
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
			else
			{
				document.getElementById("required_content").innerHTML="";
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