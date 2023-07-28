@extends("Layouts.parent")
@section("page-title","الفصول الدراسية")
@section("big-title","الفصول الدراسية")
@section("small-title","تعديل الفصل الدراسي")
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
            <x-c-label-input label-id="classroom_name" label-value="اسم الفصل الدراسي الجديد" />
            <input type="text" name="name"
                class="form-control @error('name')
            is-invalid
            @enderror" id="classroom_name"
            placeholder="قم بإدخال اسم الفصل الدراسي الجديد" value="{{ $classroom->name }}">
            <x-hint-error input-name="name" />
        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_section" label-value="قسم الفصل الدراسي الجديد" />
            <input type="text" name="section"
                class="form-control @error('section')
            is-invalid
            @enderror" id="classroom_section"
            placeholder="قم بإدخال قسم الفصل الدراسي الجديد"  value="{{ $classroom->section }}">

            <x-hint-error input-name="section" />

        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_subject" label-value="موضوع الفصل الدراسي" />
            <input type="text" name="subject"
                class="form-control @error('subject')
            is-invalid
            @enderror" id="classroom_subject"
            placeholder="قم بإدخال موضوع الفصل الدراسي"value="{{ $classroom->subject }}">
            <x-hint-error input-name="subject" />

        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_room" label-value="غرفة الفصل الدراسي الجديدة" />

            <input type="text" name="room"
                class="form-control @error('room')
            is-invalid
            @enderror" id="classroom_room"
            placeholder="قم بإدخال غرفة الفصل الدراسي الجديدة"  value="{{ $classroom->room }}">
            <x-hint-error input-name="room" />

        </div>

        <div class="mb-3">
            <x-c-label-input label-id="classroom_room" label-value="حالة الفصل الدراسي الجديد:" />
            فعال <input type="radio" name="status" value="active" @if ($classroom->status == 'active') checked @endif>
            مؤرشف <input type="radio" name="status" value="archived" @if ($classroom->status == 'archived') checked @endif>
            <x-hint-error input-name="status" />
        </div>
        <img style="display: block" src="{{ asset("uploads/$classroom->cover_image") }}" alt="" width="100%"
            height="250px">
        <div class="mb-3">
            <x-c-label-input label-id="formFile" label-value="صورة الغلاف" />
            <input class="form-control @error('cover_image')
                is-invalid
            @enderror"
                name="cover_image" type="file" id="formFile">
            <x-hint-error input-name="cover_image" />
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%">تحديث</button>
<br><br>
    </form>
@endsection
