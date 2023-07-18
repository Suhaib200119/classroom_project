@extends('Layouts.mater')
@section('page-title', 'view all topics')
@section('content')
<x-index-alert class="alert-success" name="success"/>
<x-index-alert class="alert-danger" name="danger"/>
<br>
    <div class="row">
        @foreach ($topics as $topic)
            <div class="card" style="width: 18rem; margin-right: 8px;margin-left: 12px">
                <div class="card-body">
                    <h5 class="card-title">{{ $topic->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"> id {{ $topic->id }}</h6>
                    <p class="card-text">classroom id {{ $topic->classroom_id }}</p>
                    <a href="{{ route('topics.show', $topic->id) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                    <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-secondary"><i
                            class="bi bi-pencil-square"></i></a>
                    <form style="display: inline" action="{{ route('topics.destroy', $topic->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                    </form>

                </div>
            </div>
        @endforeach
    </div>
@endsection
