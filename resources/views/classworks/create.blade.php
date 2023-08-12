@extends('Layouts.parent')
@section('page-title', 'أعمال الفصل')
@section('big-title', 'إضافة عمل')
@section('small-title', $classroom->name)
@section('content')
    <x-index-alert name="danger" class="alert-danger" />
    <form action="{{ route('classrooms.classworks.store', $classroom->id) }}" method="post">
        @csrf
        <x-div-input type="text" name="title" label="إدخل العنوان" id="title"
            placeholder="قم بكتابة العنوان الخاص في العمل" />
        <x-div-input type="text" name="description" label="إدخل الوصف" id="description"
            placeholder="قم بكتابة الوصف الخاص في العمل" />
        @if ($type == 'assignment')
            <x-div-input type="number" name="grade" label="إدخل العلامة" id="grade"
                placeholder="قم بكتابة العلامة الخاصة في العمل" />
            <x-div-input type="date" name="due" label="ادخل وقت الانتهاء" id="due"
                placeholder="قم بكتابة وقت انتهاء العمل" />
        @endif
        <h3>المواضيع</h3>
        <select name="topic_id" class="form-select @error('topic_id')
    is-invalid
    @enderror"
            aria-label="Default select example">
            @foreach ($topics as $topic)
                <option value="{{ $topic->id }}">{{ $topic->name }}</option>
            @endforeach
        </select>
        <x-hint-error input-name="topic_id" />
        <h3>الحالة</h3>
        <select name="status" class="form-select"aria-label="Default select example">
            <option value="published">published</option>
            <option value="draft">draft</option>
        </select>
        <h3>تاريخ النشر</h3>
        <x-div-input type="date" name="published_at" label="إدخل تاريخ النشر" id="published_at"
            placeholder="قم بكتابة تاريخ النشر الخاص في العمل" />
        <h3>الطلاب</h3>
        @foreach ($students as $student)
            <input type="checkbox" name="std[]" id="std" value="{{ $student->id }}"> {{ $student->name }}
            <br>
        @endforeach
        <input type="hidden" value="{{ $type }}" name="types">
        <br>
        <button class="btn btn-primary" style="width: 100%" type="submit">إضافة</button>
    </form>
@endsection
