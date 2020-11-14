@extends('layout.log')
@section('title','Register')

@section('js')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ asset('js/handler.js') }}"></script>
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center h-100">
    <div class="card shadow">
        <div class="card-header" style="width: 500px">
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-3">
                    <a href="{{route('homePage')}}">
                        <img src="{{ asset('images/resource/logo2a.png') }}" alt="" class="h-100 w-100"></a>
                </div>
                <div class="col-sm-7 mt-3">
                    <h4 class="font-weight-bold">TechSolution Register</h4>
                    <small>There is no matter in the world you live!</small>
                </div>
            </div>
        </div>
        <div class="card-body pr-5 pl-5 pb-5">
            <form id="registerform" action="{{ route('signUpStore') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="font-weight-bold" for="email">Email address:</label>
                    <input id="email" name="email" type="email" class="form-control" aria-describedby="emailHelp"
                        placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="password">Password:</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="confirm">Confirm password:</label>
                    <input id="confirm" name="confirm" type="password" class="form-control"
                        placeholder="Confirm password">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold" for="fullname">Full name:</label>
                    <input id="fullname" name="fullname" type="text" class="form-control" aria-describedby="emailHelp"
                        placeholder="Your Fullname">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-9">
                            {!! app('captcha')->display() !!}
                            @if (count($errors)>0)
                            @foreach($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary w-100 font-weight-bold">Create account</button>
                </div>
                <div class="text-center">
                    Already have an account? <a href="{{route('signInIndex')}}">Login here</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
