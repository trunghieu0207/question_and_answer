@extends('master')
@section('content')
<body background="project/img/sky.jpg" style="height: 100%">
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="card shadow" style ="width:400px;">
            <div class="card-header">
                <div class="row">
                    
                    <div class="col-4">
                        <img src="project/img/logo2a.png" alt="" class="w-100" style="margin-top: 10px" >
                    </div>
                    <div class="col-8 mt-3">
                        <h4 class="font-weight-bold">Welcome To Q&A Forum</h4>
                        <small>Ask anything you want!</small>
                    </div>
                </div>
            </div>
            <div class="card-body pr-5 pl-5 pb-5">
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                <form id="registerform" action="{{route('post-signin')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">    
                    <div class="form-group">
                        <label class="font-weight-bold">Email:</label>
                        <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password:</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100 font-weight-bold">Sign In</button>
                    </div>
                    <div class="text-center">
                        Hasn't had an account? <a href="">Sign up here</a>
                    </div>
                </form>
            </div>
        </div>
@endsection