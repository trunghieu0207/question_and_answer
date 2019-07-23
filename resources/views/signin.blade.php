<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
    @include('layout.css')
    <title>SignIn</title>
    </style>
</head>


<body background="img/resource/sky.jpg" style="height: 100%">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="card shadow" style ="width:400px;">
            <div class="card-header">
                <div class="row">
                    
                    <div class="col-4">
                        <a href="{{route('home-page')}}">
                        <img src="img/resource/logo2a.png" alt="" class="w-100" style="margin-top: 15px;margin-left:15px" ></a>
                    </div>
                    <div class="col-8 mt-3">
                        <h4 class="font-weight-bold">Welcome to TechSolution</h4>
                        <small>Ask anything you want!</small>
                    </div>
                </div>
            </div>
            <div class="card-body pr-5 pl-5 pb-5">
                
                
                <form id="signinform" action="{{route('post-signin')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">    
                    <div class="form-group">
                        <label class="font-weight-bold">Email:</label>
                        <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password:</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <!-- @if (Session::has('error'))
                        <div class="alert alert-danger"> {{Session::get('error')}} </div>
                    @endif -->
                    @if($errors->any())
                        <div class="alert alert-danger">{{$errors->first()}}</div>
                    @endif
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100 font-weight-bold">Sign In</button>
                    </div>
                    <div class="text-center">
                        Hasn't had an account? <a href="{{route('getSignUp')}}">Sign up here</a>
                    </div>
                </form>
            </div>

        </div>

    @include('layout.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function () {
            $('#signinform').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                    },
                    
                },
                messages: {
                   
                    email: {
                        required: 'Please enter your email.',
                        email: 'Your email is invalid!',
                        
                    },
                    password: {
                        required: 'Please enter your password.',
                    },
                    
                },
                errorElement: 'small',
                errorClass: 'help-block text-danger mt-2',
                validClass: 'is-valid',
                highlight: function (e) {
                    $(e).addClass('is-invalid');
                },
                unhighlight: function (e) {
                    $(e).removeClass('is-invalid');
                }
            });
        })

    </script>
</body>

</html>