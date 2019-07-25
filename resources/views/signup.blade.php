<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
    @include('layout/css')
    <title>Register</title>
</head>

<body background="{{ asset('img/resource/sky.jpg') }}" style="height: 100%">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card shadow">
            <div class="card-header" style="width: 500px">
                <div class="row">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-3">
                        <a href="{{route('home-page')}}">
                            <img src="{{ asset('img/resource/logo2a.png') }}" alt="" class="h-100 w-100"></a>
                    </div>
                    <div class="col-sm-7 mt-3">
                        <h4 class="font-weight-bold">TechSolution Register</h4>
                        <small>There is no matter in the world you live!</small>
                    </div>
                </div>
            </div>
            <div class="card-body pr-5 pl-5 pb-5">
                <form id="registerform" action="{{ route('postSignUp') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="font-weight-bold">Email address:</label>
                        <input id="email" name="email" type="email" class="form-control" aria-describedby="emailHelp"
                            placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password:</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Confirm password:</label>
                        <input name="confirm" type="password" class="form-control" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Full name:</label>
                        <input name="fullname" type="text" class="form-control" aria-describedby="emailHelp"
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
                        Already have an account? <a href="{{route('sign-in')}}">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('layout/js')
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function () {
            jQuery.validator.addMethod("validname", function (value, element) {
                return this.optional(element) || /^[A-Za-z0-9_ ]+$/i.test(value);
            }, "Alphabet, number, underscore, spaces only.");

            jQuery.validator.addMethod("validpass", function (value, element) {
                return this.optional(element) || /^\S+$/i.test(value);
            }, "Password can't contain space.");

            $('#registerform').validate({
                rules: {
                    fullname: {
                        required: true,
                        validname: true
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "{{ route('validEmail') }}",
                            type: "get",
                            data: {
                                email: function () {
                                    return $("#email").val();
                                }
                            }
                        }
                    },
                    password: {
                        required: true,
                        validpass: true,
                    },
                    confirm: {
                        required: true,
                        equalTo: $('[name="password"]')

                    }
                },
                messages: {
                    fullname: {
                        required: 'Please enter your fullname.',
                    },
                    email: {
                        required: 'Please enter your email.',
                        email: 'Your email is invalid.',
                        remote: 'This email has been taken.'
                    },
                    password: {
                        required: 'Please enter your password.',
                    },
                    confirm: {
                        required: 'Please comfirm your password.',
                        equalTo: "Your password isn't matched."
                    }
                },
                errorElement: 'small',
                errorClass: 'help-block text-danger mt-2',
                validClass: 'is-valid',
                highlight: function (e) {
                    $(e).removeClass('is-valid').addClass('is-invalid');
                },
                unhighlight: function (e) {
                    $(e).removeClass('is-invalid').addClass('is-valid');
                }
            });
        })

    </script>
</body>

</html>
