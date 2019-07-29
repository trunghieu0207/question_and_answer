@extends('layout.profile')
@section('contentprofile')
<h2 class="text-primary text-center">MANAGE QUESTION</h2>
<hr class="my-3">
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col" class="text-right">Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach($questions as $question)
        <tr style="line-height: 20px;">
            <th style="max-width: 350px;">
                {{$question->title}}<br>
                <small class="text-muted">{{$question->created_at}}</small>
            </th>
            <td><span class="badge badge-info">{{$question->category->name}}</span></td>
            <td class="text-right">
                <a href="{{asset('edittopic')}}/{{ $question->id }}" class="btn btn-sm btn-outline-dark" title="Edit question"><i class="fa fa-pencil"></i></a>
                <button tag="{{$question->_id}}" onclick="confirmRemove(this)" class="btn btn-sm btn-outline-danger" title="Remove question"><i
                        class="fa fa-trash"></i></button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<form id="deleteform" action="{{route('remove_question')}}" method="post">
    {{csrf_field()}}
    <input hidden type="text" name="_id" id="question_id">
</form>
<script>
function confirmRemove(btn){
    var r = confirm("Do you want to delete this question?");
    if (r == true) {
        document.getElementById("question_id").value = btn.getAttribute('tag');
        document.getElementById("deleteform").submit();
    }
}
</script>
@endsection

