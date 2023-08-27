@extends("Layouts.parent")
@section("page-title","أعمال الفصل")
@section("big-title","أعمال الفصل")
@section("small-title",$classroom->name)
@section("content")
<div class="container">
  <x-index-alert name="success" class="alert-success"/>
  @can("create",["App\Models\Classwork",$classroom])
  <div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
      إضافة عمل
    </button>
    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
      <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create', [$classroom->id,"type"=>"assignment"]) }}">تكليف</a></li>
      <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create', [$classroom->id,"type"=>"material"]) }}">نشر مادة علمية</a></li>
      <li><a class="dropdown-item" href="{{ route('classrooms.classworks.create', [$classroom->id,"type"=>"question"]) }}">نشر سؤال</a></li>
    </ul>
  </div>
  @endcan
<br>
    
    {{-- التكاليف --}}
<div class="accordion" id="accordionExample">
@if (count($assignments)>0)
<h1>التكاليف</h1>
  
@endif
  @foreach ($assignments as $assignment)
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$assignment->id}}" aria-expanded="true" aria-controls="collapseOne">
        {{$assignment->title}}
      </button>
    </h2>
    <div id="collapse{{$assignment->id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong> {{$assignment->description}}</strong>
      </div>
      <a class="btn btn-primary" href="{{route("classrooms.classworks.show",[$classroom,$assignment])}}">عرض</a>
    </div>
  </div>
   @endforeach
  
  </div>
</div>
{{-- الماتيريل --}}
<div class="accordion" id="accordionExample">
  @if (count($materials)>0)
  <h1>المواد العلمية</h1>
  @endif
   @foreach ($materials as $material)
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$material->id}}" aria-expanded="true" aria-controls="collapseOne">
        {{$material->title}}
      </button>
    </h2>
    <div id="collapse{{$material->id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong> {{$material->description}}</strong>
      </div>
      <a class="btn btn-primary" href="{{route("classrooms.classworks.show",[$classroom,$material])}}">عرض</a>
    </div>
  </div>
   @endforeach
  
  </div>
</div>
{{-- الأسئلة --}}
<div class="accordion" id="accordionExample">
  @if (count($questions)>0)
  <h1>الأسئلة</h1>
  @endif
   @foreach ($questions as $question)
   <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$question->id}}" aria-expanded="true" aria-controls="collapseOne">
        {{$question->title}}
      </button>
    </h2>
    <div id="collapse{{$question->id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong> {{$question->description}}</strong>
      </div>
      <a class="btn btn-primary" href="{{route("classrooms.classworks.show",[$classroom,$question])}}">عرض</a>
    </div>
  </div>
   @endforeach
  </div>
</div>
@endsection
@section("js")
<script>
  const classroomId={{$classroom->id}};
</script>
@vite(["resources/js/app.js"])
@endsection
    