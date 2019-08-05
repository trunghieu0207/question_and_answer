@extends('layout.master')

@section('title', 'Edit answer')

@section('js')
    <script>
        $('#fuMain').fileinput({
        theme: 'fa',
                //allowedFileExtensions: ['png', 'jpg'],
                //uploadUrl: '/upload_article_poster',
                uploadAsync: false,
                showUpload: false,
                maxFileSize: 5120,
                removeClass: 'btn btn-warning'
            });
    var simplemde = new SimpleMDE({
        element: document.getElementById("MyID")
    });

    function checkContent() {
        if (simplemde.value() != "") {
            document.getElementById("editanswer").submit();
        }
    }

</script>
@endsection

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="row px-3 pt-3">
            <div class="col-sm-1"><img src="{{asset('images/avatars')}}/{{$question->user->avatar}}"
                    class="test rounded-circle align-middle"></div>
            <div class="col-sm-11">

            <a href="/personalinfomation/{{ $question->user->_id }}" style="color:#787878; font-size: 20px">{{$question->user->fullname}}</a>
                <div>
                    <small class="text-muted" style="color:#5488c7;">
                        <i class="fa fa-calendar" aria-hidden="true"> </i> {{$question->date_convert}}
                    </small>
                </div>
                <br>
            </div>
            <div class="col-sm-12">
            <h3 class="text-primary font-weight-bold d-flex justify-content-sm-between">
                    <div style="max-width:950px">{{$question->title}}</div> 
                    <span class="badge badge-info d-flex" style="height: 32px">{{$question->category->name}}</span>
                </h3>
            </div>
            <div class="col-sm-12">
                <p>{!! $question->content !!}</p>
                @if($question->attachment_path)
                <b class="badge badge-warning">Attachment:</b>
                <a target="blank"
                    href="{{asset('files/'.$question->attachment_path)}}"><i>{{substr($question->attachment_path,strlen($question->attachment_path)-$limit)}}</i></a>
                @endif
                <div class="row" style="width: 300px; color:#787878; font-size: 20px; margin-bottom: 10px">
                    <div class="col-sm">
                        <i class="fa fa-thumbs-up"></i>
                        {{$question->total_like}}
                    </div>
                    <div class="col-sm">
                        <i class="fa fa-thumbs-down"></i>
                        {{$question->total_dislike}}
                    </div>
                    <div class="col-sm">
                        <i class="fa fa-reply"></i>
                        {{$question->total_answer}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow" style="margin-top: 20px; margin-bottom: 20px;">

        <div class="card-body">
            <form id="editanswer" method="post" action="{{ url('editanswer') }}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="id" hidden value="{{$answer->id}}">
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
                @if($answer->attachment_path)
					<b class="badge badge-warning">Attachment:</b>
					<a target="blank" href="{{asset('files/'.$answer->attachment_path)}}"><i>{{substr($answer->attachment_path,strlen($answer->attachment_path)-\Config::get('constants.options.limitCharacterAttachmentName'))}}</i></a>
                @endif
                <button type="submit" class="btn btn-primary float-right" onclick="checkContent()">Save changes</button>
            </form>
        </div>
    </div>

</div>
@endsection
