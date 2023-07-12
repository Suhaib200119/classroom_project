@extends("Layouts.mater")
@section("page-title","create classroom")
@section("content")

<form action="{{route("store_classroom")}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="classroom_name" class="form-label">Classroom Name</label>
        <input type="text" name="name" class="form-control" id="classroom_name" placeholder="classroom name">
      </div>

      <div class="mb-3">
        <label for="classroom_section" class="form-label">Classroom Section</label>
        <input type="text" name="section" class="form-control" id="classroom_section" placeholder="classroom section">
      </div>

      <div class="mb-3">
        <label for="classroom_subject" class="form-label">Classroom Subject</label>
        <input type="text" name="subject" class="form-control" id="classroom_subject" placeholder="classroom subject">
      </div>

      <div class="mb-3">
        <label for="classroom_room" class="form-label">Classroom Room</label>
        <input type="text" name="room" class="form-control" id="classroom_room" placeholder="classroom room">
      </div>

      <input type="radio" name="status" value="active"> active
      <input type="radio" name="status" value="archived"> archived

      <div class="mb-3">
        <label for="formFile" class="form-label">Classroom Cover Image</label>
        <input class="form-control" name="cover_image" type="file" id="formFile" required>
      </div>

      <button type="submit" class="btn btn-primary" style="width: 100%">save</button>

</form>
@endsection