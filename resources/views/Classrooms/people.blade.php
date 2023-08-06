@extends('Layouts.parent')
@section('page-title', 'الأعضاء')
@section('big-title', 'الأعضاء')
@section('small-title', $classroom->name)
@section('content')
    {{-- المدرسين --}}
    @if (count($teachers) > 0)
        <table class="table">
            <h3>المدرسين</h3>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم المستخدم</th>
                    <th scope="col">البريد الإلكتروني</th>
                    <th scope="col">الصفة</th>
                    <th scope="col">العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr id="{{$teacher->id }}">
                        <th scope="row" >{{ $teacher->id }}</th>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>{{ $teacher->pivot->role }}</td>
                        @if (Auth::id() != $teacher->id)
                            <td><button class="btn btn-danger"
                                    onclick="confirmExitFromClassroom({{ $teacher->pivot->classroom_id }},{{ $teacher->id }})">حذف</button>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    {{-- الطلاب --}}
    @if (count($students) > 0)
        <table class="table">
            <h3>الطلاب</h3>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">اسم المستخدم</th>
                    <th scope="col">البريد الإلكتروني</th>
                    <th scope="col">الصفة</th>
                    <th>العمليات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                    <tr id="{{ $student->id }}">
                        <th scope="row">{{ $student->id }}</th>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->pivot->role }}</td>
                        <td><button class="btn btn-danger"
                                onclick="confirmExitFromClassroom({{ $student->pivot->classroom_id }},{{ $student->id }})">حذف</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('cms-style/dist/my-js/classroom_user-js.js') }}"></script>
@endsection
