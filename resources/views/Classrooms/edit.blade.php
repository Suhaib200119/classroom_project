@extends('Layouts.mater')
@section('page-title', 'edit classroom')
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
    <form action="{{ route('update_classroom', $classroom->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="mb-3">
            <x-c-label-input label-id="classroom_name" label-value="Classroom Name" />
            <input type="text" name="name"
                class="form-control @error('name')
            is-invalid
            @enderror" id="classroom_name"
                placeholder="classroom name" value="{{ $classroom->name }}">

            <x-hint-error input-name="name" />

        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_section" label-value="Classroom Section" />
            <input type="text" name="section"
                class="form-control @error('section')
            is-invalid
            @enderror" id="classroom_section"
                placeholder="classroom section" value="{{ $classroom->section }}">

            <x-hint-error input-name="section" />

        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_subject" label-value="Classroom Subject" />
            <input type="text" name="subject"
                class="form-control @error('subject')
            is-invalid
            @enderror" id="classroom_subject"
                placeholder="Subject" value="{{ $classroom->subject }}">
            <x-hint-error input-name="subject" />

        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_room" label-value="Room" />

            <input type="text" name="room"
                class="form-control @error('room')
            is-invalid
            @enderror" id="classroom_room"
                placeholder="classroom room" value="{{ $classroom->room }}">
            <x-hint-error input-name="room" />

        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_room" label-value="Status:" />
            active <input type="radio" name="status" value="active" @if ($classroom->status == 'active') checked @endif>
            archived <input type="radio" name="status" value="archived" @if ($classroom->status == 'archived') checked @endif>
            <x-hint-error input-name="status" />
        </div>
        <img style="display: block" src="{{ asset("uploads/$classroom->cover_image") }}" alt="" width="100%"
            height="250px">
        <div class="mb-3">
            <x-c-label-input label-id="formFile" label-value="Cover Image" />
            <input class="form-control @error('cover_image')
                is-invalid
            @enderror"
                name="cover_image" type="file" id="formFile">
            <x-hint-error input-name="cover_image" />
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%">update</button>
<br><br>
    </form>
@endsection
