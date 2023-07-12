@extends("Layouts.mater")
@section("page-title","view all classrooms")
@section("content")
@if (session()->has("success"))
  <div class="alert alert-success" role="alert">
      {{session("success")}}
    </div>

@elseif(session()->has("danger"))
<div class="alert alert-danger" role="alert">
{{session("danger")}}
</div>
@endif
<br>
<br>

<div class="row gy-5">
@foreach ($classrooms as $classroom)
  <div class="card" style="width: 18rem; margin-right: 40px">
    <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">{{$classroom->name}}</h5>
      <p class="card-text">{{$classroom->section}}</p>
      <a href="{{route("show_classroom",$classroom->id)}}" class="btn btn-primary">show</a>
      <a href="{{route("edit_classroom",$classroom->id)}}" class="btn btn-secondary">edit</a>
      <form style="display: inline" action="{{route("delete_classroom",$classroom->id)}}" method="post">
        @csrf
        @method("delete")
        <button type="submit" class="btn btn-danger">delete</button>
      </form>
    </div>
  </div>

@endforeach
</div>




@endsection