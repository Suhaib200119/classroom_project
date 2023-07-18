@extends("Layouts.mater")
@section("page-title","create classroom")
@section("content")

<x-validation-errors/>
<form action="{{route("store_classroom")}}" method="post" enctype="multipart/form-data">
    @csrf
    <x-div-input type="text" name="name" label="Name" id="classroom_name" placeholder="Classroom Name"/>
    <x-div-input type="text" name="section" label="Section" id="classroom_name" placeholder="Classroom Name"/>
    <x-div-input type="text" name="subject" label="Subject" id="classroom_subject" placeholder="Classroom Subject"/>
    <x-div-input type="text" name="room" label="Room" id="classroom_room" placeholder="Classroom Room"/>

      <div class="mb-3">
        <label for="status" class="form-label">Status: </label>
        active <input id="status" type="radio" name="status" value="active" > 
        archived <input type="radio" name="status" value="archived"> 
        <x-hint-error input-name="status"/>
      </div>
    
      <x-div-input type="file" name="cover_image" label="Cover Image" id="classroom_iamge" placeholder="Classroom Cover Image"/>

      <button type="submit" class="btn btn-primary" style="width: 100%">save</button>

</form>
@endsection