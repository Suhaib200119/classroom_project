@extends('Layouts.mater')
@section('page-title', 'edit classroom')
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
    <form action="{{ route('update_classroom',$classroom->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="classroom_name" class="form-label">Classroom Name</label>
            <input type="text" name="name" class="form-control @error("name")
            is-invalid
            @enderror" id="classroom_name" placeholder="classroom name"
                value="{{ $classroom->name }}">
                @error("name")
                    <p class="text-danger">{{$message}}</p>
                @enderror
        </div>

        <div class="mb-3">
            <label for="classroom_section" class="form-label">Classroom Section</label>
            <input type="text" name="section" class="form-control @error("section")
            is-invalid
            @enderror" id="classroom_section" placeholder="classroom section"
                value="{{ $classroom->section }}">
                @error("section")
                    <p class="text-danger">{{$message}}</p>
                @enderror
        </div>

        <div class="mb-3">
            <label for="classroom_subject" class="form-label">Classroom Subject</label>
            <input type="text" name="subject" class="form-control @error("subject")
            is-invalid
            @enderror" id="classroom_subject" placeholder="classroom subject"
                value="{{ $classroom->subject }}">
                @error("subject")
                   <p class="text-danger"> {{$message}}</p>
                @enderror
        </div>

        <div class="mb-3">
            <label for="classroom_room" class="form-label">Classroom Room</label>
            <input type="text" name="room" class="form-control @error("room")
            is-invalid
            @enderror" id="classroom_room" placeholder="classroom room"
                value="{{ $classroom->room }}">
                @error("room")
                    <p class="text-danger">{{$message}}</p>
                @enderror
        </div>

        <div class="mb-3">
        <label for="classroom_room" class="form-label">Status: </label>
        active <input type="radio" name="status" value="active" @if ($classroom->status == 'active') checked @endif> 
        archived <input type="radio" name="status" value="archived" @if ($classroom->status == 'archived') checked @endif> 
        @error("status")
        <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
        <img style="display: block" src="{{asset("uploads/$classroom->cover_image")}}" alt="" width="150px" height="150px">
        <div class="mb-3">
            <label for="formFile" class="form-label">Classroom Cover Image</label>
            <input class="form-control @error("cover_image")
                is-invalid
            @enderror" name="cover_image" type="file" id="formFile" >
            @error("cover_image")
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%">update</button>

    </form>
@endsection
