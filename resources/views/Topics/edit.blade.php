@extends('Layouts.mater')
@section('page-title', 'create topic')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{route("topics.update",$topic->id)}}" method="post">
        @csrf
        @method("put")
        <div class="form-group">
            <label for="topic_name">New Topic Name</label>
            <input type="text" name="name" class="form-control" id="topic_name" placeholder="Enter New Topic Name" value="{{$topic->name}}">
            @error("name")
                <p class="text-danger">
                    {{$message}}
                </p>
            @enderror
        </div>
        <br>

        <label for="classroom_name">Classroom Name</label>
        <select name="classroom_id"  class="form-select" aria-label="Default select example" id="classroom_name">
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}" @if ($classroom->id==$topic->classroom_id)
                    selected
                @endif>{{ $classroom->name }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <button type="submit" style="width: 100%" class="btn btn-primary">Update</button>
    </form>
@endsection
