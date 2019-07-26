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
				<form>
					<div class="form-group">
						<h5>Topic title</h5>
						<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Subject of your topic">
					</div>
					<div class="form-group">
						<h5>Category</h5>
						<select class="form-control col-sm-3" id="exampleFormControlSelect1">
							<option hidden >Choose the category</option>
							<option>Front-end</option>
							<option>Back-end</option>
							<option>Fullstack</option>
							<option>Mobile</option>
						</select>
					</div>
					<label for="exampleFormControlInput1"><h5>Content</h5></label>
					<i class="fa fa-paperclip fa-lg float-right"></i>
					<textarea id="MyID" rows="3"></textarea>
					<button type="button" class="btn btn-primary float-right" >Create topic</button>
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