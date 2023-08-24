@extends('Layouts.parent')
@section('page-title', $classroom->name)
@section('big-title', 'الفصول الدراسية')
@section('small-title', $classroom->name)
@section('content')
    <br>
    <div class="card mb-3">
        <img src="{{ asset("uploads/$classroom->cover_image") }}" class="card-img-top" height="250px">
        <div class="card-body">
            <h5 class="card-title">{{ $classroom->name }}</h5>
            <b class="text-success" style="font-size: 24px"> #{{ $classroom->code }}</b>
            <p class="card-title">القسم الذي ينتمي إليه الصف <b class="text-success" style="font-size: 24px">
                    {{ $classroom->section }}</b></p>
            <span>رابط الإنضمام للصف في الأسفل</span>
            <p class="card-text">
                {{ $urlJoinPage }}
            </p>
            <a href="{{ route('classrooms.classworks.index', $classroom->id) }}" class="btn btn-info"
                style="color: white">أعمال الفصل</a>
        </div>
        <form action="{{ route('addPost_classroom', $classroom->id) }}" method="post">
            @csrf
            <x-div-input style="display: inline-block;width: 90%;margin-right: 16px" type="text" name="post_content"
                label="المنشور" id="post" placeholder="قم بكتابة المنشور" />
            <button class="btn btn-primary" style="width: 8%">نشر</button>
        </form>
    </div>
    <div class="card mb_3" style="padding: 8px">
        @foreach ($posts as $key => $post)
            <nav class="navbar bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" >
                        <img src="{{asset("uploads/".$post->user->user_image)}}" width="30" height="24" class="d-inline-block align-text-top">
                        {{ $post->user->name }}
                    </a>
                    <span>
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                </div>
            </nav>
            <p class="container-fluid">
                {{ $post->post_content }}
            </p>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                aria-controls="collapse{{ $key }}">
                عرض التعليقات
            </button>
            <br>
            <div class="collapse" id="collapse{{ $key }}">
                <ul class="list-group">
                    <h4>التعليقات</h4>
                    @foreach ($post->comments as $comment)
                        <li class="list-group-item">
                          {{$comment->content }} : {{$comment->user->name }} 
                          <span style="float: left">{{$comment->created_at->diffForHumans()}}</span>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('comments.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <input type="hidden" name="type" value="Post">
                    <div>
                        <x-div-input style="display: inline-block;width: 90%" type="text" name="content" id="content"
                            label="التعليق" placeholder="قم بكتابة التعليق" />
                        <button type="submit" class="btn btn-primary" style="width: 9%">تعليق</button>
                    </div>
                </form>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
