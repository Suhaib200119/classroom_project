@extends("Layouts.mater")
@section("page-title","show classroom")
@section("content")
<br>
  <div class="card mb-3" >
    <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" height="250px">
    <div class="card-body">
      <h5 class="card-title">The Name Of Classroom {{$classroom->name}} And Code <b class="text-success">#{{$classroom->code}}</b></h5>
      <p class="card-text">The Classroom Section Is {{$classroom->section}}</p>
    </div>
  </div> 
@endsection