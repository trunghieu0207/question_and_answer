<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
    @include('css')
    <title>Register</title>
</head>

<body background="{{ asset('img/resource/sky.jpg') }}" style="height: 100%">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="card shadow">
            <div class="card-header">
                <div class="row">
                    <div class="col-1"></div>
                    <div class="col-3">
                        <img src="{{ asset('img/resource/ask.ico') }}" alt="" class="h-100 w-100">
                    </div>
                    <div class="col-8 mt-3">
                        <h4 class="font-weight-bold">Anything Register</h4>
                        <small>There are no matter in the world where you live!</small>
                    </div>
                </div>
            </div>
            <div class="card-body pr-5 pl-5 pb-5">
                <form id="registerform">
                    <div class="form-group">
                        <label class="font-weight-bold">Email address:</label>
                        <input name="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Password:</label>
                        <input name="password" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Confirm password:</label>
                        <input name="confirm" type="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Fullname:</label>
                        <input name="name" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100 font-weight-bold">Create
                            account</button>
                    </div>
                    <div class="text-center">
                        Already have an account? <a href="">login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function () {
            $('#registerform').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "",
                            type: "get",
                            data: {
                                email: function () {
                                    return $("#email").val();
                                }
                            },
                        }
                    },
                    password: {
                        required: true,
                    },
                    confirm: {
                        required: true,
                        equalTo: $('[name="password"]')
                    }
                },
                messages: {
                    name: {
                        required: 'Please enter your fullname.'
                    },
                    email: {
                        required: 'Please enter your email.',
                        email: 'Your email is invalid!',
                        remote: 'This email has been taken!'
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