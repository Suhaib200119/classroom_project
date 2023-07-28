@extends("Layouts.parent")
@section("page-title","الفصول الدراسية")
@section("big-title","الفصول الدراسية")
@section("small-title","الفصول الدراسية المحذوفة")
@section("content")
    <div class="row gy-5">
      <x-index-alert class="alert-success" name="success"/>
      <x-index-alert class="alert-danger" name="danger"/>
        @foreach ($classrooms as $classroom)
          <div class="card" style="width: 25rem; margin-right: 40px">
            <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" alt="..." height="250px">
            <div class="card-body">
              <h5 class="card-title">{{$classroom->name}}</h5>
              <p class="card-text">{{$classroom->section}}</p>
              <a href="{{route("show_classroom",$classroom->id)}}" class="btn btn-primary">عرض</a>
              <form style="display: inline" action="{{route("forceDelete_classroom",$classroom->id)}}" method="post">
                @csrf
                @method("delete")
                <button type="submit" class="btn btn-danger">حذف نهائي</button>
              </form>
              <form style="display: inline" action="{{route("restore_classroom",$classroom->id)}}" method="post">
                @csrf
                @method("put")
                <button type="submit" class="btn btn-success">إسترجاع</button>
              </form>
            </div>
          </div>
        
        @endforeach
        </div>
@endsection