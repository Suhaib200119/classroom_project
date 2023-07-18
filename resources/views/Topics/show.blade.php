@extends('Layouts.mater')
@section('page-title', 'view topic')
@section('content')
<br>
<div class="card" style="width: 18rem; margin-right: 8px">
    <div class="card-body">
        <h5 class="card-title">{{ $topic->name }}</h5>
        <h6 class="card-subtitle mb-2 text-muted"> id {{ $topic->id }}</h6>
        <p class="card-text">classroom id {{ $topic->classroom_id }}</p>
    </div>
@endsection
