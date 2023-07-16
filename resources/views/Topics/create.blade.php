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
    <form action="{{route("topics.store")}}" method="post">
        @csrf
        <div class="form-group">
            <label for="topic_name">Topic Name</label>
            <input type="text" value="{{old("name")}}" name="name" class="form-control @error("name")
                is-invalid
            @enderror" id="topic_name" placeholder="Enter Topic Name">
            @error("name")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <br>

        <label for="classroom_name">Classroom Name</label>
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
