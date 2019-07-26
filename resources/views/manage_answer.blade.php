@extends('layout.profile')
@section('contentprofile')
<h2 class="text-primary text-center">MANAGE ANSWER</h2>
<hr class="my-3">
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Question title - Answer content - Answer created time</th>
            <th scope="col" class="text-right">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($answers as $answer)
        <tr style="line-height: 20px;">
            <th style="max-width: 700px;">
                {{$answer->question->title}}
                <p class="font-weight-normal m-0 pv-archiveText">{{$answer->content}}</p>
                <small class="text-muted m-0">{{$answer->created_at}}</small>
            </th>
            <td class="text-right">
                <button class="btn btn-sm btn-outline-dark" title="Edit answer"><i class="fa fa-pencil"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
