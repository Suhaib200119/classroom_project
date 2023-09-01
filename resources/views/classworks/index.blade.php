@extends('Layouts.parent')
@section('page-title', 'أعمال الفصل')
@section('big-title', 'أعمال الفصل')
@section('small-title', $classroom->name)
@section('content')
    <div class="container">
        <x-index-alert name="success" class="alert-success" />
        @can('create', ['App\Models\Classwork', $classroom])
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    إضافة عمل
                </button>
                <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                    <li><a class="dropdown-item"
                            href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'assignment']) }}">تكليف</a>
                    </li>
                    <li><a class="dropdown-item"
                            href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'material']) }}">نشر مادة
                            علمية</a></li>
                    <li><a class="dropdown-item"
                            href="{{ route('classrooms.classworks.create', [$classroom->id, 'type' => 'question']) }}">نشر
                            سؤال</a>
                    </li>
                </ul>
            </div>
        @endcan
        <br>

        {{-- التكاليف --}}
        <div class="accordion" id="accordionExample">
            @if (count($assignments) > 0)
                <h1>التكاليف</h1>
            @endif
            @foreach ($assignments as $assignment)
            {{-- start component classwork-card --}}
            <x-classwork-card id="{{$assignment->id}}"/>
            {{-- end component classwork-card --}}
            @endforeach

        </div>
    </div>
    {{-- الماتيريل --}}
    <div class="accordion" id="accordionExample">
        @if (count($materials) > 0)
            <h1>المواد العلمية</h1>
        @endif
        @foreach ($materials as $material)
        <x-classwork-card id="{{$material->id}}"/>
        @endforeach

    </div>
    </div>
    {{-- الأسئلة --}}
    <div class="accordion" id="accordionExample">
        @if (count($questions) > 0)
            <h1>الأسئلة</h1>
        @endif
        @foreach ($questions as $question)
        <x-classwork-card id="{{$question->id}}"/>
        @endforeach
    </div>
    </div>
@endsection
@section('js')
    <script>
        const classroomId = {{ $classroom->id }};
    </script>
    {{-- @vite(["resources/js/app.js"]) --}}
@endsection
