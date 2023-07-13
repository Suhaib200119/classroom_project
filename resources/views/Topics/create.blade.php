@extends('Layouts.mater')
@section('page-title', 'create topic')
@section('content')
    <form action="{{route("topics.store")}}" method="post">
        @csrf
        <div class="form-group">
            <label for="topic_name">Topic Name</label>
            <input type="text" name="name" class="form-control" id="topic_name" placeholder="Enter Topic Name">
        </div>
        <br>

        <label for="classroom_name">Classroom Name</label>
        <select name="classroom_id"  class="form-select" aria-label="Default select example" id="classroom_name">
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <button type="submit" style="width: 100%" class="btn btn-primary">Save</button>
    </form>
@endsection
