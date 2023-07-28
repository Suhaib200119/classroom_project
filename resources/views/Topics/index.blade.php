@extends("Layouts.parent")
@section("page-title","المواضيع")
@section("big-title","المواضيع")
@section("small-title","جميع المواضيع")
@section('content')
    <x-index-alert class="alert-success" name="success" />
    <x-index-alert class="alert-danger" name="danger" />
    <div class="row">
        @foreach ($topics as $topic)
            <div class="card" style="width: 25rem; ">
                <div class="card-body">
                    <h5 class="card-title">{{ $topic->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted"> id {{ $topic->id }}</h6>
                    <p class="card-text">classroom id {{ $topic->classroom_id }}</p>
                    <a href="{{ route('topics.show', $topic->id) }}" class="btn btn-primary"><i class="bi bi-eye"></i></a>
                    @if ($topic->deleted_at == null)
                        <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-secondary"><i
                                class="bi bi-pencil-square"></i></a>
                    @endif

                    @if ($topic->deleted_at == null)
                        <form style="display: inline" action="{{ route('topics.destroy', $topic->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    @else
                        <form style="display: inline" action="{{ route('delete_topic', $topic->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">حذف نهائي</button>
                        </form>
                        <form style="display: inline" action="{{ route('restore_topic', $topic->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-success">إسترجاع</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
