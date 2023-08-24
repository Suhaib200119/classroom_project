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
  <hr>
  <hr>
  @can("addSubmission","App\Models\Classwork")
  @if ($submissions->count()<=0)
  <form  action="{{route("submissions.store",$classwork->id)}}" method="post" enctype="multipart/form-data" >
    @csrf
    <div class="mb-3">
        <label for="files" class="form-label">قم برفع الملفات</label>
        <input class="form-control @error("files")
          is-invalid
        @enderror" name="files[]" type="file" id="files" multiple>
        <x-hint-error input-name="files"/>
      </div>
    <button type="submit" class="btn btn-primary">تسليم</button>
  </form>
  @else
  <ul>
    @foreach ($submissions as $sub)
    <li>
      <a href="uploads/{{$sub->content}}">File {{$loop->iteration}}</a>
    </li>
    @endforeach
  </ul>
  
  @endif
  @if (session("success"))
    <div class="alert alert-success">{{session("success")}}</div>
  @endif
  @endcan

</div>
@endsection