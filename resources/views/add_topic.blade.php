<!DOCTYPE html>
<html>

<head>
	<title>Add topic</title>
	@include('layout.css')
</head>

<body>

	@include('layout.header')

	<div class="container mt-5">
		<div class="card shadow">

			<div class="card-header">
				<h3>Add new topic</h3>
			</div>
			
			<div class="card-body">
				<form method="post" action="{{url('addtopic')}}" id="addquestion" enctype="multipart/form-data">
					@csrf
					<!-- Start topic title -->
					<div class="form-group">
						<h5>Topic title</h5>
						<input type="text" class="form-control" id="exampleFormControlInput1" name="title" required
						placeholder="Subject of your topic (limit of 100 characters)" maxlength="100">
					</div>
					<!-- End topic title-->

					<!-- Category -->
					<div class="form-group">
						<h5>Category</h5>
						<select class="form-control col-sm-3" id="exampleFormControlSelect1" name="category">
							@foreach($categories as $category)
							<option value="{{$category->_id}}">{{$category->name}}</option>
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
								<textarea id="MyID" rows="3" name="content"></textarea>
							</div>
						</div>
					</div>
					<!-- End content-->

					<button type="button" onclick="checkContent()" class="btn btn-primary float-right">Ask</button>

				</form>
			</div>

		</div>
	</div>

	@include('layout.js')

</body>
</html>