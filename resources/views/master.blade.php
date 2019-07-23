<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
    <link rel="icon" href="project/img/logo2a.png" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="ask.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>SignIn</title>
    </style>
</head>




@yield('content')


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(function () {
            $('#registerform').validate({
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