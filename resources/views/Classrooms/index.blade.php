@extends('Layouts.parent')
@section('page-title', 'الفصول الدراسية')
@section('big-title', 'الفصول الدراسية')
@section('small-title', 'جميع الفصول الدراسية')
@section('content')
    <x-index-alert class="alert-success" name="success" />
    <x-index-alert class="alert-danger" name="danger" />
    <div class="row">
        @foreach ($classrooms as $classroom)
            <div class="card mb-3" style="width: 25rem;">
                <img src="{{asset("uploads/$classroom->cover_image")}}" class="card-img-top" style="width:100%">
                <div class="card-body">
                    <h5 class="card-title">{{ $classroom->name }}</h5>
                    <p class="card-text">{{ $classroom->section }}</p>
                    <a href="{{ route('show_classroom', $classroom->id) }}" class="btn btn-primary">عرض</a>
                    <a href="{{ route('edit_classroom', $classroom->id) }}" class="btn btn-secondary">تعديل</a>
                    @if ($classroom->deleted_at == null)
                        <form style="display: inline" action="{{ route('delete_classroom', $classroom->id) }}"
                            method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">حذف</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
