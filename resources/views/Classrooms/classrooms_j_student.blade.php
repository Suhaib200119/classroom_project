@extends('Layouts.parent')
@section('page-title', 'الفصول الدراسية المنضم إليها ك طالب')
@section('big-title', 'الفصول الدراسية المنضم إليها')
@section('small-title', 'الفصول الدراسية المنضم إليها ك طالب')
@section('content')
<x-index-alert name="message" class="alert-success"/>
    <div class="row">
        @foreach ($classrooms as $classroom)
        <div class="card mb-3" style="width: 25rem;">
            <div class="card-body">
                <h5 class="card-title">رقم الصف <b class="text-success">{{ $classroom->classroom_id }}</b></h5>
                <p class="card-text">تاريخ الإنضمام <b class="text-success">{{ $classroom->created_at }}</b></p>
                <p class="card-text">الصفة المنضم فيها إلى الصف <b class="text-success">{{ $classroom->role }}</b></p>
                <a href="{{ route('show_classroom', $classroom->classroom_id) }}" class="btn btn-primary">عرض</a>
                <form style="display: inline" action="{{ route('exitFromClassroom', $classroom->classroom_id) }}"
                    method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">مغادرة</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@endsection
