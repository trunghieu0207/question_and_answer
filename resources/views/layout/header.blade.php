<nav class="navbar navbar-expand-lg navbar-light bg-light shadow sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home-page') }}"><b style="font-size:20px"><img

            src="{{ asset('img/resource/logo2a.png') }}" width="40px"> TechSolution</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"

            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="form-inline" action="{{route('search_test')}}" method="get" target="_blank">
                <div class="input-group">
                    <input id="search" name="keyword" class="form-control" type="search" placeholder="Search">
                    <div id="result_list" class="dropdown-menu">

                    </div>
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-dark font-weight-bold" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            @if(Auth::check())
            <a href="{{route('add-topic')}}" class="btn btn-outline-secondary ml-2"><i class="fa fa-plus"></i></a>
            <div class="nav-item dropright">
                <a href="#" class="nav-link text-dark" id="notify" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-bell" style="font-size: 18px"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="notify" style="width: 270px">
                @if(!empty($notifications))
                @foreach($notifications as $notification)
                <div class="row">
                    <div class="col-sm-10">
                        <div class=" ml-2">
                            <a href="">
                                {{ $notification->content }}
                            </a>
                            <br>
                            <small>{{ $notification->created_at }}</small>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <a href="" class="btn btn-sm btn-outline-dark float-right mr-2 mt-1" title="Remove"><span
                            class="fa fa-close"></span></a>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    @endforeach
                    @endif
                </div>
            </div>
            <ul class="navbar-nav mr-auto"></ul>
            @if(!empty(Session::get('username')))
            <b class="text-dark">{{ Session::get('username') }}</b>
            @endif
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-dark" id="setting" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="setting">
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fa fa-cog" style="width:20px"></i>
                    Profile
                </a>
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fa fa-comments-o" style="width:20px"></i>
                    Your questions
                </a>
                <a class="dropdown-item" href="{{ route('profile') }}">
                    <i class="fa fa-lightbulb-o" style="width:20px"></i>
                    Your answers
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('log-out') }}">
                    <i class="fa fa-sign-out" style="width:20px"></i>
                    Logout
                </a>
                <<<<<<< HEAD
                =======
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="setting">
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="fa fa-cog" style="width:20px"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('manage_question') }}">
                        <i class="fa fa-comments-o" style="width:20px"></i>
                        Your questions
                    </a>
                    <a class="dropdown-item" href="{{ route('manage_answer') }}">
                        <i class="fa fa-lightbulb-o" style="width:20px"></i>
                        Your answers
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('log-out') }}">
                        <i class="fa fa-sign-out" style="width:20px"></i>
                        Logout
                    </a>
                </div>
                >>>>>>> origin/editprofile
            </div>
        </div>
        @else
        <ul class="navbar-nav mr-auto"></ul>
        <a href="{{route('sign-in')}}" class="btn btn-success">Sign in</a>
        <a href="{{route('getSignUp')}}" class="btn btn-primary ml-2">Sign up</a>
        @endif
    </div>
</div>
</nav>
