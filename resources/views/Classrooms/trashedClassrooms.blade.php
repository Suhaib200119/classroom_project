@extends("Layouts.parent")
@section("page-title","الفصول الدراسية")
@section("big-title","الفصول الدراسية")
@section("small-title","الفصول الدراسية المحذوفة")
@section("content")
    <div class="row gy-5">
      <x-index-alert class="alert-success" name="success"/>
      <x-index-alert class="alert-danger" name="danger"/>
        @foreach ($classrooms as $classroom)
          <div id="{{$classroom->id}}"  class="card" style="width: 25rem; margin-right: 40px;padding: 0px">
            <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$classroom->name}}</h5>
              <p class="card-text">{{$classroom->section}}</p>
              <a href="{{route("show_classroom",$classroom->id)}}" class="btn btn-primary">عرض</a>
              <button onclick="confirmDeleteItem_forceDelete('{{$classroom->id}}')" class="btn btn-danger">حذف نهائي</button>
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
@section("js")
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset("cms-style/dist/my-js/classroom-js.js")}}"></script>
@endsection