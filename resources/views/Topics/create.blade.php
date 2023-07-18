@extends('Layouts.mater')
@section('page-title', 'create topic')
@section('content')
<x-validation-errors/>
    <form action="{{route("topics.store")}}" method="post">
        @csrf
        <x-div-input type="text" name="name" label="Name" id="topic_name" placeholder="Topic Name"/>
        <br>
        <x-c-label-input label-id="classroom_name" label-value="Classroom Name"/>
        <select name="classroom_id"  class="form-select @error("classroom_id")
            is-invalid
        @enderror" aria-label="Default select example" id="classroom_name">
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
            @endforeach
        </select>
        @error("classroom_id")
            <p class="text-danger">{{$message}}</p>
        @enderror
        <br>
        <br>
        <button type="submit" style="width: 100%" class="btn btn-primary">Save</button>
    </form>
@endsection
