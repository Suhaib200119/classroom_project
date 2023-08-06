@extends('Layouts.parent')
@section('page-title', 'الفصول الدراسية')
@section('big-title', 'الفصول الدراسية')
@section('small-title', 'جميع الفصول الدراسية')
@section('content')
    <x-index-alert class="alert-success" name="success" />
    <x-index-alert class="alert-danger" name="danger" />
    <div class="row">
        @foreach ($classrooms as $classroom)
            <div id="{{ $classroom->id }}" class="card mb-3" style="width: 25rem; padding:0px;margin:8px">
                {{-- <img src="{{$classroom->cover_image}}" class="card-img-top" style="width:100%"> --}}
                <img src="{{ asset("uploads/$classroom->cover_image") }}" class="card-img-top" style="width:100%">
                <div class="card-body">
                    <h5 class="card-title">{{ $classroom->name }}</h5>
                    <p class="card-text">{{ $classroom->section }}</p>
                    <a href="{{ route('show_classroom', $classroom->id) }}" class="btn btn-primary">عرض</a>
                    <a href="{{ route('people_classroom', $classroom->id) }}" class="btn btn-primary">الأعضاء</a>
                    <a href="{{ route('classrooms.classworks.index', $classroom->id) }}" class="btn btn-info"
                        style="color: white">أعمال الفصل</a>
                    <a href="{{ route('edit_classroom', $classroom->id) }}" class="btn btn-secondary">تعديل</a>
                    <button onclick="confirmDeleteItem_softDelete('{{ $classroom->id }}')"
                        class="btn btn-danger">حذف</button>

                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('cms-style/dist/my-js/classroom-js.js') }}"></script>
@endsection
