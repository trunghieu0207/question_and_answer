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
				<form method="post" action="{{url('addtopic')}}">
					@csrf
					<div class="form-group">
						<h5>Topic title</h5>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Subject of your topic">
					</div>
					<div class="form-group">
						<h5>Category</h5>
						<select class="form-control col-sm-3" id="exampleFormControlSelect1" name="category">
							<option hidden >Choose the category</option>
							@foreach($categories as $category)
							<option value="{{$category->_id}}">{{$category->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label for="exampleFormControlInput1"><h5>Content</h5></label>
						<i class="fa fa-paperclip fa-lg float-right"></i>
						<textarea id="MyID" rows="3" name="content"></textarea>
					</div>
					<button type="submit" class="btn btn-primary float-right" >Create topic</button>
				</form>
				<form class="fileUpload" method="POST" action="{{ route('fileUploadPost') }}" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<input name="file" id="poster" type="file" class="form-control"><br/>
						<div class="progress">
							<div class="bar"></div >
							<div class="percent">0%</div >
						</div>
						<input type="submit"  value="Submit" class="btn btn-success">
					</div>
				</form>    
			</div>
		</div>
	</div>
	@include('layout.js')
	<script type="text/javascript">
		
		var simplemde = new SimpleMDE({ 
			element: document.getElementById("MyID") 
		});

		function validate(formData, jqForm, options) {
			var form = jqForm[0];
			if (!form.file.value) {
				alert('File not found');
				return false;
			}
		}

		(function() {
			var bar = $('.bar');
			var percent = $('.percent');
			var status = $('#status');

			$('.fileUpload').ajaxForm({
				beforeSubmit: validate,
				beforeSend: function() {
					status.empty();
					var percentVal = '0%';
					var posterValue = $('input[name=file]').fieldValue();
					bar.width(percentVal)
					percent.html(percentVal);
				},
				
				complete: function(xhr) {
					status.html(xhr.responseText);
					alert('Uploaded Successfully');
					window.location.href = "/addtopic";
				}
			});
		})();
	</script>
</body>
</html>