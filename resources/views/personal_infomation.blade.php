
@extends('layout.master')
@section('title','Homepage')
@section('content')

<div class="container mt-5">
<div class="card bg-light shadow px-5">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
            <img src="{{ asset('images/avatars') }}/{{ $user->avatar }}" class="w-100" alt="">
            </div>
            <div class="col-sm-7 py-5">
                <h1 class="text-primary font-weight-bold">{{ $user->fullname }}</h1>
                <p>{{ $user->about_me }}</p>
                <ul>
                    <li>Total question: <div class="badge badge-info">{{ $user->questions->count() }}</div></li>
                    <li>Total answer: <div class="badge badge-info">{{ $user->answers->count() }}</div></li>
                    <li>Total like: <div class="badge badge-info">{{ $totalLike }}</div></li>
                    <li>Total dislike: <div class="badge badge-info">{{ $totalDislike }}</div></li>
                    <li>Total accepted answer: <div class="badge badge-info">{{ $totalAccepted }}</div></li>
                </ul>
            </div>
        </div>
    </div> 
</div>
</div>

@endsection
