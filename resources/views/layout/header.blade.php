<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home-page') }}"><b style="font-size:20px"><img
                    src="img/resource/logo2a.png" width="40px"> TechSolution</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form class="form-inline" action="https://www.google.com/search" method="get" target="_blank">
            <input name="q" class="form-control mr-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-dark my-2 my-sm-0 font-weight-bold" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </form>

        @if(Auth::check())
        <div class="nav-item dropright">
            <a href="#" class="nav-link text-dark" id="notify" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="fa fa-bell" style="font-size: 18px"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="notify" style="width: 270px">
                @if(!empty($notifications))
                @foreach($notifications as $notification)
                <div class="row">
                    <div class="col-10">
                        <div class=" ml-2">
                        <a href="">
                            {{ $notification->content }}
                        </a>
                        <br>
                        <small>{{ $notification->created_at }}</small>
                        </div>
                    </div>
                    <div class  ="col-2">
                        <a href="" class="btn btn-sm btn-outline-dark float-right mr-2 mt-1" title="Remove"><span class="fa fa-close"></span></a>
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
                    <i class="fa fa-cog mr-1"></i>
                    Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('log-out') }}">
                    <i class="fa fa-sign-out mr-1"></i>
                    Logout
                </a>
            </div>
        </div>
        @else
        <ul class="navbar-nav mr-auto"></ul>
        <a href="{{route('sign-in')}}" class="btn btn-success">Sign in</a>
        <a href="{{route('getSignUp')}}" class="btn btn-primary ml-2">Sign up</a>
        @endif
    </div>
</nav>
