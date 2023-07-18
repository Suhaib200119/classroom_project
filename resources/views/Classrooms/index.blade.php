@extends("Layouts.mater")
@section("page-title","view all classrooms")
@section("content")
<x-index-alert class="alert-success" name="success"/>
<x-index-alert class="alert-danger" name="danger"/>
<br>
<br>

<div class="row gy-5">
@foreach ($classrooms as $classroom)
  <div class="card" style="width: 25rem; margin-right: 40px">
    <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" alt="..." height="250px">
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