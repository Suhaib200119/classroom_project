@extends("Layouts.mater")
@section("page-title","create classroom")
@section("content")

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
  
@endif
<form action="{{route("store_classroom")}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="classroom_name" class="form-label">Classroom Name</label>
        <input type="text" name="name" value="{{old("name")}}" class="form-control @error("name")
          is-invalid
        @enderror" id="classroom_name" placeholder="classroom name">
        @error("name")
        <p class="text-danger">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-3">
        <label for="classroom_section" class="form-label">Classroom Section</label>
        <input type="text" name="section" value="{{old("section")}}" class="form-control @error("section")
          is-invalid
        @enderror" id="classroom_section" placeholder="classroom section">
        @error("section")
          <p class="text-danger">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-3">
        <label for="classroom_subject" class="form-label">Classroom Subject</label>
        <input type="text" name="subject" value="{{old("subject")}}" class="form-control @error("sunject")
          is-invalid
        @enderror" id="classroom_subject" placeholder="classroom subject">
        @error("sunject")
          <p class="text-danger">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-3">
        <label for="classroom_room" class="form-label">Classroom Room</label>
        <input type="text" name="room" value="{{old("room")}}" class="form-control @error("room")
          is-invalid
        @enderror" id="classroom_room" placeholder="classroom room">
        @error("room")
          <p class="text-danger">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-3">
        <label for="status" class="form-label">Status: </label>
        active <input id="status" type="radio" name="status" value="active" > 
        archived <input type="radio" name="status" value="archived"> 
        @error("status")
          <p class="text-danger">{{$message}}</p>
        @enderror
      </div>
    

      <div class="mb-3">
        <label for="formFile" class="form-label ">Classroom Cover Image</label>
        <input class="form-control @error("cover_image")
        is-invalid
      @enderror" name="cover_image" type="file" id="formFile" >
       @error("cover_image")
       <p class="text-danger">{{$message}}</p>
       @enderror
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%">save</button>

</form>
@endsection