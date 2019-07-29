	@extends('layout.profile')
@section('status1','active')
@section('contentprofile')
		<div class="row">
			<div class="col-sm-12">
				<div class="" style="text-align: center;">
					<h2 class="text-primary ">PERSONAL INFORMATION</h2>	
				</div>
				<hr class="my-3">
				<div class="row">
					<div class="col-sm-2"></div>
					<div class="col-sm-8">
					<form action="" method="post">
						<div class="form-group">
					    	<label for="email" class="font-weight-bold">Email</label>
					    	<input type="email" class="form-control" value="user@mail.com" name="email" disabled>
						</div>
						<div class="form-group">
					    	<label for="fullname" class="font-weight-bold">Fullname</label>
					    	<input type="text" class="form-control" value="User1" name="fullname">
						</div>
						<div class="form-group">
							<label for="aboutme" class="font-weight-bold">About me</label>
							<textarea class="form-control" rows="5" name="aboutme">None</textarea>
						</div>
					  	<div class="d-flex justify-content-center">
					  		<button type="submit" class="btn btn-primary ">Save</button>
					  		<button type="reset" class="btn btn-outline-primary " style="margin-left: 10px; ">Reset</button>
						</div>
					</form>
					</div>
				</div>
			</div>
		</div>
@endsection
