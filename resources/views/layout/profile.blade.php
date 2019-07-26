@extends('layout.master')
@section('title','Profile')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3  sidebar-sticky" style="margin-top: 47px">
                <div class="card shadow bg-light">
                    <div class="card-body text-center">
                        <img src="img\resource\default_avatar.png" class="avatar">
                        <h4 class="mt-2 text-primary font-weight-bold">Name?</h4>
                        <button class="badge badge-warning" data-toggle="modal" data-target="#exampleModal">change
                            avatar</button>
                        <div class="nav flex-column nav-pills my-3 bg-white border">
                            <button class="btn nav-link @yield('status1')">Personal infomation</button>
                            <button class="btn nav-link @yield('status2')">Change password</button>
                            <button class="btn nav-link @yield('status3')">Manage question</button>
                            <button class="btn nav-link @yield('status4')">Manage answer</button>
                            <button class="btn nav-link @yield('status5')">Sign out</button>
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
@endsection