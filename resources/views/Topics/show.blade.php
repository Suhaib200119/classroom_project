@extends('Layouts.parent')
@section('page-title', $topic->name)
@section('big-title', 'المواضيع')
@section('small-title', $topic->name)
@section('content')
    <div class="row">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{ $topic->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted"> id {{ $topic->id }}</h6>
                <p class="card-text">classroom id {{ $topic->classroom_id }}</p>
            </div>
        </div>
    </div>
@endsection
