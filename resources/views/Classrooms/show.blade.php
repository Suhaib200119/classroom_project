@extends("Layouts.mater")
@section("page-title","show classroom")
@section("content")
<div class="card" style="width: 18rem;">
    <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" alt="...">
    <div class="card-body">
      <p class="card-text">classroom name {{$classroom->name}} and code <b class="text-success">#{{$classroom->code}}</b></p>
     
    </div>
  </div>
@endsection