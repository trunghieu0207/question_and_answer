<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>About us</title>
    <link rel="stylesheet" href="">
    @include('layout.css')
    <style type="text/css" media="screen">
        body {
            background-color: #323940;
        }
        .avt-mem {
            width: 150px;
            height: 150px;
            box-sizing: border-box;
        }

    </style>
</head>

<body>
    @include('layout.header')
    <div style="background-image: url('{{asset('images/resource/Downhill.jpg')}}');background-repeat: no-repeat;background-size: 100%;height:650px">
        <div class="container h-100">
            <div class="row d-flex align-items-center h-100">
                <div class="col-sm-3" style="border-right-style: solid;border-right-width:5px;border-right-color:blue">
					<img class="h-100 w-100" src="{{asset('images/resource/logo2a.png')}}">
                </div>
                <div class="col-sm-9">
                    <h1 class="text-primary font-weight-bold bg-light" style="max-width:225px">Our mission</h1>
                    <p class="font-weight-bold text-justify text-light bg-dark p-3" style="font-size:20px;">TechSolution was born with the mission
                        to bring technology enthusiasts an open environment to exchange, develop together, share difficulties and find solutions.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row d-flex align-items-center">
            <div class="col-sm-9">
                <h3 class="font-weight-bold" style="color:#fcbf10;">We are Antman team</h3>
                <p class="text-justify" style="font-size:20px; color: white;">Antman team is a group of young people,
					students from many universities in Ho Chi Minh City, Vietnam. We join internship program of cybozu 2019.
					In there our team are founded randomly. Together we build this system for experence, for our passion...
				</p>

            </div>
            <div class="col-sm-3">
                <img src="{{asset('images/resource/2525012-256.png')}}">
            </div>
        </div>
        <br>
        <br>

        <h3 class="text-center font-weight-bold" style="color:#fcbf10;">Why is Antman?</h3>
		<p class="text-center text-justify px-3" style="font-size:20px;color: white;">Ant is the bigest community in the world, 
		relying on herd strength to do things that seem impossible to them
		.We want to have their power, but we still want to be a human so Antman team were born.</p>
        <br>
        <br>
        <h3 class="font-weight-bold" style="color:#fcbf10;">Members</h3>
        <br>
        <div class="d-flex justify-content-center">
			<img src="{{asset('images/resource/mrlong.png')}}"
                class="avt-mem rounded-circle align-middle">
		<h3 class="ml-2 d-flex align-items-center" style="color:white;">Mr. Truong Quoc Long <br>(Mentor)</h3>
		</div>
        <br>
        <br>
		<br>
        <div class="row mb-5">
            <div class="col-sm">
                <div class="row d-flex justify-content-center">
                    <img src="{{asset('images/resource/long.png')}}" class="avt-mem rounded-circle align-middle">
                </div>
                <br>
                <div class="row d-flex justify-content-center">
                    <h6 class="text-center" style="color:white;">Lam Thanh Long<br>(HCMUS)</h6>
                </div>
            </div>
            <div class="col-sm">
                <div class="row d-flex justify-content-center">
                    <img src="{{asset('images/resource/hieu.png')}}" class="avt-mem rounded-circle align-middle">
                </div>
                <br>
                <div class="row d-flex justify-content-center">
                    <h6 class="text-center" style="color:white;">Dang Trung Hieu<br>(IUH)</h6>
                </div>

            </div>
            <div class="col-sm">
                <div class="row d-flex justify-content-center">
                    <img src="{{asset('images/resource/nhat.png')}}" class="avt-mem rounded-circle align-middle">
                </div>
                <br>
                <div class="row d-flex justify-content-center">
                    <h6 class="text-center" style="color:white;">Nguyen Thi Thanh Nhat<br>(HCMUT)</h6>
                </div>
            </div>
            <div class="col-sm">
                <div class="row d-flex justify-content-center">
                    <img src="{{asset('images/resource/viet.png')}}" class="avt-mem rounded-circle align-middle">
                </div>
                <br>
                <div class="row d-flex justify-content-center">
                    <h6 class="text-center" style="color:white;">Pham Hoang Viet<br>(HCMUTE)</h6>
                </div>

            </div>
        </div>
    </div>

    </div>
    </div>
    </div>

    @include('layout.js')
</body>

</html>
