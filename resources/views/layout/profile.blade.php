@extends('layout.master')

@section('js')
	<script>
        $('#fuMain').fileinput({
            theme: 'fa',
            allowedFileExtensions: ['png', 'jpg', 'ico'],
            //uploadUrl: '/upload_article_poster',
            uploadAsync: false,
            showUpload: false,
            maxFileSize: 5120,
            removeClass: 'btn btn-warning'
        });
	</script>
    @yield('script')
@endsection

@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-sm-3">
                <div class="card shadow bg-light">
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/avatars').'/'.Auth::user()->avatar }}" class="img-fluid" style="width: 200px;">    
                        <h4 class="mt-2 text-primary font-weight-bold">{{ Auth::user()->fullname }}</h4>
                        <button class="badge btn btn-warning" data-toggle="modal" data-target="#exampleModal">Change
                            avatar</button>
                        <div class="nav flex-column nav-pills my-3 bg-white border">
                            <a href="{{ route('information') }}" class="btn nav-link @if(!empty($active_personal_info)) active @endif" >Personal information</a>
                            <a href="{{ route('changePassword') }}" class="btn nav-link @if(!empty($active_change_pass)) active @endif">Change password</a>
                            <a href="{{ route('manageQuestion') }}" class="btn nav-link @if(!empty($active_manage_question)) active @endif">Manage questions</a>
                            <a href="{{ route('manageAnswer') }}" class="btn nav-link @if(!empty($active_manage_answer)) active @endif">Manage answers</a>

                            <a href="{{ route('logOut') }}" class="btn nav-link">Sign out</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 w-100">
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
                <form action="{{route('changeAvatar')}}" method="post" enctype="multipart/form-data">
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
