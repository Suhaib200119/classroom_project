@extends("Layouts.parent")
@section("page-title",$classroom->name)
@section("big-title","الفصول الدراسية")
@section("small-title",$classroom->name)
@section("content")
<br>
  <div class="card mb-3" >
    <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" height="250px">
    <div class="card-body">
      <h5 class="card-title">{{$classroom->name}}</h5>
      <b class="text-success" style="font-size: 24px"> #{{$classroom->code}}</b>
      <p class="card-title">القسم الذي ينتمي إليه الصف <b class="text-success" style="font-size: 24px"> {{$classroom->section}}</b></p>
      <span>رابط الإنضمام للصف في الأسفل</span>
      <p class="card-text">
        {{$urlJoinPage}}
      </p>
      @foreach ($posts as $post)
          <p>{{$post->post_content}} {{$post->user->name}} {{$post->created_at->diffForHumans()}}</p>
      @endforeach
      <form action="{{route("addPost_classroom",$classroom->id)}}" method="post">
        @csrf
        <x-div-input type="text" name="post_content" label="المنشور" id="post" placeholder="قم بكتابة المنشور"/>
        <button class="btn btn-primary">نشر</button>
      </form>
    </div>
  </div> 
@endsection