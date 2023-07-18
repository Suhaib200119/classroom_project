@extends('Layouts.mater')
@section('page-title', 'create topic')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('topics.update', $topic->id) }}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <x-c-label-input label-id="topic_name" label-value="Name" />
            <input type="text" name="name" class="form-control" id="topic_name" placeholder="Enter New Topic Name"
                value="{{ $topic->name }}">
            <x-hint-error input-name="name" />
        </div>
        <br>
        <x-c-label-input label-id="classroom_name" label-value="Classroom Name" />
        <select name="classroom_id" class="form-select" aria-label="Default select example" id="classroom_name">
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}" @if ($classroom->id == $topic->classroom_id) selected @endif>
                    {{ $classroom->name }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <button type="submit" style="width: 100%" class="btn btn-primary">Update</button>
    </form>
@endsection
