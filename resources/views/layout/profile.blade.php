<!DOCTYPE html>
<html lang="en" style="height: 100%">

<head>
    @include('layout.css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.0.3/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <title>Profile</title>
</head>

<body class="main-background">
    @include('layout.header')
    <div class="container">
        <div class="row">
            <div class="col-sm-3  sidebar-sticky" style="margin-top: 31px">
                <div class="card shadow bg-light">
                    <div class="card-body text-center">
                        <img src="img\resource\default_avatar.png" width="200px">
                        <h4 class="mt-2 text-primary font-weight-bold">Name?</h4>
                        <button class="badge badge-warning" data-toggle="modal" data-target="#exampleModal">change
                            avatar</button>
                        <div class="nav flex-column nav-pills my-3 bg-white border">
                            <button class="btn nav-link active">Personal infomation</button>
                            <button class="btn nav-link">Change password</button>
                            <button class="btn nav-link">Manage question</button>
                            <button class="btn nav-link">Manage answer</button>
                            <button class="btn nav-link">Sign out</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 mt-5">
            <div class="card shadow bg-light">
                    <div class="card-body">
                        your code here....
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
                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header d-flex justify-content-between bg-primary">
                            <h3 class="text-white font-weight-bold">Change avatar</h3>
                            <button class="btn btn-warning"><i class="fa fa-upload"></i></button>
                        </div>
                        <div class="card-body">
                            <div class="file-loading">
                                <input required id="fuMain" name="wallpaper" type="file">
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    @include('layout.js')
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
</body>

</html>
