@extends('layout.master')

@section('title','View topic')



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
        document.getElementById("addanswer").submit();
    }
}

</script>
@endsection

@section('content')


<div class="container mt-5">
    <!-- Start Question Block -->
    <div class="card shadow">
        <div class="row px-3 pt-3">

            <div class="col-sm-1"><img src="{{asset('images/avatars')}}/{{$question->user->avatar}}"class="test rounded-circle align-middle"></div>
            
            <!-- Start Username, Date, Edit, Delete Block -->
            <div class="col-sm-11">
                <div class="font-weight-bold" style="color:#787878; font-size: 25px">{{$question->user->fullname}}
                    <!-- Button HTML (to Trigger Modal) -->
                    @if(Auth::check())
                    @if($question->user_id==Auth::user()->id)
                    <a href="#myModal" data-toggle="modal">
                        <i class="float-right fa fa-trash" aria-hidden="true"style="margin-right:10px; font-size: 120%; "></i></a>
                    <!-- Modal HTML -->
                    <div id="myModal" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this topic?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <form action="{{route('deleteTopic')}}" method="post">
                                        @csrf
                                        <input type="text" name="_id" value="{{$question->id}}" hidden>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{asset('edittopic')}}/{{ $question->id }}"><i class="float-right fa fa-pencil-square-o"
                            aria-hidden="true" style="margin-right:10px; font-size:120%"></i></a>
                    @else
                    @endif
                    @endif

                </div>
                <div>
                    <small class="text-muted" style="color:#5488c7;">
                        <i class="fa fa-clock-o" aria-hidden="true"> </i>
                        {{$question->date_convert}}
                    </small>
                </div>
                <br>
            </div>
            <!-- End Username, Date, Edit, Delete Block -->
            
            <!-- Start Question Title Block -->
            <div class="col-sm-12 d-flex justify-content-sm-between">
                <h3>{{$question->title}}</h3>
                <span class="badge badge-info" style="height: 20px">{{$question->category->name}}</span>
            </div>
            <!-- End Question Title Block -->

            <!-- Start Question Content Block -->
            <div class="col-sm-12" style="margin-left: 10px">
                <p>{!! $question->content !!}</p>
                @if(!file_exists(public_path().'files/{{ $question->attachment_path }}'))
                    <h6>Attachments</h6>
                    <a target="blank" href="{{asset('files/'.$question->attachment_path)}}"><i>{{$question->attachment_path}}</i></a>
                @else
                @endif
                <div class="row" style="width: 500px; color:#787878; font-size: 20px; margin-bottom: 10px; margin-left: 5px;">
                    <div class="col-xs" style="width:100px">
                        @if (Auth::check())
                            <a href="{{asset('like')}}/{{$question->_id}}/Question/{{Auth::user()->id}}">
                            <i class="fa fa-thumbs-up"></i></a> {{$question->total_like}}
                        @else
                            <a href="{{route('signInIndex')}} " style="color:#787878"><i class="fa fa-thumbs-up"></i></a>
                            {{$question->total_like}}
                        @endif
                    </div>
                    <div class="col-xs" style="width:100px">
                        @if (Auth::check())
                            <a href="{{asset('dislike')}}/{{$question->_id}}/Question/{{Auth::user()->id}}">
                            <i class="fa fa-thumbs-down"></i></a> {{$question->total_dislike}}
                        @else
                            <a href="{{route('signInIndex')}}" style="color:#787878"><i class="fa fa-thumbs-down"></i></a>
                            {{$question->total_dislike}}
                        @endif
                    </div>
                    <div class="col-xs" style="width:100px">
                        <i class="fa fa-reply"></i> {{$question->total_answer}}
                    </div>
                </div>
            </div>
            <!-- End Question Content Block -->
        </div>
    </div>
    <!-- End Question Block -->


    <!-- Start Insert Answer Block -->
    @if (Auth::check())
    <div class="card shadow" style="margin-top: 20px;">
        <div class="card-body">
            <form id="addanswer" method="post" action="{{route('addAnswer')}}" enctype="multipart/form-data">
                @csrf
                <input type="text" name="question_id" hidden value="{{$question->_id}}">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="file-loading">
                                <input id="fuMain" name="attachment" type="file">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <textarea id="MyID" name="content"></textarea>
                        </div>
                    </div>
                </div>
                <button onclick="checkContent()" type="button" class="btn btn-primary float-right">Answer</button>
            </form>
        </div>
    </div>
    @endif
    <!-- End Insert Answer Block -->

    <!-- Start Answer Block -->
    <div class="card shadow" style="margin-top: 20px; margin-bottom: 20px; ">
        <div class="card-header">
            <h3>Answer</h3>
        </div>

        <!-- Start Best Answer Block -->        
        @if ($best_answer!=null)
        <div class="row px-3 pt-3">
            <div class="col-sm-1">
                <img src="{{asset('images/avatars')}}/{{$best_answer->user->avatar}}" class="test rounded-circle align-middle">
                <br>
                <br>                
                <div class="d-flex" style="justify-content :center; align-items:center;  font-size:200%; color:#66ad1f">
                    <i class="fa fa-check" aria-hidden="true"></i>
                </div>
            </div>
            <div class="col-sm-11">
                <div class="font-weight-bold" style="color:#787878; font-size: 20px">{{$best_answer->user->fullname}}
                    @if (Auth::check())
                    @if($best_answer->user_id==Auth::user()->id)
                    <a href="{{asset('editanswer')}}/{{ $best_answer->id }}">
                    <i class="float-right fa fa-pencil-square-o" aria-hidden="true" style="margin-right:10px; font-size:120%"></i></a>
                    @endif
                    @endif
                </div>
                <div>
                    <small class="text-muted" style="color:#5488c7;">
                        <i class="fa fa-clock-o" aria-hidden="true"> </i> 
                        {{$best_answer->date_convert}}
                    </small>
                </div>
                <br>
                <p>{!! $best_answer->content !!}</p>
                @if(!file_exists(public_path().'files/{{ $best_answer->attachment_path }}'))
                    <h6>Attachments</h6>
                    <a target="blank" href="{{asset('files/'.$best_answer->attachment_path)}}"><i>{{$best_answer->attachment_path}}</i></a>
                @endif
                <div class="row" style=" color:#787878; font-size: 20px ; margin-bottom: 10px">
                    <div class="col-1">
                        @if(Auth::check())
                            <a href="{{asset('like')}}/{{$best_answer->_id}}/Answer/{{Auth::user()->id}}">
                            <i class="fa fa-thumbs-up"></i></a> {{$best_answer->total_like}}
                        @else
                            <a href="{{route('signInIndex')}}"><i class="fa fa-thumbs-up" style="color:#787878"></i></a>
                            {{$best_answer->total_like}}
                        @endif
                    </div>
                    <div class="col-1">
                        @if(Auth::check())
                            <a href="{{asset('dislike')}}/{{$best_answer->_id}}/Answer/{{Auth::user()->id}}">
                            <i class="fa fa-thumbs-down"></i></a> {{$best_answer->total_dislike}}
                        @else
                            <a href="{{route('signInIndex')}}"><i class="fa fa-thumbs-down" style="color:#787878"></i></a>
                            {{$best_answer->total_dislike}}
                        @endif
                    </div>
                    @if (Auth::check())
                    @if (Auth::user()->id==$question->user_id)
                    <div class="col-10 justify-content-sm-end">
                        <a href="{{asset('removebestanswer')}}/{{$best_answer->_id}}"><button type="button"
                                class="float-right btn btn-warning">Remove Best Answer</button></a>
                    </div>
                    @else
                    @endif
                    @endif
                </div>
            </div>
        </div>
        <hr>
        @endif
        <!-- End Best Answer Block --> 

        <!-- Start Other Answers Block -->
        @foreach($answers as $answer)
        @if (($best_answer==null) or (($best_answer!=null) and ($answer->_id!=$best_answer->_id)))
        <div class="row px-3 pt-3">
            <div class="col-sm-1">
                <img src="{{asset('images/avatars')}}/{{$answer->user->avatar}}" class="test rounded-circle align-middle">
                <br>
                <br>
                @if ($question->best_answer_id == $answer->_id)
                    <div class="d-flex" style="justify-content :center; align-items:center;  font-size:200%; color:#66ad1f">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </div>
                @endif
            </div>
            <div class="col-sm-11">
                <div class="font-weight-bold" style="color:#787878; font-size: 20px">{{$answer->user->fullname}}
                    @if (Auth::check())
                    @if (Auth::user()->id==$answer->user_id)
                        <a href="{{asset('editanswer')}}/{{ $answer->id }}"><i class="float-right fa fa-pencil-square-o"
                                aria-hidden="true" style="margin-right:10px; font-size:120%"></i> </a>
                    @endif
                    @endif
                </div>
                <div>
                    <small class="text-muted" style="color:#5488c7;">
                        <i class="fa fa-clock-o" aria-hidden="true"> </i> 
                        {{$answer->date_convert}}
                    </small>
                </div>
                <br>
                <p>{!! $answer->content !!}</p>
                @if(!file_exists(public_path().'files/{{ $answer->attachment_path }}'))
                    <h6>Attachments</h6>
                    <a target="blank" href="{{asset('files/'.$answer->attachment_path)}}"><i>{{$answer->attachment_path}}</i></a>
                @else
                @endif
                <div class="row" style=" color:#787878; font-size: 20px ; margin-bottom: 10px">
                    <div class="col-1">
                        @if(Auth::check())
                            <a href="{{asset('like')}}/{{$answer->_id}}/Answer/{{Auth::user()->id}}">
                            <i class="fa fa-thumbs-up"></i></a> {{$answer->total_like}}
                        @else
                            <a href="{{ route('signInIndex') }} " style="color:#787878"><i class="fa fa-thumbs-up"></i></a>
                            {{$answer->total_like}}
                        @endif
                    </div>
                    <div class="col-1">
                        @if(Auth::check())
                            <a href="{{asset('dislike')}}/{{$answer->_id}}/Answer/{{Auth::user()->id}}">
                            <i class="fa fa-thumbs-down"></i></a>
                            {{$answer->total_dislike}}
                        @else
                            <a href="{{ route('signInIndex') }}" style="color:#787878"><i class="fa fa-thumbs-down"></i></a>
                            {{$answer->total_dislike}}
                        @endif
                    </div>
                     @if (Auth::check())
                    @if (Auth::user()->id==$question->user_id)
                    <div class='col-10 justify-content-sm-end'>                                           
                        <a href="{{asset('bestanswer')}}/{{$answer->_id}}"><button type="button"
                            class="float-right btn btn-success">Best Answer</button></a>                           
                    </div>
                    @endif
                    @endif
                   
                </div>
            </div>
        </div>
        <hr>
        @endif
        @endforeach
    </div>

</div>
@endsection
