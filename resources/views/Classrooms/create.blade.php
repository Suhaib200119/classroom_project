@extends("Layouts.parent")
@section("page-title","الفصول الدراسية")
@section("big-title","الفصول الدراسية")
@section("small-title","إضافة فصل دراسي")
@section('content')
    <x-validation-errors />
    <form action="{{ route('store_classroom') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-div-input type="text" name="name" label="الأسم" id="classroom_name" placeholder="قم بإدخال اسم الفصل الدراسي" />
        <x-div-input type="text" name="section" label="القسم" id="classroom_section" placeholder="قم بإدخال قسم الفصل الدراسي" />
        <x-div-input type="text" name="subject" label="الموضوع" id="classroom_subject" placeholder="قم بإدخال موضوع الفصل الدراسي" />
        <x-div-input type="text" name="room" label="الغرفة" id="classroom_room" placeholder="قم بإدخال غرفة الفصل الدراسي" />
        <div class="mb-3">
            <label for="status" class="form-label">حالة الفصل الدراسي: </label>
            فعال <input id="status" type="radio" name="status" value="active">
            مؤرشف <input type="radio" name="status" value="archived">
            <x-hint-error input-name="status" />
        </div>
        <x-div-input type="file" name="cover_image" label="الصورة" id="classroom_iamge"
            placeholder="قم بتحميل صورة الغلاف" />

        <button type="submit" class="btn btn-primary" style="width: 100%">حفظ</button>

    </form>
@endsection
