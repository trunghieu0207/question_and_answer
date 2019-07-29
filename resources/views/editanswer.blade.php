@extends('layout.master')
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
        //allowedFileExtensions: ['png', 'jpg'],
        //uploadUrl: '/upload_article_poster',
        uploadAsync: false,
        showUpload: false,
        maxFileSize: 1024,
        removeClass: 'btn btn-warning'
    });

    var simplemde = new SimpleMDE({
        element: document.getElementById("MyID")
    });

    function CheckContent() {
        if (simplemde.value() != "") {
            document.getElementById("editanswer").submit();
        }
    }

</script>
@endsection
@section('content')
<div class="container mt-5">
    <div class="card shadow">
        @foreach($question as $val)
        <div class="row px-3 pt-3">
            <div class="col-sm-1"><img src="{{asset('img/avatar')}}/{{$val->user->avatar}}"
                    class="test rounded-circle align-middle"></div>
            <div class="col-sm-11">

                <div class="font-weight-bold" style="color:#787878; font-size: 25px">{{$val->user->fullname}}
                </div>
                <div>
                    <small class="text-muted" style="color:#5488c7;">
                        <i class="fa fa-calendar" aria-hidden="true"> </i> {{$val->created_at}}
                    </small>
                </div>
                <br>
            </div>
            <div class="col-sm-12 d-flex justify-content-sm-between">
                <h3>{{$val->title}}</h3>
                <span class="badge badge-info" style="height: 20px">{{$val->category->name}}</span>
            </div>
            <div class="col-sm-12">
                <p>{{$val->content}}</p>
                <div class="row" style="width: 300px; color:#787878; font-size: 20px; margin-bottom: 10px">
                    <div class="col-sm">
                        <i class="fa fa-thumbs-up"></i>
                        {{$val->total_like}}
                    </div>
                    <div class="col-sm">
                        <i class="fa fa-thumbs-down"></i>
                        {{$val->total_dislike}}
                    </div>
                    <div class="col-sm">
                        <i class="fa fa-reply"></i>
                        {{$val->total_answer}}
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="card shadow" style="margin-top: 20px; margin-bottom: 20px;">

        <div class="card-body">
            <form id="editanswer" method="post" action="{{action('AnswerController@update', $id)}}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <div class="file-loading">
                            <input id="fuMain" name="attachment" type="file">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group">
                            <textarea id="MyID" rows="2" name="content">{{$answer->content}}</textarea>
                            <div id="required_content" style="font-size: 14px;color: red;"></div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary float-right" onclick="CheckContent()">Save changes</button>
            </form>
        </div>
    </div>

</div>
@endsection
