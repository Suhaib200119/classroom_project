@extends("Layouts.parent")
@section("page-title","المواضيع")
@section("big-title","المواضيع")
@section("small-title","تعديل موضوع")
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
            <x-c-label-input label-id="topic_name" label-value="اسم الموضوع الجديد" />
            <input type="text" name="name" class="form-control" id="topic_name" placeholder="قم بإدخال اسم الموضوع الجديد"
                value="{{ $topic->name }}">
            <x-hint-error input-name="name" />
        </div>
        <br>
        <x-c-label-input label-id="classroom_name" label-value="اسم الفصل الدراسي الجديد" />
        <select name="classroom_id" class="form-select"  id="classroom_name">
            @foreach ($classrooms as $classroom)
                <option value="{{ $classroom->id }}" @if ($classroom->id == $topic->classroom_id) selected @endif>
                    {{ $classroom->name }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <button type="submit" style="width: 100%" class="btn btn-primary">تحديث</button>
    </form>
@endsection
