
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
    <div class="container">

        <!-- start logo block -->
        <a class="navbar-brand" href="{{ route('homePage') }}"><b style="font-size:20px">
                <img src="{{ asset('images/resource/logo2a.png') }}" width="40px"> TechSolution</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- end logo block -->

        <!-- start collapse block -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="row" style="width:100%">
                <div class="col-4">

                    <!-- start search block -->
                    <form id="searchform" class="form-inline-xs" action="{{ route('searchIndex') }}" method="get">
                        <div class="input-group">
                            <input id="search" name="keyword" class="form-control" type="search" placeholder="Search"
                                title="enter your keyword" autocomplete="off">
                            <div id="result_list" class="scrollbar scrollbar-lady-lips dropdown-menu"></div>
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-dark font-weight-bold" type="button"
                                    onclick="submit_search()">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- end search block -->

                </div>
                @if(Auth::check())
                <div class="col-0.5">
                    <!-- start add button block -->
                    <a href="{{route('addTopic')}}" class="btn btn-outline-secondary"><i class="fa fa-plus"></i></a>
                    <!-- end add button block -->
                </div>
                <div class="col-0.5">
                    <!-- start notification block -->
                    <div class="nav-item dropright">
                        <button class="btn btn-link" id="notify" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" onclick="read_notification()">
                            @if(Auth::user()->notifications()->where('is_read',false)->count())
                            <i id="notification_bell" class="fa fa-bell text-danger" style="font-size: 18px"></i>
                            <div id="unread_notification" class="text-danger float-right ml-1 font-weight-bold">{{Auth::user()->notifications->where('is_read',false)->count()}}</div>
                            @else
                            <i id="notification_bell" class="fa fa-bell" style="font-size: 18px"></i>
                            @endif
                        </button>
                        <div class="scrollbar scrollbar-lady-lips dropdown-menu" aria-labelledby="notify" style="width: 350px">
                            <div style="text-align: center;">
                                <h4>Notifications</h4>
                            </div>
                            @foreach(Auth::user()->notifications()->orderBy('created_at', 'DESC')->get() as $notification)
                            <div class="row" >
                                <div class="col-sm-10">
                                    <div class=" ml-2">
                                        <a href="/topic/{{ $notification->question_id }}">
                                            {{ $notification->actor()->first()->fullname.' '.$notification->action.' your '.$notification->target }}
                                        </a>
                                        <br>
                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <a href="/removenotification/{{$notification->_id}}"
                                        class="btn btn-sm btn-outline-dark float-right mr-2 mt-1" title="Remove"><span
                                            class="fa fa-close"></span></a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            @endforeach
                        </div>
                    </div>
                    <!-- end notification block -->
                </div>
                
                <ul class="navbar-nav mr-auto"></ul>

                <!-- start user menu block -->
                <div class="col-0.5 pt-2">
                    <b class="text-dark">{{ Auth::user()->fullname }}</b>
                </div>
                <div class="col-0.5">
                    <div class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle text-dark" id="setting" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fa fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="setting">
                            <a class="dropdown-item" href="{{ route('information') }}">
                                <i class="fa fa-cog" style="width:20px"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('manageQuestion') }}">
                                <i class="fa fa-comments-o" style="width:20px"></i>
                                Your questions
                            </a>
                            <a class="dropdown-item" href="{{ route('manageAnswer') }}">
                                <i class="fa fa-lightbulb-o" style="width:20px"></i>
                                Your answers
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logOut') }}">
                                <i class="fa fa-sign-out" style="width:20px"></i>
                                Sign out
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end user menu block -->
                @else
                <!-- start sign in or sign up block -->
                <ul class="navbar-nav mr-auto"></ul>
                <a href="{{route('signInIndex')}}" class="btn btn-success">Sign in</a>
                <a href="{{route('signUp')}}" class="btn btn-primary ml-2">Sign up</a>
                <!-- end sign in or sign up block -->
                @endif

            </div>
        </div>
</nav>
