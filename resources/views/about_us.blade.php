
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>About us</title>
	<link rel="stylesheet" href="">
	@include('layout.css')
	<style type="text/css" media="screen">
		body{
			background-color: #323940;
		}
		.avt-lead{
			width: 150px;
			height: 150px;
			float: left;
			box-sizing: border-box;

		}

		.avt-mem{
			width: 150px;
			height: 150px;
			float: left;
			margin-left: 35px;
			box-sizing: border-box;
		}
	</style>
</head>
<body>
	@include('layout.header')
	<main>
		<div class="container mt-5">

			<div class="row pt-3 px-3">
				<div class="col-sm-3">
					<img src="{{asset('images/resource/logo2a.png')}}" alt="">
				</div>
				<div class="col-sm-9">

					<h3 class="font-weight-bold" style="color:#fcbf10;">Mission</h3>
					<p class="text-justify" style="font-size:20px; color: white;">TechSolution was born with the mission to bring technology enthusiasts an open environment to exchange, develop together, share difficulties and find solutions.</p>
				</div>
			</div>

			<div class="row pt-3 px-3">
				<div class="col-sm-9">
					<h3 class="font-weight-bold" style="color:#fcbf10;">Ant man team</h3>
					<p class="text-justify" style="font-size:20px; color: white;">Ant man team is a group of young people, students from many universities in Ho Chi Minh City, Vietnam. We are led by an experienced programmer. We share the same passion for technology, desire to create practical technology products for the community.</p>

				</div>
				<div class="col-sm-3">
					<img src="{{asset('images/resource/2525012-256.png')}}" alt="">

				</div>
			</div>
			<br>
			<br>

			<h3 class="text-center font-weight-bold" style="color:#fcbf10;">Why is Ant man?</h3>
			<p class="text-justify px-3" style="font-size:20px;color: white;">Ants are a pack animal habitat, relying on hard strength to do things that seem impossible to them. Ant man team learns how to work like ants, relying on the strength of the collective to conquer challenges even the most difficult</p>
			<br>
			<br>
			<h3 class="text-center font-weight-bold" style="color:#fcbf10;">Members</h3>
			<br>
			<div class="d-flex justify-content-center"><img src="{{asset('images/resource/mrlong.png')}}" class="avt-lead rounded-circle align-middle"></div>
			<br>
			<h6 class="text-center" style="color:white;">Mr. Truong Quoc Long (Leader)</h6>
			<br>
			<br>
			<br>
			<div class="row px-3" >				
				<div class="col-sm-3">

					<div class="row">
						<img src="{{asset('images/resource/long.png')}}" class="avt-mem rounded-circle align-middle">
					</div>
					<br>
					<div class="row" style="margin-left: 35px;">
						<h6 style="color:white;">Lam Thanh Long</h6>
					</div>

				</div>
				<div class="col">
					<div class="row">
						<img src="{{asset('images/resource/hieu.png')}}" class="avt-mem rounded-circle align-middle">
					</div>
					<br>
					<div class="row" style="margin-left: 35px;">
						<h6 style="color:white;">Dang Trung Hieu</h6>
					</div>

				</div>
				<div class="col-sm-3">
					<div class="row">
						<img src="{{asset('images/resource/nhat.png')}}" class="avt-mem rounded-circle align-middle">
					</div>
					<br>
					<div class="row" style="margin-left: 10px;">
						<h6 style="color:white;">Nguyen Thi Thanh Nhat</h6>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="row">
						<img src="{{asset('images/resource/viet.png')}}" class="avt-mem rounded-circle align-middle">
					</div>
					<br>
					<div class="row" style="margin-left: 35px;">
						<h6 style="color:white;">Pham Hoang Viet</h6>
					</div>

				</div>
			</div>
		</div>

	</div>
</div>
</div>
</main>

@include('layout.js')
</body>
</html>

