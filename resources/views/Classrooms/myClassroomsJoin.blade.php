@extends('Layouts.parent')
@section('page-title', 'الصفوف')
@section('big-title', 'الصفوف المنظم إليها')
@section('small-title', Auth::user()->name)
@section("content")
<div class="row">
    @foreach ($classrooms as $classroom)
        <div id="{{ $classroom->id }}" class="card mb-3" style="width: 25rem; padding:0px;margin:8px">
            <img src="{{ asset("uploads/$classroom->cover_image") }}" class="card-img-top" style="width:100%">
            <div class="card-body">
                <h5 class="card-title">{{ $classroom->name }}</h5>
                <p class="card-text">{{ $classroom->section }}</p>
                <a href="{{ route('show_classroom', $classroom->id) }}" class="btn btn-primary">عرض</a>
                <a href="{{ route('people_classroom', $classroom->id) }}" class="btn btn-primary">الأعضاء</a>
                <a href="{{ route('classrooms.classworks.index', $classroom->id) }}" class="btn btn-info"
                    style="color: white">أعمال الفصل</a>
                <button onclick="confirmExitFromClassroom({{ $classroom->id }}, {{$user_id}})"
                    class="btn btn-danger">مغادرة</button>

            </div>
        </div>
    @endforeach
</div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('cms-style/dist/my-js/classroom_user-js.js') }}"></script>
@endsection