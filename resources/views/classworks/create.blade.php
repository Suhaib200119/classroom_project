@extends("Layouts.parent")
@section("page-title","أعمال الفصل")
@section("big-title","إضافة عمل")
@section("small-title",$classroom->name)
@section("content")
<form action="{{route("classrooms.classworks.store",$classroom->id)}}" method="post">
    @csrf
    <x-div-input type="text" name="title" label="إدخل العنوان" id="title" placeholder="قم بكتابة العنوان الخاص في العمل"/>
    <x-div-input type="text" name="description" label="إدخل الوصف" id="description" placeholder="قم بكتابة الوصف الخاص في العمل"/>
    <select name="topic_id" class="form-select @error("topic_id")
    is-invalid
  @enderror" aria-label="Default select example">
       @foreach ($topics as $topic)
       <option value="{{$topic->id}}">{{$topic->name}}</option>
       @endforeach
      </select>
      <x-hint-error input-name="topic_id"/>
      <input type="hidden" value="{{$type}}" name="types">
      <br>
      <button   class="btn btn-primary" style="width: 100%" type="submit">إضافة</button>
</form>
@endsection
    