@extends("Layouts.parent")
@section("page-title","المواضيع")
@section("big-title","المواضيع")
@section("small-title","إضافة موضوع")
@section('content')
<x-validation-errors/>
    <form action="{{route("topics.store")}}" method="post">
        @csrf
        <x-div-input type="text" name="name" label="اسم الموضوع" id="topic_name" placeholder="قم إبدخال اسم الموضوع"/>
        <br>
        <x-c-label-input label-id="classroom_name" label-value="اسم الفصل الدراسي"/>
        <select name="classroom_id"  class="form-select @error("classroom_id")
            is-invalid
        @enderror"  id="classroom_name">
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
            @endforeach
        </select>
        @error("classroom_id")
            <p class="text-danger">{{$message}}</p>
        @enderror
        <br>
        <br>
        <button type="submit" style="width: 100%" class="btn btn-primary">حفظ</button>
    </form>
@endsection
