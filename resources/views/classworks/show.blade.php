@extends("Layouts.parent")
@section("page-title","عرض العمل")
@section("big-title","الأعمال")
@section("small-title",$classwork->title)
@section("content")
<div class="position-absolute top-50 start-50 translate-middle"> 
    <div class="container">
        <h1>{{$classwork->title}}</h1>
        <form action="{{route("comments.store")}}" method="post">
            @csrf
            <input type="hidden" name="type" value="Classwork">
            <input type="hidden" name="id" value="{{$classwork->id}}">
            <x-div-input name="content" type="text" label="التعليق" id="{{$classwork->id}}" placeholder="قم بكتابة التعليق"/>
            <button class="btn btn-primary">تعليق</button>
        </form>
    </div>
    @foreach ($classwork->comments as $comment)
    <h3>{{$comment->content}}</h3>
    <h3>{{$comment->created_at->diffForHumans()}}</h3>
  @endforeach
</div>
@endsection