@extends('layout.master')
@section('title','Profile')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.3/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.3/js/fileinput.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.3/themes/fa/theme.min.js"></script>
	<script>
        $('#fuMain').fileinput({
            theme: 'fa',
            allowedFileExtensions: ['png', 'jpg'],
            //uploadUrl: '/upload_article_poster',
            uploadAsync: false,
            showUpload: false,
            maxFileSize: 1024,
            removeClass: 'btn btn-warning'
        });
		</script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3  sidebar-sticky" style="margin-top: 47px">
                <div class="card shadow bg-light">
                    <div class="card-body text-center">
                        <img src="{{ asset('img\resource')}}\{{ $user->avatar }}" class="avatar">
                        <h4 class="mt-2 text-primary font-weight-bold">{{ $user->fullname }}</h4>
                        <button class="badge badge-warning" data-toggle="modal" data-target="#exampleModal">change
                            avatar</button>
                        <div class="nav flex-column nav-pills my-3 bg-white border">
                            <a class="btn nav-link @yield('status1')" href="{{ asset('profile/information') }}/{{ Session::get('id') }}">Personal infomation</a>
                            <a class="btn nav-link @yield('status2')" href="{{ asset('profile/changepassword')}}/{{ Session::get('id')}}">Change password</a>
                            <a class="btn nav-link @yield('status3')">Manage question</a>
                            <a class="btn nav-link @yield('status4')">Manage answer</a>
                            <a class="btn nav-link @yield('status5')">Sign out</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 mt-5">
            <div class="card shadow bg-light">
                    <div class="card-body">
                       @yield('contentprofile')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                <form action="{{route('change_avatar')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header d-flex justify-content-between bg-primary">
                            <h3 class="text-white font-weight-bold">Change avatar</h3>
                            <button class="btn btn-warning"><i class="fa fa-upload"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="file-loading">
                                <input required id="fuMain" name="avatar" type="file">
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
<script>
        $(function () {
            jQuery.validator.addMethod("validname", function (value, element) {
                return this.optional(element) || /^[\w ]+$/i.test(value);
            }, "Alphabet, number, underscore, spaces only.");

            jQuery.validator.addMethod("validpass", function (value, element) {
                return this.optional(element) || /^\S+$/i.test(value);
            }, "Password can't contain space.");

            $('#changepass').validate({
                rules: {
                    curentpassword: {
                        required: true,
                        validpass: true,
                    },
                    newpassword: {
                        required: true,
                        validpass: true,
                        maxlength:30,
                        minlength:5
                    },
                    confirmpass: {
                        required: true,
                        equalTo: $('[name="newpassword"]')
                    
                    }
                },
                messages: {
                    curentpassword: {
                        required: 'Please enter your curent password.',
                    },
                    newpassword: {
                        required: 'Please enter your password.',
                        maxlength:'Maximum character is 30',
                        minlength:'Password must has at least 5 character.'
                    },
                    confirmpass: {
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
@endsection